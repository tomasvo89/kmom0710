<?php
namespace Anax\Comment;
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    
    
    
    public function initialize() {
        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
    }
    
    
    
    public function viewAction()
    {
        $all = $this->comment->findAll();
        
        $this->views->add('comment/commentdb', [
            'comments' => $all,
            ]);
    }
    
    
    
    public function idAction($id = null)
    {
        $comment = $this->comment->find($id);
        $sql = "SELECT * FROM kmom07_comments4comment WHERE questionId = ?";  
        $params = array($id);
        $resKommentar = $this->db->executeFetchAll($sql, $params);
        
        $sql = "SELECT * FROM kmom07_answers WHERE questionId = ?";  
        $params = array($id);
        $resAnswer = $this->db->executeFetchAll($sql, $params);    
        
        $sql = "SELECT * FROM kmom07_comments4answer WHERE questionId = ?";  
        $params = array($id);
        $resKommentar4answer = $this->db->executeFetchAll($sql, $params); 
        
        $this->theme->setTitle("Visa kommentar");
        $this->views->add('comment/view', [
            'comment' => $comment,
            'kommentar' => $resKommentar,
            'answers' => $resAnswer,
            'ansCom' => $resKommentar4answer
            ]);
        
    }
    
    
    
    public function addAction()
    {
        $form = $this->form; 
        $form = $form->create([], [ 
            'title' => [ 
            'type'        => 'text', 
            'label'       => 'Rubrik', 
            'required'    => true, 
            'validation'  => ['not_empty'], 
            ], 
            'content' => [ 
            'type'        => 'textarea', 
            'label'       => 'Kommentar', 
            'required'    => true, 
            'validation'  => ['not_empty'], 
            ], 
            'tag' => [ 
            'type'        => 'textarea', 
            'label'       => 'Taggar (Separera med mellanslag)', 
            'required'    => true, 
            'validation'  => ['not_empty'], 
            ], 
            'submit' => [ 
            'type'      => 'submit', 
            'value' => 'Kommentera',
            'callback'  => function($form) { 
                if (isset($_SESSION['user'])){
                    $formTag = $form->Value('tag');
                    $tags = explode(" ", $formTag);
                    
                    foreach($tags as $tag){
                        $sql = "SELECT tag FROM kmom07_tags;";
                        $allaTaggar = $this->db->executeFetchAll($sql);
                        $taggar = array();
                        foreach($allaTaggar as $enTag) {
                            array_push($taggar, $enTag->tag);}
                            if (in_array($tag, $taggar)) {
                                $sql = "SELECT * FROM kmom07_tags WHERE tag = ?";
                                $params = array($tag);
                                $res = $this->db->executeFetchAll($sql, $params);
                                $antal = $res[0]->antal;
                                $antal++;
                                $updateSql = "UPDATE kmom07_tags SET antal = ? WHERE tag = ?;";
                                $updateParams = array($antal, $tag);
                                $this->db->execute($updateSql, $updateParams);
                            }   
                            else {
                                $sql = "INSERT INTO kmom07_tags VALUES(?, ?)";
                                $params = array($tag, 1);
                                $this->db->execute($sql, $params);
                            }
                        }
                        $content = $this->textFilter->doFilter($form->Value('content'), 'shortcode, markdown');
                        $now = date('Y-m-d H:i:s'); 
                        $this->comment->save([ 
                            'title'     => $form->Value('title'), 
                            'content'     => $content, 
                            'tag'         => $form->Value('tag'), 
                            'userId'         => $_SESSION['user']->id,
                            'userAcr'         => $_SESSION['user']->acronym, 
                            'userMail'         => $_SESSION['user']->email, 
                            'timestamp'     => $now, 
                            ]); 
                        return true;
                    }
                    
                    else{
                        $url = $this->url->create('users/loggaIn');
                        $this->response->redirect($url);        
                    }
                } 
                ], 
                ]);
$status = $form->check(); 
if ($status === true) {
    $userId = $_SESSION['user']->id;
    
    $sql = "SELECT points FROM kmom07_user WHERE id = ?";
    $params = array($userId);
    $point = $this->db->executeFetchAll($sql, $params);
    $point = $point[0]->points;
    $point++;
    
    $sql = "UPDATE kmom07_user SET points = ? WHERE id = ?";
    $params = array($point, $userId);
    $res = $this->db->execute($sql, $params);
    
    $this->response->redirect($this->request->getCurrentUrl());
} 

else if ($status === false) { 
    
    $form->AddOutput("Det gick inte att kommentera!");
    $this->response->redirect($this->request->getCurrentUrl());
}

$this->views->add('comment/form', [ 
    'form' => $form->getHTML() 
    ]); 

}



public function removeAllAction()
{
 $this->db->dropTableIfExists('comment')->execute();
 $this->db->dropTableIfExists('tags')->execute();
 $this->db->dropTableIfExists('comments4comment')->execute();
 $this->db->dropTableIfExists('answers')->execute();
 $this->db->dropTableIfExists('comments4answer')->execute();
 $this->db->createTable(
    'comment',
    [
    'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
    'title' => ['varchar(80)'],
    'content' => ['varchar(200)'],
    'tag' => ['varchar(100)'],
    'userId' => ['integer'],
    'userAcr' => ['varchar(80)'],
    'userMail' => ['varchar(80)'],
    'timestamp' => ['datetime'],
    'points' => ['integer', 'default 0'],
    ]
    )->execute();
 
 $this->db->createTable(
    'tags',
    [
    'tag' => ['varchar(80)', 'primary key'],
    'antal' => ['integer', 'default 0'],
    ]
    )->execute(); 
 $this->db->createTable(
    'comments4comment',
    [   
    'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
    'questionId' => ['integer'],
    'content' => ['varchar(200)'],
    'userId' => ['integer'],
    'userAcr' => ['varchar(80)'],
    'userMail' => ['varchar(80)'],
    'timestamp' => ['datetime'],
    'points' => ['integer', 'default 0'],
    ]
    )->execute(); 
 $this->db->createTable(
    'answers',
    [
    'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
    'questionId' => ['integer'],
    'content' => ['varchar(200)'],
    'userId' => ['integer'],
    'userAcr' => ['varchar(80)'],
    'userMail' => ['varchar(80)'],
    'timestamp' => ['datetime'],
    'choose' => ['boolean'],
    'points' => ['integer', 'default 0'],
    ]
    )->execute(); 
 
 $this->db->createTable(
    'comments4answer',
    [
    'commentId' => ['integer', 'primary key', 'not null', 'auto_increment'],
    'id' => ['integer'],
    'questionId' => ['integer'],
    'content' => ['varchar(200)'],
    'userId' => ['integer'],
    'userAcr' => ['varchar(80)'],
    'userMail' => ['varchar(80)'],
    'timestamp' => ['datetime'],
    'points' => ['integer', 'default 0'],
    ]
    )->execute(); 
 
 $url = $this->url->create('fragor'); 
 $this->response->redirect($url);     
}


public function updateAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
    
    $comment = $this->comment->find($id);
    
    if (isset($_SESSION['user'])&&$this->di->session->get('user')->acronym === $comment->userAcr){
        
        $form = $this->form;
        
        $form = $form->create([], [ 
            'title' => [ 
            'type'        => 'text', 
            'label'       => 'Rubrik', 
            'required'    => true, 
            'validation'  => ['not_empty'],
            'value' => $comment->title, 
            ], 
            'content' => [ 
            'type'        => 'textarea', 
            'label'       => 'Kommentar', 
            'required'    => true, 
            'validation'  => ['not_empty'], 
            'value' => $comment->content, 
            ], 
            'tag' => [ 
            'type'        => 'text', 
            'label'       => 'Taggar (Separera med mellanslag)', 
            'required'    => true, 
            'value' => $comment->tag, 
            ], 
            'submit' => [ 
            'type'      => 'submit', 
            'value' => 'Spara',
            'callback'  => function($form) use($comment) { 
//rensar alla taggar för nuvarande kommentar, för att kunna updatera och lägga in nya taggar.                    
                $oldFormTag = $comment->tag;
                $oldTags = explode(" ", $oldFormTag);
                foreach($oldTags as $oldTag){
                    $sql = "SELECT tag FROM kmom07_tags;";
                    $allaTaggar = $this->db->executeFetchAll($sql);
                    $taggar = array();
                    foreach($allaTaggar as $enTag) {
                        array_push($taggar, $enTag->tag);}
                        $sql = "SELECT * FROM kmom07_tags WHERE tag = ?";
                        $params = array($oldTag);
                        $res = $this->db->executeFetchAll($sql, $params);
                        $antal = $res[0]->antal;
                        $antal--;
                        $updateSql = "UPDATE kmom07_tags SET antal=? WHERE tag=?;";
                        $updateParams = array($antal, $oldTag);
                        $this->db->execute($updateSql, $updateParams);
                        
                        if ($antal == '0'){
                            $updateSql = "DELETE FROM kmom07_tags WHERE tag = ?";
                            $updateParams = array($oldTag);
                            $this->db->execute($updateSql, $updateParams);
                        }
                    }
                    
                    
                    $formTag = $form->Value('tag');
                    $tags = explode(" ", $formTag);
                    
                    foreach($tags as $tag){
                        $sql = "SELECT tag FROM kmom07_tags;";
                        $allaTaggar = $this->db->executeFetchAll($sql);
                        $taggar = array();
                        foreach($allaTaggar as $enTag) {
                            array_push($taggar, $enTag->tag);}
                            if (in_array($tag, $taggar)) {
                                $sql = "SELECT * FROM kmom07_tags WHERE tag = ?";
                                $params = array($tag);
                                $res = $this->db->executeFetchAll($sql, $params);
                                $antal = $res[0]->antal;
                                $antal++;
                                $updateSql = "UPDATE kmom07_tags SET antal=? WHERE tag=?;";
                                $updateParams = array($antal, $tag);
                                $this->db->execute($updateSql, $updateParams);
                            }   
                            else {
                                $sql = "INSERT INTO kmom07_tags VALUES(?, ?)";
                                $params = array($tag, 1);
                                $this->db->execute($sql, $params);
                            }
                        }
                        $content = $this->textFilter->doFilter($form->Value('content'), 'shortcode, markdown');
                        
                        $now = date('Y-m-d H:i:s'); 
                        $this->comment->save([ 
                            'id'        => $comment->id,
                            'title'     => $form->Value('title'), 
                            'content'     => $content, 
                            'tag'     => $form->Value('tag'), 
                            'timestamp'     => $now, 
                            ]); 
                        return true; 
                    } 
                    ], 
                    ]);

$status = $form->check(); 
if ($status === true) { 
    $form->AddOutput("<p><i>Informationen sparades!</i></p>");
    $this->response->redirect($this->request->getCurrentUrl());
} 

else if ($status === false) {
    $form->AddOutput("<p><i>Det gick inte att ändra!</i></p>");
    $this->response->redirect($this->request->getCurrentUrl());
} 

$this->theme->setTitle("Editera kommentar"); 
$this->views->add('comment/update', [ 
    'title' => "<i class='fa fa-pencil-square-o'></i> Redigera kommentar", 
    'form' => $form->getHTML() 
    ]); 
}
else {
    $url = $this->url->create('users/loggaIn');
    $this->response->redirect($url);
}
}


public function deleteAction($id = null)
{
    //$this->initialize(); 
    if (!isset($id)) {
        die("Missing id");
    }
    
    $comment = $this->comment->find($id);
    $oldFormTag = $comment->tag;
    $oldTags = explode(" ", $oldFormTag);
    foreach($oldTags as $oldTag){
        $sql = "SELECT tag FROM kmom07_tags;";
        $allaTaggar = $this->db->executeFetchAll($sql);
        $taggar = array();
        foreach($allaTaggar as $enTag) {
            array_push($taggar, $enTag->tag);}
            $sql = "SELECT * FROM kmom07_tags WHERE tag = ?";
            $params = array($oldTag);
            $res = $this->db->executeFetchAll($sql, $params);
            $antal = $res[0]->antal;
            $antal--;
            $updateSql = "UPDATE kmom07_tags SET antal=? WHERE tag=?;";
            $updateParams = array($antal, $oldTag);
            $this->db->execute($updateSql, $updateParams);
            
            if ($antal == '0'){
                $updateSql = "DELETE FROM kmom07_tags WHERE tag = ?";
                $updateParams = array($oldTag);
                $this->db->execute($updateSql, $updateParams);
            }   
        }        
        
        $this->comment->delete($id);
        
        $url = $this->url->create('fragor');
        $this->response->redirect($url); 
        
    }
    
    
    
    public function showTagsAction()
    {
        $all = array();
        $sql = "SELECT * FROM kmom07_tags;";
        $taggar = $this->db->executeFetchAll($sql);
        foreach($taggar as $tagg){
            array_push($all, $tagg);
        }
        
        $this->theme->setTitle("Alla Taggar");
        $this->views->add('comment/allTags', [
            'taggar' => $all,
            ]); 
    }
    
    
    
    public function selectTagAction($tag)
    {   
        
        $sql = "SELECT * FROM kmom07_comment Where tag LIKE '%".$tag."%';";
        $all = $this->db->executeFetchAll($sql);
        
        $this->theme->setTitle("Visa taggen");
        $this->views->add('comment/commentdb', [
            'comments' => $all,
            ]);
        
    }
    
    
    
    public function commentAction($id = null)
    {
        $comment = $this->comment->find($id);
        
        $form = $this->form; 
        $form = $form->create([], [ 
            'content' => [ 
            'type'        => 'textarea', 
            'label'       => 'Kommentar', 
            'required'    => true, 
            'validation'  => ['not_empty'], 
            ], 
            
            'submit' => [ 
            'type'      => 'submit', 
            'value' => 'Kommentera',
            'callback'  => function($form) use($comment) { 
                if (isset($_SESSION['user'])){
                    $content = $this->textFilter->doFilter($form->Value('content'), 'shortcode, markdown');
                    
                    $now = date('Y-m-d H:i:s'); 
                    $sql = "INSERT INTO kmom07_comments4comment (questionId, content, userId, userAcr, userMail, timestamp) VALUES(?, ?, ?, ?, ?, ?)";
                    $params = array($comment->id, $content, $_SESSION['user']->id, $_SESSION['user']->acronym, $_SESSION['user']->email, $now);
                    $this->db->execute($sql, $params);
                    return true;
                }
                
                else{
                    $url = $this->url->create('users/loggaIn');
                    $this->response->redirect($url);        
                }
            } 
            ], 
            ]);
$status = $form->check(); 
if ($status === true) { 
    $userId = $_SESSION['user']->id;
    
    $sql = "SELECT points FROM kmom07_user WHERE id = ?";
    $params = array($userId);
    $point = $this->db->executeFetchAll($sql, $params);
    $point = $point[0]->points;
    $point++;
    
    $sql = "UPDATE kmom07_user SET points = ? WHERE id = ?";
    $params = array($point, $userId);
    $res = $this->db->execute($sql, $params);
    
    $url = $this->url->create('comment/id/'.$id);
    $this->response->redirect($url);
} 

else if ($status === false) { 
    $form->AddOutput("Det gick inte att kommentera på frågan!");
    $url = $this->url->create('comment/id/'.$id);
    $this->response->redirect($url);
}

$this->views->add('comment/form', [ 
    'form' => $form->getHTML() 
    ]); 


$this->theme->setTitle("Lägga till ett kommentar");    
}



public function answerAction($id = null)
{
    $comment = $this->comment->find($id);
    
    $form = $this->form; 
    $form = $form->create([], [ 
        'content' => [ 
        'type'        => 'textarea', 
        'label'       => 'Svar', 
        'required'    => true, 
        'validation'  => ['not_empty'], 
        ], 
        
        'submit' => [ 
        'type'      => 'submit', 
        'value' => 'Kommentera',
        'callback'  => function($form) use($comment) { 
            if (isset($_SESSION['user'])){
                $content = $this->textFilter->doFilter($form->Value('content'), 'shortcode, markdown');        
                
                $now = date('Y-m-d H:i:s'); 
                $sql = "INSERT INTO kmom07_answers (questionId, content, userId, userAcr, userMail, timestamp, choose) VALUES(?, ?, ?, ?, ?, ?, ?)";
                $params = array($comment->id, $content, $_SESSION['user']->id, $_SESSION['user']->acronym, $_SESSION['user']->email, $now, false);
                $this->db->execute($sql, $params);
                return true;
            }
            
            else{
                $url = $this->url->create('users/loggaIn');
                $this->response->redirect($url);        
            }
        } 
        ], 
        ]);
$status = $form->check(); 
if ($status === true) { 
    $userId = $_SESSION['user']->id;
    
    $sql = "SELECT points FROM kmom07_user WHERE id = ?";
    $params = array($userId);
    $point = $this->db->executeFetchAll($sql, $params);
    $point = $point[0]->points;
    $p = '3';
    $point = $point + $p;
    
    $sql = "UPDATE kmom07_user SET points = ? WHERE id = ?";
    $params = array($point, $userId);
    $res = $this->db->execute($sql, $params);
    
    $url = $this->url->create('comment/id/'.$id);
    $this->response->redirect($url);
} 

else if ($status === false) { 
    $form->AddOutput("Det gick inte att besvara denna frågan!");
    $url = $this->url->create('comment/id/'.$id);
    $this->response->redirect($url);
}

$this->views->add('comment/form', [ 
    'form' => $form->getHTML() 
    ]); 


$this->theme->setTitle("Lägga till ett kommentar");    
}



public function commentAnswerAction($id = null)
{
        //för att kunna redirekta rätt
    $sql = "SELECT * FROM kmom07_answers WHERE id = ?";
    $params = array($id);
    $res = $this->db->executeFetchAll($sql, $params);
    $questionId = $res[0]->questionId;
    
    $form = $this->form;
    $form = $form->create([], [ 
        'content' => [ 
        'type'        => 'textarea', 
        'label'       => 'Kommentar', 
        'required'    => true, 
        'validation'  => ['not_empty'], 
        ], 
        
        'submit' => [ 
        'type'      => 'submit', 
        'value' => 'Kommentera',
        'callback'  => function($form) use($id, $questionId) { 
            if (isset($_SESSION['user'])){
                $content = $this->textFilter->doFilter($form->Value('content'), 'shortcode, markdown');        
                $now = date('Y-m-d H:i:s'); 
                $sql = "INSERT INTO kmom07_comments4answer (id, questionId, content, userId, userAcr, userMail, timestamp) VALUES(?, ?, ?, ?, ?, ?, ?)";
                $params = array($id, $questionId, $content, $_SESSION['user']->id, $_SESSION['user']->acronym, $_SESSION['user']->email, $now);
                $this->db->execute($sql, $params);
                
                return true;
            }
            
            else{
                $url = $this->url->create('users/loggaIn');
                $this->response->redirect($url);        
            }
        } 
        ], 
        ]);

$status = $form->check(); 
if ($status === true) { 
    $userId = $_SESSION['user']->id;
    
    $sql = "SELECT points FROM kmom07_user WHERE id = ?";
    $params = array($userId);
    $point = $this->db->executeFetchAll($sql, $params);
    $point = $point[0]->points;
    $point++;
    
    $sql = "UPDATE kmom07_user SET points = ? WHERE id = ?";
    $params = array($point, $userId);
    $res = $this->db->execute($sql, $params);
    
    $url = $this->url->create('comment/id/'.$questionId);
    $this->response->redirect($url);
} 

else if ($status === false) { 
    $form->AddOutput("Det gick inte att kommentera på frågan!");
    $url = $this->url->create('comment/id/'.$questionId);
    $this->response->redirect($url);
}

$this->views->add('comment/form', [ 
    'form' => $form->getHTML() 
    ]); 


$this->theme->setTitle("Lägga till ett kommentar");    
}


public function acceptAction($id = null)
{
    $sql = "SELECT * FROM kmom07_answers WHERE id = ? ";
    $params = array($id);
    $res = $this->db->executeFetchAll($sql, $params);
    $ques = $res[0]->questionId;
    
    $sql = "SELECT * FROM kmom07_comment WHERE id = ? ";
    $params = array($ques);
    $res = $this->db->executeFetchAll($sql, $params);
    $anv = $res[0]->userAcr;        
    
    
    
    if (isset($_SESSION['user'])&&$this->di->session->get('user')->acronym === $anv) {
        $sql = "SELECT * FROM kmom07_answers WHERE id = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $choose = $res[0]->choose;
        
        if ($choose == false){
            $choose = true;
            
            $sql = "SELECT points FROM kmom07_user WHERE id = ?";
            $params = array($res[0]->userId);
            $point = $this->db->executeFetchAll($sql, $params);
            $point = $point[0]->points;
            $p = '5';
            $point = $point + $p;
            
            $sql = "UPDATE kmom07_user SET points = ? WHERE id = ?";
            $params = array($point, $res[0]->userId);
            $res = $this->db->execute($sql, $params);
        }
        else {
            $choose = false;
            
            $sql = "SELECT points FROM kmom07_user WHERE id = ?";
            $params = array($res[0]->userId);
            $point = $this->db->executeFetchAll($sql, $params);
            $point = $point[0]->points;
            $p = '5';
            $point = $point - $p;
            
            $sql = "UPDATE kmom07_user SET points = ? WHERE id = ?";
            $params = array($point, $res[0]->userId);
            $res = $this->db->execute($sql, $params);
        }
        
        
        $sql = "UPDATE kmom07_answers SET choose = ? WHERE id = ?";
        $params = array($choose, $id);
        $this->db->execute($sql, $params);
        
        $sql = "SELECT * FROM kmom07_answers WHERE id = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $questionId = $res[0]->questionId;
        
        $url = $this->url->create('comment/id/'.$questionId);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);            
    }
}



public function voteUpCommentAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_comments4comment WHERE id = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point++;
        
        $sql = "UPDATE kmom07_comments4comment SET points = ? WHERE id = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $sql = "SELECT * FROM kmom07_comments4comment WHERE id = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $questionId = $res[0]->questionId;
        
        $url = $this->url->create('comment/id/'.$questionId);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}



public function voteDownCommentAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_comments4comment WHERE id = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point--;
        
        $sql = "UPDATE kmom07_comments4comment SET points = ? WHERE id = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $sql = "SELECT * FROM kmom07_comments4comment WHERE id = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $questionId = $res[0]->questionId;
        
        $url = $this->url->create('comment/id/'.$questionId);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}
public function voteUpAnswerAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_answers WHERE id = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point++;
        
        $sql = "UPDATE kmom07_answers SET points = ? WHERE id = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $sql = "SELECT * FROM kmom07_answers WHERE id = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $questionId = $res[0]->questionId;
        
        $url = $this->url->create('comment/id/'.$questionId);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}



public function voteDownAnswerAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_answers WHERE id = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point--;
        
        $sql = "UPDATE kmom07_answers SET points = ? WHERE id = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $sql = "SELECT * FROM kmom07_answers WHERE id = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $questionId = $res[0]->questionId;
        
        $url = $this->url->create('comment/id/'.$questionId);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}



public function voteUpCommentAnsAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_comments4answer WHERE commentId = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point++;
        
        $sql = "UPDATE kmom07_comments4answer SET points = ? WHERE commentId = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $sql = "SELECT * FROM kmom07_comments4answer WHERE commentId = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $questionId = $res[0]->questionId;
        
        $url = $this->url->create('comment/id/'.$questionId);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}

public function voteDownCommentAnsAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_comments4answer WHERE commentId = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point--;
        
        $sql = "UPDATE kmom07_comments4answer SET points = ? WHERE commentId = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $sql = "SELECT * FROM kmom07_comments4answer WHERE commentId = ?";
        $params = array($id);
        $res = $this->db->executeFetchAll($sql, $params);
        $questionId = $res[0]->questionId;
        
        $url = $this->url->create('comment/id/'.$questionId);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}    

public function voteUpAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_comment WHERE id = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point++;
        
        $sql = "UPDATE kmom07_comment SET points = ? WHERE id = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $url = $this->url->create('comment/id/'.$id);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}



public function voteDownAction($id = null){
    if (isset($_SESSION['user'])){
        $sql = "SELECT points FROM kmom07_comment WHERE id = ?";
        $params = array($id);
        $point = $this->db->executeFetchAll($sql, $params);
        $point = $point[0]->points;
        $point--;
        
        $sql = "UPDATE kmom07_comment SET points = ? WHERE id = ?";
        $params = array($point, $id);
        $res = $this->db->execute($sql, $params);
        
        $url = $this->url->create('comment/id/'.$id);
        $this->response->redirect($url);
    }
    else {
        $url = $this->url->create('users/loggaIn');
        $this->response->redirect($url);    
    }
}   
}
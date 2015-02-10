<?php


namespace Anax\Comment;

class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    
    public function initialize() {
        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
    }
    
    public function viewAction($key = null)
    {
        $all = $this->comment->pageType($key);
        
        $this->views->add('comment/commentdb', [
            'comments' => $all,
            'pageType' => $key,
            ]);
    }
    
    
    public function addAction($key = null)
    {
        $form = $this->form; 
        $form = $form->create([], [ 
            'content' => [ 
            'type'        => 'textarea', 
            'label'       => 'Kommentar', 
            'required'    => true, 
            'validation'  => ['not_empty'], 
            ], 
            'name' => [ 
            'type'        => 'text', 
            'label'       => 'Namn', 
            'required'    => true, 
            'validation'  => ['not_empty'], 
            ], 
            'email' => [ 
            'type'        => 'text', 
            'label'       => 'E-mail', 
            'required'    => false, 
            ], 
            'homepage' => [ 
            'type'        => 'text', 
            'label'       => 'Hemsida',
            'value'       => 'http://',
            'required'    => false,
            ], 

            'submit' => [ 
            'type'      => 'submit', 
            'value' => 'Kommentera',
            'callback'  => function($form) use($key) { 
                
                $now = gmdate('Y-m-d H:i:s'); 
                $this->comment->save([ 
                    'content'     => $form->Value('content'), 
                    'name'     => $form->Value('name'), 
                    'email'         => $form->Value('email'), 
                    'homepage'     => $form->Value('homepage'), 
                    'timestamp'     => $now, 
                    'pageType'      => $key,
                    ]); 

                return true; 
            } 
            ], 

            ]);
$status = $form->check(); 
if ($status === true) { 
    $app->CFlashmsg->addSuccess('This is a success message'); 
    $this->response->redirect($this->request->getCurrentUrl());
} 

else if ($status === false) { 
    $this->CFlashmsg->add("error", "Ett fel har inträffat, vänligen försök igen.");
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
 
 $this->db->createTable(
    'comment',
    [
    'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
    'content' => ['varchar(100)'],
    'name' => ['varchar(80)'],
    'email' => ['varchar(80)'],
    'homepage' => ['varchar(80)'],
    'timestamp' => ['datetime'],
    'pageType' => ['varchar(20)'],
    ]
    )->execute();
 
 $url = $this->url->create('');
$this->CFlashmsg->add("info", "Samtliga kommentarer borttagna.");
 $this->response->redirect($url);     
}


public function updateAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
    $comment = $this->comment->find($id);
    $form = $this->form;
    
    $form = $form->create([], [ 
        'content' => [ 
        'type'        => 'textarea', 
        'label'       => 'Kommentar', 
        'required'    => true, 
        'validation'  => ['not_empty'], 
        'value' => $comment->content, 
        ], 
        'name' => [ 
        'type'        => 'text', 
        'label'       => 'Namn', 
        'required'    => true, 
        'validation'  => ['not_empty'],
        'value' => $comment->name, 
        ], 
        'email' => [ 
        'type'        => 'text', 
        'label'       => 'E-mail', 
        'required'    => false, 
        'value' => $comment->email, 
        ], 
        'homepage' => [ 
        'type'        => 'text', 
        'label'       => 'Hemsida', 
        'required'    => false,
        'value' => $comment->homepage, 
        ], 

        'submit' => [ 
        'type'      => 'submit', 
        'value' => 'Spara',
        'callback'  => function($form) use($comment) { 
            
            $now = gmdate('Y-m-d H:i:s'); 
            $this->comment->save([ 
                'id'        => $comment->id,
                'content'     => $form->Value('content'), 
                'name'     => $form->Value('name'), 
                'email'         => $form->Value('email'), 
                'homepage'     => $form->Value('homepage'), 
                'timestamp'     => $now, 
                ]); 

            return true; 
        } 
        ], 
        ]);

$status = $form->check(); 
if ($status === true) { 
    $this->CFlashmsg->add("success", "Kommentaren updaterades.");
    $form->AddOutput("<p><i>Informationen sparades!</i></p>");
    $this->response->redirect($this->request->getCurrentUrl());
} 

else if ($status === false) {
    $this->CFlashmsg->add("error", "Ett fel har inträffat, vänligen försök igen!");
    $form->AddOutput("<p><i>Det gick inte att ändra!</i></p>");
    $this->response->redirect($this->request->getCurrentUrl());
} 

$this->theme->setTitle("Editera kommentar"); 
$this->views->add('comment/update', [ 
    'title' => "<i class='fa fa-pencil-square-o'></i> Redigera kommentar", 
    'form' => $form->getHTML() 
    ]); 
}

public function deleteAction($id = null)
{

    //$this->initialize(); 
    if (!isset($id)) {
        die("Missing id");
    }
    
    $this->comment->delete($id);
    
    
    
    $url = $this->url->create('');
    $this->CFlashmsg->add("info", "Kommentaren borttagen.");
    $this->response->redirect($url); 

    
}

} 
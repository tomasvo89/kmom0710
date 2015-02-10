<?php

namespace Anax\Users;
 
/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    
    public $output;
    
/**
 * Initialize the controller.
 *
 * @return void
 */
public function initialize()
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);
}
    
    
    /**
     * List all users.
     *
     * @return void
     */
    public function listAction() {
        $all = $this->users->findAll();
        $this->theme->setTitle("List all users");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "View all users",
        ]);
    }
    
    
    
    /**
     * List user with id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function idAction($id = null) {
        
        $user = $this->users->find($id);
        
        $questions = $user->getQuestions($user->acronym);
        $this->theme->setTitle($user->acronym);
        $answers = $user->getAnswers($user->acronym);
        $answerdQuestions = $user->linkAnswerToQuestion($user->acronym);
        $loggedOn = $user->checkLogin();
        $this->views->add('users/view', [
            'user' => $user,
            'loggedOn' => $loggedOn,
            'questions' => $questions,
            'answers' => $answers,
            'answerdQuestions' => $answerdQuestions,
        ]);
    }
    
    
    
    /**
     * Reset and setup database tabel with default users.
     *
     * @return void
     */
    public function setupAction() {
        $this->theme->setTitle("Reset and setup database with default users.");
        $table = [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'unique', 'not null'],
                'email' => ['varchar(80)'],
                'name' => ['varchar(80)'],
                'password' => ['varchar(255)'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
                'active' => ['datetime'],
                'timesLoggedOn' => ['integer'],
        ];
        $res = $this->users->setupTable($table);
        // Add some users
        $now = date('Y-m-d H:i:s');
        
        $this->users->create([
            'acronym' => 'Tovo',
            'email' => 'Tovo@dbwebb.se',
            'name' => 'Tomas V',
            'password' => password_hash('tovo', PASSWORD_DEFAULT),
            'created' => $now,
            'active' => $now,
            'timesLoggedOn' => 1,
        ]);
        $this->users->create([
            'acronym' => 'batman',
            'email' => 'batman@dbwebb.se',
            'name' => 'Bruce Wayne',
            'password' => password_hash('batman', PASSWORD_DEFAULT),
            'created' => $now,
            'active' => $now,
            'timesLoggedOn' => 1,
        ]);
        
            $this->users->create([  
        'acronym' => 'admin',  
        'email' => 'admin@dbwebb.se',  
        'name' => 'Administrator',  
        'password' => password_hash('admin', PASSWORD_DEFAULT),  
        'created' => $now,  
        'active' => $now,
        'timesLoggedOn' => 1,
        ]);  
        
        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }
    
    
    
/** 
 * Add new user. 
 * 
 * @param string $acronym of user to add. 
 * 
 * @return void 
 */ 
public function addAction() 
{ 
        //$this->initialize();  
        $form = $this->form; 
        $form = $form->create([], [  
            'acronym' => [  
                'type'        => 'text',  
                'label'       => 'Username',  
                'required'    => true,  
                'validation'  => ['not_empty'],  
            ],  
            'password' => [  
                'type'        => 'password',  
                'label'       => 'Password',  
                'required'    => true,  
                'validation'  => ['not_empty'],  
            ],  
            'name' => [  
                'type'        => 'text',  
                'label'       => 'Name',  
                'required'    => true,  
                'validation'  => ['not_empty'],  
            ],  
            'email' => [  
                'type'        => 'text',  
                'required'    => true,  
                'validation'  => ['not_empty', 'email_adress'],  
            ],  
            'submit' => [  
                'type'      => 'submit',  
                'Value' => 'Lägga till', 
                'callback'  => function($form) {  

                    $now = gmdate('Y-m-d H:i:s');  
               
                    $this->users->save([  
                        'acronym'     => $form->Value('acronym'),  
                        'email'     => $form->Value('email'),  
                        'name'         => $form->Value('name'),  
                        'password'     => password_hash($form->Value('password'), PASSWORD_DEFAULT),  
                        'created'     => $now,  
                        'active'     => $now, 
                        'timesLoggedOn' => 1,
                    ]);  

                    return true;  
                }  
            ],  

        ]); 
        $status = $form->check();  
        if ($status === true) {  
           
            $url = $this->url->create('users/profile/' . $this->users->acronym);  
            $this->response->redirect($url);  
          
        }  
         
        else if ($status === false) {  
             
            $form->AddOutput("Could not create!");  
            $url = $this->url->create('users/add');  
            $this->response->redirect($url);  
        }  
     
        $this->theme->setTitle("Create new member");  
        $this->views->add('users/update', [  
            'title' => "<i class='fa fa-plus'></i> Register",  
            'form' => $form->getHTML()  
        ]);  
     

}    
    
    
    
    /**
     * Update user.
     *
     * @param integer $id of user to update.
     *
     * @return void
     */
    public function updateAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }
        $this->theme->setTitle("Redigera profil");
        $user = $this->users->find($id);
        $form = $this->form->create([], [
            'acronym' => [
              'type'        => 'text',
              'label'       => 'Username: ',
              'required'    => true,
              'validation'  => ['not_empty'],
              'value'        => $user->acronym,
            ],
            'name' => [
              'type'        => 'text',
              'label'       => 'Name: ',
              'required'    => true,
              'validation'  => ['not_empty'],
              'value'        => $user->name,
            ],
            'email' => [
              'type'        => 'text',
              'label'       => 'Email: ',
              'required'    => true,
              'validation'  => ['not_empty', 'email_adress'],
              'value'        => $user->email,
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => function($form) {
                    $form->saveInSession = true;
                    return true;
                }
            ],
        ]);
        // Check the status of the form
        $status = $form->check();
        if ($status === true) {
            // Collect data and unset the session variable
            $updated_user['id'] = $id;
            $updated_user['acronym'] = $_SESSION['form-save']['acronym']['value'];
            $updated_user['name'] = $_SESSION['form-save']['name']['value'];
            $updated_user['email'] = $_SESSION['form-save']['email']['value'];
            session_unset($_SESSION['form-save']);
            // Save updated user data
            $res = $this->users->save($updated_user);
            if($res) {
                $url = $this->url->create('users/list');
                $this->response->redirect($url);
            }
        } else if ($status === false) {
          echo "fail";
        }
        
            $this->theme->setTitle("Create new member");  
        $this->views->add('users/update', [  
            'title' => "<i class='fa fa-plus'></i> Register",  
            'form' => $form->getHTML()  
        ]);  
    }
    
    
    /**
     * Delete user.
     *
     * @param integer $id of user to delete.
     *
     * @return void
     */
    public function deleteAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }
        $res = $this->users->delete($id);
        $status = $this->di->statusMessage;
        $status->addWarningMessage("Användaren borttagen permanent.");
        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }
    
    
    
    /**
     * Delete (soft) user.
     *
     * @param integer $id of user to delete.
     *
     * @return void
     */
    public function softDeleteAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }
        $now = date(DATE_RFC2822);
        $user = $this->users->find($id);
        $user->deleted = $now;
        $user->save();
        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }
    
    
    
    /**
     * Undelete (soft) user.
     *
     * @param integer $id of user to undelete.
     *
     * @return void
     */
    public function softUndeleteAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }
        $now = date(DATE_RFC2822);
        $user = $this->users->find($id);
        $user->deleted = null;
        $user->save();
        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }
    
    
    
    /**
     * Make user active.
     *
     * @param integer $id of user to activate.
     *
     * @return void
     */
    public function activateAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }
        $now = date(DATE_RFC2822);
        $user = $this->users->find($id);
        $user->active = $now;
        $user->save();
        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }
    
    
    
    /**
     * Make user inactive.
     *
     * @param integer $id of user to deactivate.
     *
     * @return void
     */
    public function deactivateAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }
        $now = date(DATE_RFC2822);
        $user = $this->users->find($id);
        $user->active = null;
        $user->save();
        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }
    
    
    
    /**
     * List all active and not deleted users.
     *
     * @return void
     */
    public function activeAction() {
        $all = $this->users->query()
            ->where('active IS NOT NULL')
            ->andWhere('deleted is NULL')
            ->execute();
        $this->theme->setTitle("Users that are active");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Users that are active",
        ]);
    }
    
    
    
    /**
     * List all soft-deleted users.
     *
     * @return void
     */
    public function inactiveAction() {
        $all = $this->users->query()
            ->where('active is NULL')
            ->execute();
        $this->theme->setTitle("Users that are inactive");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Users that are inactive",
        ]);
    }
    
    
    
        /**
     * List all soft-deleted users.
     *
     * @return void
     */
    public function trashAction() {
        $all = $this->users->query()
            ->where('deleted is NOT NULL')
            ->execute();
        $this->theme->setTitle("Users that are soft-deleted");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Users that are soft-deleted",
        ]);
    }
    
    
     
    public function loginAction() {
        $this->CForm->create([], [
            'acronym' => [
                'type'       => 'text',
                'label'      => 'Username:',
                'required'   => true,
                'validation' => ['not_empty'],
            ],
            'password' => [
                'type'       => 'password',
                'label'      => 'Password:',
                'required'   => true,
                'validation' => ['not_empty'],
            ],
            'submit' => [
                'type'       => 'submit',
                'value'      => 'Log in',
                'callback'   => function($form) {
                    $user = $this->users->findUser($this->CForm->Value('acronym'));

                    if(isset($user->acronym)) {
                        if(password_verify($this->CForm->Value('password'), $user->password)) {
                            $this->session->set('user', $user->acronym);
                            $url = $this->url->create('');
                            $this->response->redirect($url);
                            $this->CFlashmsg->addSuccess('Login successful');
                            $messages = $this->CFlashmsg->printMessage();
                            $this->views->addString($messages);
                        } else {
                            $this->CFlashmsg->addError('Invalid password, please try again'); 
                            $messages = $this->CFlashmsg->printMessage();
                            $this->views->addString($messages);
                        }
                    } else {
                        $this->CFlashmsg->addError('Invalid username, please try again'); 
                        $messages = $this->CFlashmsg->printMessage();
                        $this->views->addString($messages);
                    }

                    return true;
                }
            ]

        ]);
        
        $status = $this->CForm->Check();


        $this->theme->setTitle("Log in");
        $this->views->add('grid/simple_page', [
            'title'       => "Log in",
            'output'      => $this->output,
            'content'     => $this->CForm->getHTML(),
        ]);
        
    }

    public function getSessionName() {
        $output = $this->session->get('user');
        return $output;
    }

    public function logoutAction() {
        $this->session->set('user', null);

        $url = $this->url->create('');
        $this->response->redirect($url);
    }
    
    
            /** 
     * Show user profile with acronym. 
     * 
     * @param string $acronym of user to display 
     * 
     * @return void 
     */ 
    public function profileAction($acronym = null) 
    { 
        $this->initialize(); 
         
        $user = $this->users->findUser($acronym); 
         
        $questions = $user->getQuestions($user->acronym); 
        $this->theme->setTitle($user->acronym); 
        $answers = $user->getAnswers($user->acronym); 
        $answerdQuestions = $user->linkAnswerToQuestion($user->acronym); 
        $loggedOn = $user->checkLogin(); 
         
        $this->views->add('users/view', [ 
            'user' => $user, 
            'loggedOn' => $loggedOn, 
            'questions' => $questions, 
            'answers' => $answers, 
            'answerdQuestions' => $answerdQuestions, 
        ]); 
    } 
    
        public function firstPageAction() {
      $mostLoggedOn = $this->users->getMostLoggedOn();
      $this->views->add('me/mostLoggedOn', [
        'mostLoggedOn' => $mostLoggedOn,
        ]);
    }
    
} 
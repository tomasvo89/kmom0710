<?php
/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);


$di->set('CommentController', function() use ($di) {
    $controller = new \Anax\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

$app->session;

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
    $db->connect();
    return $db;
});

$di->set('CFlashmsg', function() use ($di) { 
    $message = new \tovo\CFlashmsg\CFlashmsg($di); 
    //$message->setDI($di);  
    return $message; 
}); 

$di->set('CForm', function() use ($di) {
    $CForm = new \Mos\HTMLForm\CForm(); 
    return $CForm;
});

$di->set('form', '\Mos\HTMLForm\CForm');

//controller för databas funktioner
$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->set('QuestionController', function() use ($di) {
  $controller = new \Anax\Question\QuestionController();
  $controller->setDI($di);
  return $controller;
});
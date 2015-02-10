<?php

// Get environment & autoloader.
require __DIR__.'/config_with_app.php';

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
    $app->theme->addStylesheet('css/anax-grid/font-awesome-4.2.0/css/font-awesome.min.css');
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

$app->router->add('', function() use ($app) {
    
     $app->theme->setTitle("Home");
 
    $app->dispatcher->forward([
      'controller' => 'question',
      'action'     => 'firstPage',
      'params' => [
        'key' => 'home',
        'redirect' => '',
      ],
    ]);
    
     $app->dispatcher->forward([
      'controller' => 'users',
      'action'     => 'firstPage',
      ]);

    
});


$app->router->add('about', function() use ($app){

    $app->theme->setTitle("About");
    $content = $app->fileContent->get('about.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
    /*$byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');*/

    $app->views->add('me/page', [ 
        'content' => $content,
        /*'byline' => $byline,*/
    ]); 

});


$app->router->add('question', function() use ($app) {
  $app->theme->setTitle("Frågor");
  $app->dispatcher->forward([
    'controller' => 'question',
    'action'     => 'view',
    'params' => [
      'key' => 'home',
      'redirect' => '',
    ],
  ]);
});


$app->router->add('source', function() use ($app) { 
    $app->theme->addStylesheet('css/source.css'); 
    $app->theme->setTitle("Källkod"); 

    //$content = $app->fileContent->get('source.md'); 

    $source = new \Mos\Source\CSource([ 
        'secure_dir' => '..',  
        'base_dir' => '..',  
        'add_ignore' => ['.htaccess'], 
        ]); 

    $app->views->add('me/source', [ 
        'content' => $source->View(), 
        ]); 

});//end 'source'

$app->router->handle();
$app->theme->render();



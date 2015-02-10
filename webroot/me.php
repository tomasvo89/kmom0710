<?php

require __DIR__.'/config_with_app.php';

// Fetch config for navbar menu
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php'); 

// Fetch config for a theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php'); 

//Fetch config for content
$app->fileContent->setBasePath(ANAX_APP_PATH . 'content/');


$app->router->add('', function() use ($app){
	
});//end '' (index)

$app->router->add('redovisning', function() use ($app) {

	$app->theme->setTitle("Redovisning");

	$content = $app->fileContent->get('redovisning.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

	$byline = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');


	//$app->views->add('me/redovisning');

	$app->views->add('me/page', [

		'content' => $content,
		'byline' => $byline,

		]);
 
});//end 'redovisning'

 
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

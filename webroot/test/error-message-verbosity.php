<?php 
/**
 * This is a Anax frontcontroller.
 *
 */

// Get environment & autoloader.
require __DIR__.'/../config.php';

// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryTest();
$app = new \Anax\Kernel\CAnax($di);


$di->set('TestController', function () use ($di) {
    $controller = new TestController();
    $controller->setDI($di);
    return $controller;
});


class TestController
{
    use \Anax\DI\TInjectable;

    public function indexAction()
    {
        $this->theme->setTitle("How verbose is the error reporting");
        $this->views->add('default/page', [
            'title' => "Testing error reporting from Anax MVC",
            'content' => "Trying out some missusage of Anax MVC to see if the errors are easy to understand.",
            'links' => [
                [
                    'href' => $this->url->create('t1'),
                    'text' => "Using not defined service as property of \$app",
                ],
                [
                    'href' => $this->url->create('t2'),
                    'text' => "Using not defined service as method of \$app",
                ],
                [
                    'href' => $this->url->create('t3'),
                    'text' => "Forward to non-existing controller",
                ],
                [
                    'href' => $this->url->create('t4'),
                    'text' => "Forward to non-existing action",
                ],
                [
                    'href' => $this->url->create('t5'),
                    'text' => "Forward to existing, but private, action",
                ],
                [
                    'href' => $this->url->create('test/no-di-call'),
                    'text' => "Using TInjectable forgot to set \$di, accessing session() via __call()",
                ],
                [
                    'href' => $this->url->create('test/no-di-get'),
                    'text' => "Using TInjectable forgot to set \$di, accessing session via __get()",
                ],
                [
                    'href' => $this->url->create('test/no-such-service-property'),
                    'text' => "Using TInjectable - no such method, accessing session1() via __call()",
                ],
                [
                    'href' => $this->url->create('test/no-such-service-method'),
                    'text' => "Using TInjectable - no such property, accessing session1 via __get()",
                ],
            ]
        ]);
    }

    public function noDiCallAction()
    {
        $this->di = null;
        $this->session();
    }

    public function noDiGetAction()
    {
        $this->di = null;
        $this->session;
    }

    public function noSuchServicePropertyAction()
    {
        $this->session1();
    }

    public function noSuchServiceMethodAction()
    {
        $this->session1;
    }

    private function privateAction()
    {
        ;
    }
}



$app->router->add('', function () use ($app) {

    $app->dispatcher->forward(['controller' => 'test']);

});


$app->router->add('t1', function () use ($app) {

    $app->dispatchNO;

});


$app->router->add('t2', function () use ($app) {

    $app->dispatchNO();

});


$app->router->add('t3', function () use ($app) {

    $app->dispatcher->forward(['controller' => 'testNO']);

});


$app->router->add('t4', function () use ($app) {

    $app->dispatcher->forward(['controller' => 'test', 'action' => 'NONE']);

});

$app->router->add('t5', function () use ($app) {

    $app->dispatcher->forward(['controller' => 'test', 'action' => 'private']);

});



// Check for matching routes and dispatch to controller/handler of route
$app->router->handle();

// Render the page
$app->theme->render();

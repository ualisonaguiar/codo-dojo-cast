<?php

namespace ApplicationTest\Controller;

use ApplicationTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\FizzBuzzController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class FizzBuzzControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->controller = new FizzBuzzController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);
        
        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }
    
    /**
     * @test
     */
    public function indexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    /**
     * @test
     */
    public function verificaRetornoViewModel()
    {
        $this->routeMatch->setParam('action', 'index');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
        $vars = $result->getVariables();
        $this->assertTrue(isset($vars['mixResultado']));
    }
    
    /**
     * @test
     */
    public function verificarNaoHaPost()
    {
        $this->routeMatch->setParam('action', 'index');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($this->controller->getRequest()->isPost());
    }
    
    /**
     * @test
     */
    public function inserePost()
    {
        $this->routeMatch->setParam('action', 'index');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->controller
            ->getRequest()
            ->setMethod("POST")
            ->setPost(
                new \Zend\Stdlib\Parameters(
                    array(
                        'numero' => 'value'
                    )
                )
            );
        $this->assertTrue($this->controller->getRequest()->isPost());
    }
    
    /**
     * @test
     */
    public function verificarResultadoInformadoFizzBuzz()
    {
        $this->routeMatch->setParam('action', 'index');
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->request
            ->setMethod("POST")
            ->setPost(
                new \Zend\Stdlib\Parameters(
                    array(
                        'numero' => 15
                    )
                )
            );
        $result   = $this->controller->dispatch($this->request);
        $vars = $result->getVariables();
        
        $this->assertEquals('FizzBuzz', $vars['mixResultado']);
    }
    
    /**
     * @test
     */
    public function verificarResultadoInformadoFizz()
    {
        $this->routeMatch->setParam('action', 'index');
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->request
            ->setMethod("POST")
            ->setPost(
                new \Zend\Stdlib\Parameters(
                    array(
                        'numero' => 3
                    )
                )
            );
        $result   = $this->controller->dispatch($this->request);
        $vars = $result->getVariables();
        
        $this->assertEquals('Fizz', $vars['mixResultado']);
    }
    
    /**
     * @test
     */
    public function verificarResultadoInformadoBuzz()
    {
        $this->routeMatch->setParam('action', 'index');
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->request
            ->setMethod("POST")
            ->setPost(
                new \Zend\Stdlib\Parameters(
                    array(
                        'numero' => 10
                    )
                )
            );
        $result   = $this->controller->dispatch($this->request);
        $vars = $result->getVariables();
        
        $this->assertEquals('Buzz', $vars['mixResultado']);
    }
}
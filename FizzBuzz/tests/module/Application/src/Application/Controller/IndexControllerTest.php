<?php

namespace Application\Controller;

use \PHPUnit_Framework_TestCase;

class ApplicationIndexControllerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->indexController = new IndexController();
        parent::setUp();
    }

    /**
     * @test
     */    
    public function indexActionInicio()
    {
    }

    /**
     * @test
     */
    public function indexActionReturnsViewModel()
    {
        $this->assertInstanceOf(
            '\Zend\View\Model\ViewModel',
            $this->indexController->indexAction()
        );
    }
}

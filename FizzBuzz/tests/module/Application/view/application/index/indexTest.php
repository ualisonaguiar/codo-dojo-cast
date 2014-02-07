<?php

namespace Application\Controller;

use \PHPUnit_Extensions_SeleniumTestCase;
use Application\Controller\IndexController;

class indexTest extends PHPUnit_Extensions_SeleniumTestCase
{

    public function setUp()
    {
        $this->setBrowser("*firefox");
        $this->setBrowserUrl("http://r");
    }

    public function testTitle()
    {
        $this->open('http://r');
        $this->assertTitle('Zend Skeleton Application');
    }

    public function testH1Exists()
    {
        $this->open('http://r');
    	$this->assertElementPresent("xpath=//h1");
    }

	/**
	 * @depends testH1Exists
	 * 
	 * Only check the value of h1 tag, if there is an h1 tag
	 */
    public function testH1Correct()
    {
        $this->open('http://r');
        $this->assertElementContainsText("//h1", 'Welcome');
    }
}

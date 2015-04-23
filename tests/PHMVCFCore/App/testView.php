<?php

use P87\PHMVCFCore\App\View;

class testView extends PHPUnit_Framework_TestCase
{
	public function testConstruct()
	{
		$view = new View();
		$this->assertInstanceOf('\P87\PHMVCFCore\App\View', $view);
		$this->assertAttributeEquals('template', 'template', $view);
	}

	public function testSetTemplate()
	{
		$view = new View();
		$view->setTemplate('foobar');
		$this->assertAttributeEquals('foobar', 'template', $view);
	}

	public function testSetAssignsVariable()
	{
		$expected = ['foo' => 'bar', 'bar' => 'foo'];
		$view = new View();
		$view->set('foo', 'bar');
		$view->set('bar', 'foo');
		$this->assertAttributeEquals($expected, 'vars', $view);
	}

	//TODO
	public function testView()
	{

	}

	//TODO
	public function testRender()
	{

	}
}

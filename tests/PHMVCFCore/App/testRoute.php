<?php

use P87\PHMVCFCore\App\Route;

class testRoute extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $route = new Route();
        $this->assertInstanceOf('\P87\PHMVCFCore\App\Route', $route);
        $this->assertTrue(is_array($route->getRoutes()));
    }

    public function testSetStoresData()
    {
        $route = new Route();
        $route->set('foo/bar', []);
        $expected = ['foo/bar' => ['data' => []]];
        $this->assertEquals($expected, $route->getRoutes());
    }

    public function testSetReturnsRoute()
    {
        $route = new Route();
        $this->assertInstanceOf('\P87\PHMVCFCore\App\Route', $route->set('foo/bar', []));
    }

    public function testDecideReturnsStaticRoute()
    {
        $route = new Route();
        $route->set('foo/bar', []);
        $this->assertEquals(['data' => []], $route->decide('foo/bar'));
    }

    public function testDecideReturnsVariableRoute()
    {
        $route = new Route();
        $route->set('foo/bar/<id>/<name>', []);
        $this->assertEquals(['data' => ['id' => 17, 'name' => 'foobar']], $route->decide('foo/bar/17/foobar')); 
    }

    public function testDecideReturnsFalseWhenRouteNotFound()
    {
        $route = new Route();
        $route->set('foo/bar', []);
        $this->assertFalse($route->decide('bar/foo'));
    }

    public function testGetRoutes()
    {
        $route = new Route();
        $route->set('foo/bar', ['a' => 'b'])
                ->set('bar/foo', ['c' => 'd']);
        $expected = [
            'foo/bar' => ['data' => [], 'a' => 'b'],
            'bar/foo' => ['data' => [], 'c' => 'd']
        ];
        $this->assertEquals($expected, $route->getRoutes());
    }

    public function testExtractVars()
    {
        $method = new ReflectionMethod(
          'P87\PHMVCFCore\App\Route', 'extractVars'
        );
        $expected = [0 => [0 => '<bar>', 1 => 'bar']];
        $method->setAccessible(TRUE);
        $this->assertEquals(
            $expected, $method->invokeArgs(new Route, ['/foo/<bar>/7'])
        );
    }

    public function arrangeVars()
    {
        $method = new ReflectionMethod(
          'P87\PHMVCFCore\App\Route', 'arrangeVars'
        );
        $expected = ['foo' => 'bar'];
        $method->setAccessible(TRUE);
        $this->assertEquals(
            $expected, $method->invokeArgs(new Route, ['foo' => 'bar', 1 => 'test'])
        );   
    }
}

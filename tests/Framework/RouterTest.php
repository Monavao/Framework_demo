<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 11/09/18
 * Time: 21:49
 */

namespace Tests\Framework;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function setUp()
    {
        $this->router = new Router();
    }

    public function testGetMethod()
    {
        $request = new Request('GET', '/blog');

        $this->router->get('/blog', function () {
            return 'hello';
        }, 'blog');

        $route = $this->router->match($request);
        $this->assertEquals('blog', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
    }

    public function testGetMethodIfURLDoesNotExist()
    {
        $request = new Request('GET', '/blog');

        $this->router->get('/blogecece', function () {
            return 'hello';
        }, 'blog');

        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
    }

    public function testGetMethodWithParameters()
    {
        $request = new Request('GET', '/blog/un-slug-1');

        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () {
            return 'ececece';
        }, 'posts');

        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () {
            return 'hello';
        }, 'post.show');

        $route = $this->router->match($request);
        $this->assertEquals('post.show', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
        $this->assertEquals(['slug' => 'un-slug', 'id' => '1'], $route->getParameters());
    }
}

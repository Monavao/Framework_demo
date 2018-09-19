<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 11/09/18
 * Time: 21:49
 */

namespace Tests\Framework;

use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    public function testGetMethod()
    {
        $request = new ServerRequest('GET', '/blog');

        $this->router->get('/blog', function () {
            return 'hello';
        }, 'blog');

        $route = $this->router->match($request);
        $this->assertEquals('blog', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
    }

    public function testGetMethodIfURLDoesNotExist()
    {
        $request = new ServerRequest('GET', '/blog');

        $this->router->get('/blogecece', function () {
            return 'hello';
        }, 'blog');

        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }

    public function testGetMethodWithParameters()
    {
        $request = new ServerRequest('GET', '/blog/un-slug-1');

        $this->router->get('/blog', function () {
            return 'ececece';
        }, 'posts');

        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () {
            return 'hello';
        }, 'post.show');

        $route = $this->router->match($request);
        $this->assertEquals('post.show', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
        $this->assertEquals(['slug' => 'un-slug', 'id' => '1'], $route->getParams());
        //Teste une url invalide
        $route = $this->router->match(new ServerRequest('GET', '/blog/mon_slug-8'));
        $this->assertEquals(null, $route);
    }

    public function testGenerateUri()
    {
        $this->router->get('/blog', function () {
            return 'ececece';
        }, 'posts');

        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () {
            return 'hello';
        }, 'post.show');

        $uri = $this->router->generateUri('post.show', ['slug' => 'mon-article', 'id' => 18]);

        $this->assertEquals('/blog/mon-article-18', $uri);
    }
}

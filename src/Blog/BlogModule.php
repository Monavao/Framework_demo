<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 19/09/18
 * Time: 22:56
 */

namespace App\Blog;

use Framework\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BlogModule
{
    public function __construct(Router $router)
    {
        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[-a-z]+}', [$this, 'show'], 'blog.show');
    }

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function index(ServerRequestInterface $request): string
    {
        return '<h1>Bienvenue sur le blog!!!</h1>';
    }

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function show(ServerRequestInterface $request): string
    {
        return '<h1>Bienvenue sur l\'article ' . $request->getAttribute('slug') . '</h1>';
    }
}

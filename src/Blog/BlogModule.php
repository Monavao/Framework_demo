<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 19/09/18
 * Time: 22:56
 */

namespace App\Blog;

use Framework\Renderer;
use Framework\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BlogModule
{
    private $renderer;

    /**
     * BlogModule constructor.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->renderer = new Renderer();
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[-a-z]+}', [$this, 'show'], 'blog.show');
    }

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function index(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@blog/index');
    }

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function show(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@blog/show');
    }
}

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
    /**
     * @var Renderer
     */
    private $renderer;


    /**
     * BlogModule constructor.
     *
     * @param Router   $router
     * @param Renderer $renderer
     */
    public function __construct(Router $router, Renderer $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[-a-z0-9]+}', [$this, 'show'], 'blog.show');
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
        return $this->renderer->render('@blog/show', [
            'slug' => $request->getAttribute('slug'),
        ]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 19/09/18
 * Time: 22:56
 */

namespace App\Blog;

use Framework\Module;
use Framework\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Renderer\RendererInterface;

class BlogModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';


    /**
     * BlogModule constructor.
     *
     * @param string            $prefix
     * @param Router            $router
     * @param RendererInterface $renderer
     */
    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $router->get($prefix, [$this, 'index'], 'blog.index');
        $router->get($prefix . '/blog/{slug:[-a-z0-9]+}', [$this, 'show'], 'blog.show');
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

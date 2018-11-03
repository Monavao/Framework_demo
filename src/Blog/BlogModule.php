<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 19/09/18
 * Time: 22:56
 */

namespace App\Blog;

use App\Blog\Actions\BlogAction;
use Framework\Module;
use Framework\Router;
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
        $renderer->addPath('blog', __DIR__ . '/views');
        $router->get($prefix, BlogAction::class, 'blog.index');
        $router->get($prefix . '/blog/{slug:[-a-z0-9]+}', BlogAction::class, 'blog.show');
    }
}

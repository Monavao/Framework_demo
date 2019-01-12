<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 03/11/18
 * Time: 23:10
 */

namespace App\Blog\Actions;

use App\Blog\Table\PostTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Router;

class BlogAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var PostTable
     */
    private $postTable;

    /**
     * @var Router
     */
    private $router;

    use RouterAwareAction;

    /**
     * BlogAction constructor.
     *
     * @param RendererInterface $renderer
     * @param PostTable         $postTable
     * @param Router            $router
     */
    public function __construct(RendererInterface $renderer, Router $router, PostTable $postTable)
    {
        $this->renderer  = $renderer;
        $this->postTable = $postTable;
        $this->router    = $router;
    }

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function __invoke(ServerRequestInterface $request)
    {
        if ($request->getAttribute('id')) {
            $action = $this->show($request);
        } else {
            $action = $this->index();
        }

        return $action;
    }

    /**
     * Affiche liste d'articles
     * @return string
     */
    public function index(): string
    {
        $posts = $this->postTable->findPaginated();

        return $this->renderer->render('@blog/index', compact('posts'));
    }

    /**
     * Affiche un article
     * @param ServerRequestInterface $request
     * @return ResponseInterface|string
     */
    public function show(ServerRequestInterface $request)
    {
        $slug = $request->getAttribute('slug');
        $post = $this->postTable->find($request->getAttribute('id'));

        if ($post->slug !== $slug) {
            return $this->redirect('blog.show', [
                'slug' => $post->slug,
                'id'   => $post->id
            ]);
        }

        return $this->renderer->render('@blog/show', [
            'post' => $post,
        ]);
    }
}

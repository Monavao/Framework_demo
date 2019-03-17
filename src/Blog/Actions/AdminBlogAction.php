<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 17/03/19
 * Time: 16:39
 */

namespace App\Blog\Actions;

use App\Blog\Table\PostTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Router;

class AdminBlogAction
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
            $action = $this->edit($request);
        } else {
            $action = $this->index($request);
        }

        return $action;
    }

    /**
     * Affiche liste d'articles
     * @param ServerRequestInterface $request
     * @return string
     */
    public function index(ServerRequestInterface $request): string
    {
        $params = $request->getQueryParams();
        $items  = $this->postTable->findPaginated(12, $params['p'] ?? 1);

        return $this->renderer->render('@blog/admin/index', compact('items'));
    }

    public function edit(ServerRequestInterface $request): string
    {
        $item = $this->postTable->find($request->getAttribute('id'));

        return $this->renderer->render('@blog/admin/edit', compact('item'));
    }
}

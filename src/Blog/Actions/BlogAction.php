<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 03/11/18
 * Time: 23:10
 */

namespace App\Blog\Actions;

use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use \GuzzleHttp\Psr7\Response;
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
     * @var \PDO
     */
    private $pdo;

    /**
     * @var Router
     */
    private $router;

    use RouterAwareAction;

    /**
     * BlogAction constructor.
     *
     * @param RendererInterface $renderer
     * @param \PDO              $pdo
     * @param Router            $router
     */
    public function __construct(RendererInterface $renderer, \PDO $pdo, Router $router)
    {
        $this->renderer = $renderer;
        $this->pdo      = $pdo;
        $this->router   = $router;
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
        $posts = $this->pdo
            ->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 10')
            ->fetchAll();

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

        $query = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $query->execute([$request->getAttribute('id')]);
        $post = $query->fetch();

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

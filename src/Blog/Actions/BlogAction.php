<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 03/11/18
 * Time: 23:10
 */

namespace App\Blog\Actions;

use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class BlogAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * BlogAction constructor.
     *
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }


    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $slug = $request->getAttribute('slug');

        if ($slug) {
            $action = $this->show($slug);
        } else {
            $action = $this->index();
        }

        return $action;
    }

    /**
     * @return string
     */
    public function index(): string
    {
        return $this->renderer->render('@blog/index');
    }


    /**
     * @param string $slug
     * @return string
     */
    public function show(string $slug): string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $slug,
        ]);
    }
}

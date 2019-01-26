<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 12/01/19
 * Time: 16:53
 */

namespace Tests\App\Blog_Actions;

use App\Blog\Actions\BlogAction;
use App\Blog\Entity\Post;
use App\Blog\Table\PostTable;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class BlogActionTest extends TestCase
{
    /**
     * @var BlogAction
     */
    private $action;

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

    public function setUp()
    {
        $this->renderer = $this->prophesize(RendererInterface::class);
        $this->postTable = $this->prophesize(PostTable::class);
        $this->renderer->render(Argument::any())->willReturn('');

        $this->router   = $this->prophesize(Router::class);

        $this->action = new BlogAction(
            $this->renderer->reveal(),
            $this->router->reveal(),
            $this->postTable->reveal()
        );
    }

    public function makePost(int $id, string $slug): Post
    {
        //Article
        $post       = new Post();
        $post->id   = $id;
        $post->slug = $slug;

        return $post;
    }

    public function testShowRedirect()
    {
        $post = $this->makePost(9, 'ftththth');

        $this->router->generateUri('blog.show', ['id' => $post->id, 'slug' => $post->slug])->willReturn('/demo-test');
        $this->postTable->find($post->id)->willReturn($post);

        $request = (new ServerRequest('GET', '/'))
        ->withAttribute('id', $post->id)
        ->withAttribute('slug', 'demo');

        $response = call_user_func_array($this->action, [$request]);
        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals(['/demo-test'], $response->getHeader('location'));
    }

    public function testShowRender()
    {
        $post = $this->makePost(9, 'ftththth');

        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('id', $post->id)
            ->withAttribute('slug', $post->slug);

        $this->postTable->find($post->id)->willReturn($post);

        $this->renderer->render('@blog/show', ['post' => $post])->willReturn('');

        $response = call_user_func_array($this->action, [$request]);
        $this->assertEquals(true, true);
    }
}

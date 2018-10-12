<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 12/10/18
 * Time: 23:55
 */

namespace Tests\Framework;

use Framework\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    private $renderer;

    public function setUp()
    {
        $this->renderer = new Renderer();
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('Salut!!!!', $content);
    }

    public function testRenderTheDefaultRightPath()
    {
        $this->renderer->addPath(__DIR__ . '/views');
        $content = $this->renderer->render('demo');
        $this->assertEquals('Salut!!!!', $content);
    }
}

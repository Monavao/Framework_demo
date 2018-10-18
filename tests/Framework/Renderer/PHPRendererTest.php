<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 18/10/18
 * Time: 22:17
 */

namespace Tests\Framework\Renderer;

use Framework\Renderer\PHPRenderer;
use PHPUnit\Framework\TestCase;

class PHPRendererTest extends TestCase
{
    private $renderer;

    public function setUp()
    {
        $this->renderer = new PHPRenderer(__DIR__ . '/views');
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('Salut!!!!', $content);
    }

    public function testRenderTheDefaultPath()
    {
        $content = $this->renderer->render('demo');
        $this->assertEquals('Salut!!!!', $content);
    }

    public function testRenderWithParams()
    {
        $content = $this->renderer->render('demoparams', ['nom' => 'Tony']);
        $this->assertEquals('Salut Tony!!!!', $content);
    }

    public function testGlobalParameters()
    {
        $this->renderer->addGlobal('nom', 'Tony');
        $content = $this->renderer->render('demoparams');
        $this->assertEquals('Salut Tony!!!!', $content);
    }
}

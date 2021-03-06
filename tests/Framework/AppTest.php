<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 08/09/18
 * Time: 13:12
 */

namespace Tests\Framework;

use App\Blog\BlogModule;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Tests\Framework\Modules\ErroredModule;

class AppTest extends TestCase
{
    public function testRedirectTrailingSlash()
    {
        $app      = new App();
        $request  = new ServerRequest('GET', '/demooo/');
        $response = $app->run($request);

        $this->assertContains('/demooo', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog()
    {
        $app      = new App([BlogModule::class]);
        $request  = new ServerRequest('GET', '/blog');
        $response = $app->run($request);
        $this->assertContains('<h1>Bienvenue sur le blog!!!</h1>', (string) $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());

        $request2  = new ServerRequest('GET', '/blog/article-de-test');
        $response2 = $app->run($request2);
        $this->assertContains('<h1>Bienvenue sur l\'article article-de-test</h1>', (string) $response2->getBody());
        $this->assertEquals(200, $response2->getStatusCode());
    }

    public function testThrowExceptionIfNoResponseSent()
    {
        $app = new App([
            ErroredModule::class
        ]);

        $request = new ServerRequest('GET', '/demo');
        $this->expectException(\Exception::class);
        $app->run($request);
    }

    public function testError404()
    {
        $app      = new App([BlogModule::class]);
        $request  = new ServerRequest('GET', '/uyftyf');
        $response = $app->run($request);
        $this->assertContains('<h1>Erreur 404</h1>', (string) $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}

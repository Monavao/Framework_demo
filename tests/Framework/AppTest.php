<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 08/09/18
 * Time: 13:12
 */

namespace Tests\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

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
}

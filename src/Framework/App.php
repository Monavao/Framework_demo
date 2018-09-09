<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 08/09/18
 * Time: 12:51
 */

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();

        if (!empty($uri) && $uri[-1] === '/') {
            $response = (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        } else {
            $response = new Response();
            $response->getBody()->write('Bonjour');
        }

        return $response;
    }
}

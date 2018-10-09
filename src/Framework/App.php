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
    /**
     * Liste des modules
     *
     * @var array
     */
    private $modules = [];

    /**
     * Router
     *
     * @var Router
     */
    private $router;


    /**
     * App constructor.
     *
     * @param array $modules
     */
    public function __construct(array $modules = [])
    {
        $this->router = new Router();

        foreach ($modules as $module) {
            $this->modules[] = new $module($this->router);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri      = $request->getUri()->getPath();
        $response = new Response(404, [], '<h1>Erreur 404</h1>');

        if (!empty($uri) && $uri[-1] === '/') {
            $response = (new Response())->withStatus(301)->withHeader('Location', substr($uri, 0, -1));
        }

        if ($uri === '/blog/mon-article') {
            $response = new Response(200, [], '<h1>Bienvenue !!!</h1>');
        }


        return $response;
    }
}

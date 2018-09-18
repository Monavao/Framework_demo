<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 11/09/18
 * Time: 22:29
 */

namespace Framework;

use Framework\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

class Router
{
    /**
     * @var FastRouteRouter
     */
    private $router;

    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    /**
     * @param string   $path
     * @param callable $callable
     * @param string   $name
     */
    public function get(string $path, callable $callable, string $name)
    {
        $this->router->addRoute(new ZendRoute($path, $callable, Zendroute::HTTP_METHOD_ANY, $name));
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {
        $route  = null;
        $result = $this->router->match($request);

        if ($result->isSuccess()) {
            $route = new Route($result->getMatchedRouteName(), $result->getMatchedMiddleware(), $result->getMatchedParams());
        }

        return $route;
    }
}

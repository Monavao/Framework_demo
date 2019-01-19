<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 19/01/19
 * Time: 23:39
 */

namespace Framework\Twig;

use Framework\Router;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap4View;

class PagerFantaExtension extends \Twig_Extension
{
    /**
     * @var Router
     */
    private $router;

    /**
     * PagerFantaExtension constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('paginate', [$this, 'paginate'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param Pagerfanta $paginatedResults
     * @param string     $route
     * @param array      $queryArgs
     * @return string
     */
    public function paginate(Pagerfanta $paginatedResults, string $route, array $queryArgs = []): string
    {
        $view = new TwitterBootstrap4View();

        return $view->render($paginatedResults, function (int $page) use ($route, $queryArgs) {
            if ($page > 1) {
                $queryArgs['p'] = $page;
            }

            return $this->router->generateUri($route, [], $queryArgs);
        });
    }
}

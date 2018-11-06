<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 06/11/18
 * Time: 22:38
 */

namespace Framework\Router;

use Framework\Router;

class RouterTwigExtension extends \Twig_Extension
{
    /**
     * @var Router
     */
    private $router;

    /**
     * RouterTwigExtension constructor.
     *
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
            new \Twig_SimpleFunction('path', [$this, 'pathFor']),
        ];
    }

    /**
     * @param string $path
     * @param array  $params
     * @return string
     */
    public function pathFor(string $path, array $params = []): string
    {
        return $this->router->generateUri($path, $params);
    }
}

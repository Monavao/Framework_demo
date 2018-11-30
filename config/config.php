<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 22/10/18
 * Time: 22:28
 */

use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;

return [
    'database.host'          => 'localhost',
    'database.username'      => 'moom',
    'database.password'      => 'root',
    'database.name'          => 'framework_demo',
    'database.charset'       => 'utf8',
    'views.path'             => dirname(__DIR__) . '/views',
    'twig.extensions'        => [
        \DI\get(\Framework\Router\RouterTwigExtension::class)
    ],
    Router::class            => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];

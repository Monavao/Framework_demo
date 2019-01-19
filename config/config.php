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
use Psr\Container\ContainerInterface;

return [
    'database.host'          => 'localhost',
    'database.username'      => 'monavao',
    'database.password'      => 'root',
    'database.name'          => 'framework_demo',
    'database.charset'       => 'utf8',
    'views.path'             => dirname(__DIR__) . '/views',
    'twig.extensions'        => [
        \DI\get(\Framework\Router\RouterTwigExtension::class),
        \DI\get(\Framework\Twig\PagerFantaExtension::class),
    ],
    Router::class            => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
    \PDO::class              => function (ContainerInterface $c) {
        return new PDO(
            'mysql:host=' . $c->get('database.host') . ';dbname=' . $c->get('database.name') . ';charset=' .
            $c->get('database.charset'),
            $c->get('database.username'),
            $c->get('database.password'),
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }
];

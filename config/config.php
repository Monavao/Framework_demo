<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 22/10/18
 * Time: 22:28
 */

use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;

return [
    'views.path' => dirname(__DIR__) . '/views',
    RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];

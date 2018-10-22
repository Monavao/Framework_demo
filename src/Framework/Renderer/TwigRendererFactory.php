<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 22/10/18
 * Time: 22:52
 */

namespace Framework\Renderer;

use Psr\Container\ContainerInterface;

class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        return new TwigRenderer($container->get('views.path'));
    }
}

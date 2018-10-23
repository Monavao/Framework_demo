<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 23/10/18
 * Time: 23:53
 */

namespace Framework\Router;

use Framework\Router;
use Psr\Container\ContainerInterface;

class BlogModuleFactory
{
    public function __invoke(ContainerInterface $container): Router
    {
        return new Router();
    }
}
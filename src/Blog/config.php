<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 23/10/18
 * Time: 23:48
 */

use \App\Blog\BlogModule;
use \Framework\Router\BlogModuleFactory;
use function \DI\autowire;
use function \DI\get;

return [
    'blog.prefix'     => '/blog',
    BlogModule::class => autowire()->constructorParameter('prefix', get('blog.prefix')),
];

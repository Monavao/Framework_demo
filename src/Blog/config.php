<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 23/10/18
 * Time: 23:48
 */

use \App\Blog\BlogModule;
use \Framework\Blog\BlogModuleFactory;
use function \DI\autowire;
use function \DI\get;

return [
    'blog.prefix'     => '/blog',
    BlogModule::class => autowire()->constructorParameter('prefix', get('blog.prefix')),
//    BlogModule::class => \DI\factory(BlogModuleFactory::class)->parameter('prefix', 'blog/prefix'),
];

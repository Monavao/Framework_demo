<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 08/09/18
 * Time: 12:40
 */

require '../vendor/autoload.php';

use App\Blog\BlogModule;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__) . '/config/config.php');
$builder->addDefinitions(dirname(__DIR__) . '/config.php');

$container = $builder->build();
$renderer = $container->get(\Framework\Renderer\RendererInterface::class);

var_dump($renderer);
die;

$loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/views');
$twig   = new Twig_Environment($loader, []);

$app = new \Framework\App([BlogModule::class], [
    'renderer' => $renderer,
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);

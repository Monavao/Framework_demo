<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 08/09/18
 * Time: 12:40
 */

require '../vendor/autoload.php';

use App\Blog\BlogModule;

$renderer = new \Framework\Renderer\TwigRenderer(dirname(__DIR__) . '/views');

$loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/views');
$twig   = new Twig_Environment($loader, []);

$app      = new \Framework\App([BlogModule::class], [
    'renderer' => $renderer,
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);

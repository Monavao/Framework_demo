<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 08/09/18
 * Time: 12:40
 */

require '../vendor/autoload.php';

$app      = new \Framework\App();
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);

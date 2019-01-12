<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 02/12/18
 * Time: 17:28
 */

namespace Framework\Actions;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Rajoute des méthodes liées à l'utilisation du Router
 *
 * @package Framework\Actions
 */
trait RouterAwareAction
{
    /**
     * Renvoie une réponse de redirection
     * @param string $path
     * @param array  $params
     * @return ResponseInterface
     */
    public function redirect(string $path, array $params = []): ResponseInterface
    {
        $redirectUri = $this->router->generateUri($path, $params);
        $response    = new Response();

        return $response->withStatus(301)->WithHeader('location', $redirectUri);
    }
}

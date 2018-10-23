<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 17/10/18
 * Time: 00:01
 */

namespace Framework\Renderer;

class TwigRenderer implements RendererInterface
{
    private $twig;

    private $loader;

    public function __construct(string $path)
    {
        $this->loader = new \Twig_Loader_Filesystem($path);
        $this->twig   = new \Twig_Environment($this->loader, []);
    }

    /**
     * @param string      $namespace
     * @param null|string $path
     * @throws \Twig_Error_Loader
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }

    /**
     * @param string $view
     * @param array  $params
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view . '.html.twig', $params);
    }

    /**
     * Permet de rajouter des varaibles globales à toutes les vues
     *
     * @param string $key
     * @param mixed  $value
     */
    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}

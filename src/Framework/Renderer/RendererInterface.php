<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 16/10/18
 * Time: 23:49
 */

namespace Framework\Renderer;

interface RendererInterface
{
    /**
     * Permet d'ajouter un chemin pour charger les vues
     *
     * @param string      $namespace
     * @param null|string $path
     */
    public function addPath(string $namespace, ?string $path = null): void;

    /**
     * Permet de rendre une vue
     * Le chemin peut être précisé avec des namespaces rajoutés via addPath()
     * $this->render('@blog/view');
     * $this->render('view');
     *
     * @param string $view
     * @param array  $params
     * @return string
     */
    public function render(string $view, array $params = []): string;

    /**
     * Permet de rajouter des varaibles globales à toutes les vues
     *
     * @param string $key
     * @param mixed  $value
     */
    public function addGlobal(string $key, $value): void;
}
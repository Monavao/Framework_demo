<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 18/09/18
 * Time: 22:46
 */

namespace Framework\Router;

class Route
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var callable
     */
    private $callback;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $name, callable $callback, array $parameters)
    {
        $this->name       = $name;
        $this->callback   = $callback;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * Get url parameters
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->parameters;
    }
}

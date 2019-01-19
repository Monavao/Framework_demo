<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 20/01/19
 * Time: 00:43
 */

namespace Framework\Twig;

class TextExtension extends \Twig_Extension
{
    public function getFilters()
    {
        [
            new \Twig_SimpleFilter('excerpt', [$this, 'excerpt'])
        ];
    }

    public function excerpt()
    {
//        return $content;
    }
}

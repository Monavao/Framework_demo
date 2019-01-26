<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 26/01/19
 * Time: 23:10
 */

namespace App\Blog\Entity;

class Post
{
    public $id;

    public $name;

    public $slug;

    public $content;

    public $updated_at;

    public $created_at;

    public function __construct()
    {
        if ($this->created_at) {
            $this->created_at = new \DateTime($this->created_at);
        }

        if ($this->updated_at) {
            $this->updated_at = new \DateTime($this->updated_at);
        }
    }
}

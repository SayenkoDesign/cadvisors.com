<?php
/**
 * Created by PhpStorm.
 * User: rpark
 * Date: 2/11/2016
 * Time: 4:34 PM
 */

namespace App\Twig;


class Post
{
    public $author;

    public function __construct()
    {
        $this->author = new Author();
    }

    public function title()
    {
        return get_the_title();
    }

    public function content()
    {
        return get_the_content();
    }

    public function permalink() {
        return get_post_permalink();
    }
}
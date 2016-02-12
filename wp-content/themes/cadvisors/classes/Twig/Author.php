<?php

namespace App\Twig;


class Author
{
    public function first_name()
    {
        return get_the_author_meta('first_name');
    }

    public function last_name()
    {
        return get_the_author_meta('last_name');
    }

    public function bio()
    {
        return get_the_author_meta('description');
    }
}
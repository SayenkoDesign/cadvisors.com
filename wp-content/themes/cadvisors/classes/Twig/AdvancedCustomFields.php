<?php
/**
 * Created by PhpStorm.
 * User: rpark
 * Date: 2/11/2016
 * Time: 4:26 PM
 */

namespace App\Twig;


class AdvancedCustomFields
{
    public function get_field($field, $id = false, $format = true)
    {
        return get_field($field, $id, $format);
    }
}
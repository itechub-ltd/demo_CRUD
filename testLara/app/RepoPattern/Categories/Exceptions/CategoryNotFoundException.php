<?php

namespace App\Inventory\Categories\Exceptions;

class CategoryNotFoundException extends \Exception
{

public function render($request)
    {
        return "Category Not Found";
    }


}

<?php

namespace App\Inventory\Categories\Exceptions;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class CategoryInvalidArgumentException extends InvalidArgumentException
{
	public function render($request)
    {
        return "Category Invalid Argument";
    }
}

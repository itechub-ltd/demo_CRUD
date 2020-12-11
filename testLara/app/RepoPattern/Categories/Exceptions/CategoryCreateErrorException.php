<?php

namespace App\Inventory\Categories\Exceptions;

class CategoryCreateErrorException extends \Exception
{
	public function render($request)
    {
        return "Category Not Created...!
        		Somethings Error...!";
    }
}

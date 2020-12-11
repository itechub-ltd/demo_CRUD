<?php

namespace App\Shop\Products\Exceptions;

class CategoryUpdateErrorException extends \Exception
{
	public function render($request)
    {
        return "Category Not Updated";
    }

}

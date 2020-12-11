<?php

namespace App\RepoPattern\Categories\Repositories\Interfaces;
use Jsdecena\Baserepo\BaseRepositoryInterface;
// use App\RepoPattern\Categories\Category;
use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function listCategories(string $order = 'id', $except = []) : Collection;

    public function createCategory(array $params) : Category;

    public function findCategoryById(int $id) : Category;

    public function updateCategory(array $params) : Category;



    // public function deleteCategory() : bool;
    public function deleteCategory($id);

    // public function searchCategory(string $text) : Collection;

    public function rootCategories(string $string);

    public function findProducts() : Collection;


}
?>
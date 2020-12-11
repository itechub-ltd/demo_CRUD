<?php

namespace App\RepoPattern\Categories\Repositories;

//use App\RepoPattern\Tools;
use Jsdecena\Baserepo\BaseRepository;
use App\Models\Category;
use App\RepoPattern\Categories\Exceptions\CategoryInvalidArgumentException;
use App\RepoPattern\Categories\Exceptions\CategoryCreateErrorException;
use App\RepoPattern\Categories\Exceptions\CategoryNotFoundException;
use App\RepoPattern\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
// use App\RepoPattern\Tools\UploadableTrait;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    // use UploadableTrait;

    // use UploadableTrait, ProductTransformable;


    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->model = $category;
    }

    /**
     * List all the categories
     *
     * @param string $order
     * @param string $sort
     * @param array $except
     * @return \Illuminate\Support\Collection
     */
    public function listCategories(string $order = 'id', $except = []) : Collection
    {
         return $this->model
                        ->orderBy($order)
                        ->get()
                        ->except($except);

    }


    /**
     * List all root categories
     *
     * @param  string $order
     * @param  string $sort
     * @param  array  $except
     * @return \Illuminate\Support\Collection
     */


    public function rootCategories(string $order = 'id', $except = []) : Collection
    {
        return $this->model->where($order)
                        // ->orderBy($order)
                        ->get()
                        ->except($except);
    }


    /**
     * Create the category
     *
     * @param array $params
     *
     * @return Category
     * @throws CategoryInvalidArgumentException
     * @throws CategoryNotFoundException
     */
    public function createCategory(array $params) : Category
    {
        // $slug = 'sdfsdf';
        // $image= 'sdfsdf';
        try {

            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = ($params['name']);
            } else {
                $slug = "Product name";
            }
            if (isset($params['image']) && ($params['image'] instanceof UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'categories');
            }

            $merge = $collection->merge(compact('slug'));

            $category = new Category($merge->all());

            $category->save();
            return $category;

        } catch (QueryException $e) {
            throw new CategoryCreateErrorException($e->getMessage());
        }
    }

    // public function createCategory(Request $request)
    // {
    //     $category = new Category();
    //     $category->name = $request->name;
    //     $category->discount = $request->discount;
    //     $category->status = $request->status;
    //     $category->save();
    //     return $category;
    // }





    /**
     * @param int $id
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function findCategoryById(int $id) : Category
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }





     /**
     * Update the category
     *
     * @param array $params
     *
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function updateCategory(array $params) : Category
    {
        // $category = $this->findCategoryById($this->model->id);
        $category = $this->findCategoryById($this->model->id);
        $collection = collect($params)->except('_token');
        $slug = ($collection->get('name'));



        $merge = $collection->merge(compact('slug'));

        // set parent attribute default value if not set
        $params['parent'] = $params['parent'] ?? 0;

        // If parent category is not set on update
        // just make current category as root
        // else we need to find the parent
        // and associate it as child
        if ( (int)$params['parent'] == 0) {
            $category->save();
        } else {
            $parent = $this->findCategoryById($params['parent']);
            $category->parent()->associate($parent);
        }

        $category->update($merge->all());

        return $category;
       ;
    }

    /**
     * Delete a category
     *
     * @return bool
     * @throws \Exception
     */
    // public function deleteCategory() : bool
    public function deleteCategory($id)
    {
        // return $this->model->delete();

        $item = $this->findCategoryById($id);
        // $item->tasks()->delete();
        $item->delete();
        return $item;
    }



    /**
     * Return all the products associated with the category
     *
     * @return mixed
     */
    public function findProducts() : Collection
    {
        return $this->model->products;
    }

    // public function searchCategory(string $text) : Collection
    // {
    //     if (!empty($text)) {
    //         return $this->model->searchCategory($text);
    //         // @dd($this->model->searchCategory($text));
    //         // return "ok";
    //     } else {
    //         return $this->listCategories();
    //     }
    // }



}

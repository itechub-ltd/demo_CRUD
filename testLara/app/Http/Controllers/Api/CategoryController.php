<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RepoPattern\Categories\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories();
        // @dd($categories);
        return response()->json([
            'success' => true,
            'message' => 'Category List',
            'data'    => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $validator = \Validator::make($formData, [
            'name' => 'required|unique:categories|max:50',
            // 'image' => 'mimes:jpeg,jpg,png',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'image' => 'image',

        ], [
            'name.required' => 'Please give Category name',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors' => $validator->getMessageBag(),
            ]);
        }

        $category =   $this->categoryRepository->createCategory($request->except('_token', '_method'));
        return response()->json([
            'success' => true,
            'message' => 'Category Stored',
            'data'    => $category
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findCategoryById($id);
        if (is_null($category)) {
            return response()->json([
                'success' => false,
                'message' => 'category Details',
                'data'    => null
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'category Details',
            'data'    => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formData = $request->all();
        $validator = \Validator::make($formData, [
            'name' => 'required|max:50',

        ], [
            'name.required' => 'Please give Category name',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors' => $validator->getMessageBag(),
            ]);
        }

        $category = $this->categoryRepository->findCategoryById($id);

        $update = new CategoryRepository($category);
        $update->updateCategory($request->except('_token', '_method'));
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Category Update',
            'data'    => $update
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->categoryRepository->findCategoryById($id);
        if (is_null($item)) {
            return response()->json([
                'success' => false,
                'message' => 'Category Not found',
                'data' => null,
            ]);
        }else{

        $item = $this->categoryRepository->deleteCategory($id);
        return response()->json([
            'success' => true,
            'message' => 'Category Deleted',
            'data'    => $item
        ]);
        }


    }
}

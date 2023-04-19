<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\category\CreateCategoryRequest;
use App\Http\Requests\category\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private Category $category;

    /**
     * Class constructor.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = Category::all();
        return view('page.category.category',['categories' => $categories, 'status' => StatusEnum::cases()]);
    }


    public function create()
    {
        return view('page.category.add-category', ['status' => StatusEnum::cases()]);

    }


    public function store(CreateCategoryRequest $request)
    {
        $this->category->create($request->validated());
        redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('page.category.edit-category', ['status' => StatusEnum::cases(), 'category' => $category]);
    }

    public function update(EditCategoryRequest $request,Category $category)
    {
        $request->validated();
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->save();
        return redirect('/category');
    }

   
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/category');
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Utils\ProductMapper;
use App\Http\Requests\product\EditProductRequest;
use App\Http\Requests\product\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSale;
use App\Services\Contract\ProductService;
use App\Utils\FileUpload;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    private ProductService $productService;
    
    private Product $product;

    /**
     * Class constructor.
     */
    public function __construct(ProductService $productService, Product $product)
    {
        $this->productService = $productService;
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->productService->getAllProduct();
        return view('page.product.product',['products' => $products]);
    }


    public function create()
    {
        $activeCategories = Category::where("status",StatusEnum::ACTIVE)->get();
        return view('page.product.add-product', ['status' => ProductStatusEnum::cases(), 'categories' =>$activeCategories ]);
    }

 
    public function store(CreateProductRequest $request)
    {   
        $product = $request->validated();
        $image = $this->productService->handleUploadImage($request->file('image_path'));
        $product['image_path'] = $image;
        $this->productService->createProduct($product);
        return redirect('/product');
    }


    public function show($id)
    {
        //
    }

 
    public function edit( Product $product)
    {
        $activeCategories = Category::where("status",StatusEnum::ACTIVE)->get();

        return view('page.product.edit-product', ['status' => ProductStatusEnum::cases(), 'product' => $product,'categories' =>$activeCategories ]);
    }


    public function update(EditProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $image = $this->productService->handleUploadImage($request->file('image_path'));
        if(!empty($image)){
            $product['image_path'] = $request->product_name;
        }
        $this->productService->updateProduct($data, $product);
        return redirect('/product');
    }

   
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/product');
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Utils\ProductMapper;
use App\Http\Requests\product\EditProductRequest;
use App\Http\Requests\product\CreateProductRequest;
use App\Models\Product;
use App\Services\Contract\ProductService;
use App\Utils\FileUpload;
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
        return view('page.product.add-product', ['status' => ProductStatusEnum::cases()]);
    }

 
    public function store(CreateProductRequest $request)
    {
        $request->validated();
        $image = $this->productService->handleUploadImage($request->file('image_path'));
        $product = $request->validated();
        $product['image_path'] = $image;
        $this->product->create($product);
        

        return redirect('/product');
    }


    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        $product = $this->productService->getProductBySku($id);
        return view('page.product.edit-product', ['status' => ProductStatusEnum::cases(), 'product' => $product]);
    }


    public function update(EditProductRequest $request, $sku)
    {
        $request->validated();
        $product = $this->productService->getProductBySku($sku);
        $image = $this->productService->handleUploadImage($request->file('image_path'));
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        if(!empty($image)){
            $product->image_path = $request->product_name;
        }
        $product->link_url_shopee = $request->link_url_shopee;
        $product->link_url_tokopedia = $request->link_url_tokopedia;
        $product->status = $request->status;
        $product->save();
        return redirect('/product');
    }

   
    public function destroy($sku)
    {
        $product = $this->productService->getProductBySku($sku);
        $product->delete();
        return redirect('/product');
    }
}

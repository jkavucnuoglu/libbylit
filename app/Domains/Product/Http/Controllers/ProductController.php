<?php
namespace App\Domains\Product\Http\Controllers;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService|StoreProductRequest $productService)
    {
        $this->productService = $productService;
    }

    // List Products
    public function index(Request $request)
    {
        $products = $this->productService->getProducts($request);
        return Inertia::render('Product/ProductIndex', ['products' => $products]);
    }

    // Store a new product
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return $this->index($request);
    }

    // Update an existing product
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->update($product, $request->validated());
        return new ProductResource($product);
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}

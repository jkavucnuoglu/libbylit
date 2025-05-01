<?php

namespace App\Domains\Product\Services;

use App\Domains\Product\Models\Product;
use App\Domains\Supplier\Models\Supplier;
use Illuminate\Support\Collection;

class ProductService
{
    public function getProducts($request)
    {
        return Product::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
                $query->orWhere('sku', 'like', '%' . $request->search . '%');
                $query->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data)
    {
        return $product->update($data);
    }

    public function deleteProduct(Product $product)
    {
        return $product->delete();
    }

    public function getProductById(int $id)
    {
        return Product::find($id);
    }

    public function getProductBySku(string $sku)
    {
        return Product::where('sku', $sku)->first();
    }

    public function getProductByName(string $name)
    {
        return Product::where('name', $name)->first();
    }

    public function getAllSuppliers(): Collection
    {
        return Supplier::get(['name', 'id']);
    }
}

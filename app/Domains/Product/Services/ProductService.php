<?php

namespace App\Domains\Product\Services;

use App\Domains\Product\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct()
    {
    }

    public function getProducts(Request $request): LengthAwarePaginator
    {
        $query = Product::query();

        if ($request->has('search') && $request->get('search') !== '' && $request->get('search') !== null) {
            $query->where('name', 'like', $request->get('search') . '%');
            $query->orWhere('email', 'like', $request->get('search') . '%');
            $query->orWhere('phone', 'like', $request->get('search') . '%');
            $query->orWhere('address', 'like', $request->get('search') . '%');
            $query->orWhere('url', 'like', $request->get('search') . '%');
        }

        return $query->paginate(
            $request->get('per_page', config('app.pagination.default.per_page')),
            ['*'],
            'page',
            $request->get('page', 1)
        );
    }

    public function getProductById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    public function updateProduct(Product $supplier, array $data): ?Product
    {
        if (!$supplier) {
            throw new Exception('Product not found.');
        }

        $supplier->update($data);

        return $supplier;
    }

    public function deleteProduct(Product $id): bool
    {
        if ($id) {
            return $id->delete();
        }

        return false;
    }
}

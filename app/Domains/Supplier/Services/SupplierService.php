<?php

namespace App\Domains\Supplier\Services;

use App\Domains\Supplier\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierService
{
    public function __construct()
    {
    }

    public function getSuppliers(Request $request): LengthAwarePaginator
    {
        $query = Supplier::query();

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

    public function getSupplierById(int $id): ?Supplier
    {
        return Supplier::find($id);
    }

    public function createSupplier(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function updateSupplier($supplier, array $data): ?Supplier
    {
        $supplier = Supplier::find($supplier);

        if (!$supplier) {
            throw new Exception('Supplier not found.');
        }

        $supplier->update($data);

        return $supplier;
    }

    public function deleteSupplier(int $id): bool
    {
        $supplier = $this->getSupplierById($id);

        if ($supplier) {
            return $supplier->delete();
        }

        return false;
    }
}

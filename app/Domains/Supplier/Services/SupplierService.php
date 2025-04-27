<?php

namespace App\Domains\Inventory\Services;

use App\Domains\Inventory\Models\Inventory;
use App\Domains\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierService
{
    public function __construct()
    {
    }

    public function getSuppliers(): Collection
    {
        return Supplier::all();
    }

    public function getSupplierById(int $id): ?Supplier
    {
        return Supplier::find($id);
    }

    public function createSupplier(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function updateSupplier(int $id, array $data): ?Supplier
    {
        $supplier = $this->getSupplierById($id);

        if ($supplier) {
            $supplier->update($data);
            return $supplier;
        }

        return null;
    }

    public function deleteSupplier(int $id): bool
    {
        $supplier = $this->getSupplierById($id);

        if ($supplier) {
            return $supplier->delete();
        }

        return false;
    }

    public function getInventory(int $supplierId): ?Inventory
    {
        return $this->getSupplierById($supplierId)->inventory;
    }
}

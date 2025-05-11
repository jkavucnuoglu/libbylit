<?php

namespace App\Domains\Material\Services;

use App\Domains\Material\Models\Material;
use App\Domains\Supplier\Models\Supplier;
use Illuminate\Support\Collection;
use Rinvex\Categories\Models\Category;

class MaterialService
{
    public function getMaterials($request)
    {
        return Material::query()
            ->with(['supplier', 'categories'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
                $query->orWhere('sku', 'like', '%' . $request->search . '%');
                $query->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(config('app.pagination.default.per_page', 15))
            ->through(function ($material) {
                $material->image = $material->getFirstMedia('materials');
                return $material;
            });
    }

    public function createMaterial(array $data): Material
    {
        $material = Material::make(array_diff_key($data, array_flip(['images', 'category'])));

        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $material->addMedia($image)
                    ->toMediaCollection('material');
            }
        }

        $material->save();

        if (isset($data['categories'])) {
            foreach ($data['categories'] as $category) {
                $category = Category::firstOrCreate(['name' => $data['category'], ['name' => $data['category']]]);
                $material->attachCategories($category->id);
            }
        }

        return $material;
    }

    public function updateMaterial(Material $material, array $data): bool
    {
        return $material->update($data);
    }

    public function deleteMaterial(Material $material): ?bool
    {
        return $material->delete();
    }

    public function getMaterial(Material $material): Material
    {
        $material->image = $material->getFirstMedia('materials');
        return $material->load(['supplier', 'categories']);
    }

    public function getMaterialById(int $id): ?Material
    {
        return Material::find($id);
    }

    public function getMaterialBySku(string $sku): ?Material
    {
        return Material::where('sku', $sku)->first();
    }

    public function getMaterialByName(string $name): ?Material
    {
        return Material::where('name', $name)->first();
    }

    public function getAllSuppliers(): Collection
    {
        return Supplier::get(['name', 'id']);
    }

    public function getAllUnits(): Collection
    {
        return collect(config('cartalyst.converter.measurements'));
    }

    public function getAllCategories(): Collection
    {
        return Category::get(['name', 'id']);
    }
}

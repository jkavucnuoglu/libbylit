<?php

namespace App\Domains\Material\Http\Controllers;

use App\Domains\Material\Http\Requests\MaterialCreateRequest;
use App\Domains\Material\Models\Material;
use App\Domains\Material\Services\MaterialService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MaterialController extends Controller
{
    public function __construct(protected MaterialService $materialService)
    {}
    public function index(Request $request): Response
    {
        return Inertia::render('Materials/Materials', [
            'materials' => $this->materialService->getMaterials($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $units = $this->materialService->getAllUnits();

        return Inertia::render('Materials/Material',[
            'suppliers' => $this->materialService->getAllSuppliers(),
            'categories' => $this->materialService->getAllCategories(),
            'units' => $units,
            'disableEdit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialCreateRequest $request)
    {
        $this->materialService->createMaterial($request->validated());
        return redirect()
            ->route('materials.index')
            ->with('success', 'Material created successfully!')
            ->setStatusCode(303);
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $id): Response
    {
        return Inertia::render('Materials/Material', [
            'material' => $this->materialService->getMaterial($id),
            'suppliers' => $this->materialService->getAllSuppliers(),
            'categories' => $this->materialService->getAllCategories(),
            'units' => $this->materialService->getAllUnits(),
            'disableEdit' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $id): Response
    {
        return Inertia::render('Materials/Material', [
            'material' => $this->materialService->getMaterial($id),
            'suppliers' => $this->materialService->getAllSuppliers(),
            'categories' => $this->materialService->getAllCategories(),
            'units' => $this->materialService->getAllUnits(),
            'disableEdit' => false,
        ]);
    }

    public function update(Material $id, MaterialCreateRequest $request)
    {
        $this->materialService->updateMaterial($id, $request->validated());

        return redirect()->route('materials.index')->with('success', 'Material updated successfully!')->setStatusCode(303);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        //
    }
}

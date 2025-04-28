<?php

namespace App\Domains\Supplier\Http\Controllers;

use App\Domains\Supplier\Http\Requests\SupplierRequest;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Services\SupplierService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    public function __construct(private SupplierService $supplierService)
    {}

    public function index(Request $request)
    {
        return Inertia::render('Supplier/SupplierIndex', [
            'suppliers' => $this->supplierService->getSuppliers($request)
        ]);
    }

    public function store(SupplierRequest $request)
    {
        $this->supplierService->createSupplier($request->validated());
        return $this->index($request);
    }

    public function update($supplier, Request $request)
    {
        $this->supplierService->updateSupplier($supplier, $request->all());
        return $this->index($request);
    }

    public function edit($id)
    {
        return Inertia::render('Supplier/SupplierEdit', [
            'supplierId' => $id,
        ]);
    }

    public function show($id)
    {
        return Inertia::render('Supplier/SupplierShow', [
            'supplierId' => $id,
        ]);
    }

    public function list(): JsonResponse
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }
}

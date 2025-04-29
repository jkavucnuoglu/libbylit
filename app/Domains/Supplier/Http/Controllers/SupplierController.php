<?php

namespace App\Domains\Supplier\Http\Controllers;

use App\Domains\Supplier\Http\Requests\SupplierRequest;
use App\Domains\Supplier\Models\Product;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Services\ProductService;
use App\Domains\Supplier\Services\SupplierService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SupplierController extends Controller
{
    public function __construct(private SupplierService $supplierService)
    {
    }

    public function index(Request $request): Response
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

    public function update(Supplier $id, SupplierRequest $request)
    {
        $this->supplierService->updateSupplier($id, $request->all());
        return $this->index($request);
    }

    public function destroy(Supplier $id): RedirectResponse
    {
        $id->delete();

        return redirect()->back()->with([
            'message' => 'Supplier deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}

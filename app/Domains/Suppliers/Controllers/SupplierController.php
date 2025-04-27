<?php

namespace App\Domains\Suppliers\Controllers;

use App\Domains\Suppliers\Models\Supplier;
use App\Domains\Suppliers\Requests\SupplierFormRequest;
use App\Domains\Suppliers\Facades\Suppliers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        return response()->json(Suppliers::all());
    }

    public function store(SupplierFormRequest $request)
    {
        $supplier = Suppliers::create($request->validated());
        return response()->json($supplier);
    }

    public function update(SupplierFormRequest $request, Supplier $supplier)
    {
        $supplier = Suppliers::update($supplier, $request->validated());
        return response()->json($supplier);
    }

    public function destroy(Supplier $supplier)
    {
        Suppliers::delete($supplier);
        return response()->json(['success' => true]);
    }
}

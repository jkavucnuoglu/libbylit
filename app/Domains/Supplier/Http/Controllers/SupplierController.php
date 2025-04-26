<?php

namespace App\Domains\Supplier\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SupplierController extends Controller
{
    public function index()
    {
        return Inertia::render('Supplier/SupplierIndex');
    }
}

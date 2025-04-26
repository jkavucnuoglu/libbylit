<?php

namespace App\Domains\Inventory\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Inventory/Index');
    }
}

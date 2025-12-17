<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductLog;

class ProductLogController extends Controller
{
    public function index()
    {
        $logs = ProductLog::latest()->paginate(10); // paginate 10 per page
        return view('product_logs.index', compact('logs'));
    }
}


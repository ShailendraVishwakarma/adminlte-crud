<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CsvController extends Controller
{
 public function upload(Request $request)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt'
    ]);

    $file = $request->file('csv_file');
    $data = array_map('str_getcsv', file($file));

    // Header remove
    $header = array_shift($data);

    // ✅ Only status = yes filter
    $filteredData = array_filter($data, function ($row) {
        // column index:
        // 0 = name
        // 1 = email
        // 2 = status
        return isset($row[2]) && strtolower(trim($row[2])) === 'yes';
    });

    return view('upload-csv', [
        'rows' => $filteredData
    ]);
}

}

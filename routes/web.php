<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCRUDController;
use App\Models\Company; // Add this to manually fetch companies in the route

// Resource route for CompanyCRUDController
Route::resource('companies', CompanyCRUDController::class);

Route::get('/', function () {
    $companies = Company::paginate(10); 
    return view('companies.index', compact('companies'));
});


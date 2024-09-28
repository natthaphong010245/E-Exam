<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyCRUDController extends Controller
{
   // Create Index
   public function index(Request $request) {
    $month = $request->get('month');

    if ($month) {
        $totalIncome = Company::where('transaction_type', 'รายรับ')->whereMonth('date', $month)->sum('amount');
        $totalExpenses = Company::where('transaction_type', 'รายจ่าย')->whereMonth('date', $month)->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        $companies = Company::whereMonth('date', $month)
            ->orderBy('id', 'asc')
            ->paginate(5);
    } else {
        $totalIncome = Company::where('transaction_type', 'รายรับ')->sum('amount');
        $totalExpenses = Company::where('transaction_type', 'รายจ่าย')->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        $companies = Company::orderBy('id', 'asc')->paginate(5);
    }

    return view('companies.index', compact('totalIncome', 'totalExpenses', 'balance', 'companies'));
}




    // Create resource
    public function create() {
        return view('companies.create');
    }

    // Store resource
    public function store(Request $request) {
        $request->validate([
            'date' => 'required',
            'transaction_type' => 'required',
            'list' => 'required',
            'amount' => 'required'
            
        ]);

        $company = new Company;
        $company->date = $request->date;
        $company->transaction_type = $request->transaction_type;
        $company->list = $request->list;
        $company->amount = $request->amount;
        $company->save();
        return redirect()->route('companies.index')->with('success', 'เพิ่มรายรับรายจ่ายประจำเดือน สำเร็จ.');
    }

    public function edit(Company $company) {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'date' => 'required',
            'transaction_type' => 'required',
            'list' => 'required',
            'amount' => 'required'
        ]);
        $company = Company::find($id);
        $company->date = $request->date;
        $company->transaction_type = $request->transaction_type;
        $company->list = $request->list;
        $company->amount = $request->amount;
        $company->save();
        return redirect()->route('companies.index')->with('success', 'อัปเดตรายรับรายจ่ายประจำเดือน การสำเร็จ.');
    }

    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'ลบรายรับรายจ่ายประจำเดือน การสำเร็จ.');
    }
    
    


}

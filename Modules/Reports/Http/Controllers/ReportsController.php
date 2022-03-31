<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reports\DataTables\FinanceLedgerDataTable;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function financeLedger(Request $request){
    	$request->validate([
            'account_id' => 'required',
        ]);
        if($request->from_date && $request->to_date){
        	$request->validate([
            'from_date' => 'before:to_date',
        ]);
        }
        
        $dataTable = new FinanceLedgerDataTable;
        return $dataTable->render('reports::finance-ledger.index');
    }

    public function financeLedgerForm(){
        return view('reports::finance-ledger.create');
    }
}

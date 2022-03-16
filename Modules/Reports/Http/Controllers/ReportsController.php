<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reports\DataTables\FinanceLedgerDataTable;

class ReportsController extends Controller
{
    public function financeLedger(FinanceLedgerDataTable $dataTable){
        return $dataTable->render('reports::finance-ledger.index');
    }
}

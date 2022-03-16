<?php

namespace Modules\Reports\Http\Controllers;

use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reports\DataTables\FinanceLedgerDataTable;
use Modules\Transactions\Entities\FinanceLedger;

class TrailBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function index(): mixed
    {
        $model = FinanceLedger::with('account')->get()->groupBy('account_id')->map(fn($item) => [
            'account_id' => $item->first()->account_id,
            'account_name' => $item->first()->account->name,
            'debit' => $item->sum('debit'),
            'credit' => $item->sum('credit'),
            'balance' => $item->sum('debit') - $item->sum('credit')
        ]);

        return view('reports::trial-balance.index',compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('reports::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('reports::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('reports::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

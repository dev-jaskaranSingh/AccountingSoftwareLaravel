<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Transactions\Entities\FinanceLedger;

class TrailBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function index(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
        ]);

        $date = $request->date;

        $model = DB::select("SELECT
            account_name,
            bill_date,
            IF((bal + opbal) > 0,
            bal + opbal,
            0) AS debit,
            IF(bal + opbal < 0, ABS(bal + opbal),
            0) AS credit
        FROM
            (
            SELECT
                account_id,
                account_name,
                account_masters.account_type,
                finance_ledger.bill_date,
                IF(
                    account_masters.account_type = 'debit',
                    account_masters.opening_balance,
                    account_masters.opening_balance * -1
                ) AS opbal,
                SUM(debit - credit) AS bal
            FROM
                `finance_ledger`
            INNER JOIN account_masters ON finance_ledger.account_id = account_masters.id
            WHERE
                finance_ledger.bill_date <= '".$date."'
            GROUP BY
                account_id
        ) AS A");

        return view('reports::trial-balance.index', compact('model'));
    }

    /**
     * @return array|false|Application|Factory|View|mixed
     */
    public function trailBalanceForm()
    {
        return view('reports::trial-balance.create');
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

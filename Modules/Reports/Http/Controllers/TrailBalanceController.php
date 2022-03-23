<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transactions\Entities\FinanceLedger;

class TrailBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function index(Request $request): mixed
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $model = FinanceLedger::with('account')->where(['bill_date' => $request->date])->get()->groupBy('account_id')->map(fn($item) => [
            'account_id' => $item->first()->account_id,
            'account_name' => $item->first()->account->name,
            'debit' => $item->sum('debit'),
            'credit' => $item->sum('credit'),
            'balance' => $item->sum('debit') - $item->sum('credit'),
            'bill_date' => $item->first()->bill_date
        ]);

        return view('reports::trial-balance.index', compact('model'));
    }

    /**
     * @return Application|array|null|View|Factory|false
     */
    public function trailBalanceForm(): Application|array|null|bool|View|Factory
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

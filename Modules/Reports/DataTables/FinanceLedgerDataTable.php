<?php

namespace Modules\Reports\DataTables;


use Modules\Transactions\Entities\FinanceLedger;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
use DB;

class FinanceLedgerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {

        return datatables()->eloquent($query)
            ->editColumn('created_at', function ($model) {
                if (is_null($model->created_at)) return null;
                return $model->created_at->format('d-m-Y h:i:s A');
            })
            ->editColumn('account_name', function ($model) {
                if (is_null($model->account_name)) return null;
                return $model->account_name;
            })
            ->editColumn('created_by', function ($model) {
                if (is_null($model->user)) return null;
                return $model->user->name;
            })
            ->editColumn('bill_type', function ($model) {
                if (is_null($model->bill_type)) return null;
                return str_replace('_',' ',strtoupper($model->bill_type));
            })->editColumn('balance', function ($model) {
                
                if (is_null($model->balance)) return null;
                return $model->balance;
            })->addColumn('Total', function ($model) {
                
                if (is_null($model->balance)) return null;
                return $model->balance;
            })->addColumn('total', function ($model) {
            return 0 + 
                   0 +
                    0 +
                    0 +
                    0 +
                    0 +
                    0;
        })
        ->addIndexColumn()
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param FinanceLedger $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FinanceLedger $model): \Illuminate\Database\Eloquent\Builder
    {
       
        $openongBlnc = DB::table('account_masters')->where('id',request()?->account_id)->first();
        $fnledgers = DB::table('finance_ledger')->where('account_id',request()?->account_id)->get();
        $opnblncType = $openongBlnc->account_type;
        $opnblnc = $openongBlnc->opening_balance;
        foreach ($fnledgers as $key => $fnledger) {
               $credit = 0;
               $debit = 0;
                if($fnledger->credit){
                 $credit = $fnledger->credit;
                }
                if($fnledger->debit){
                 $debit = $fnledger->debit;
                }
                if($opnblncType == "credit"){
                    $ttl = $opnblnc+$debit-$credit;
                    $balance = $ttl;
                }else{
                 $ttl = $opnblnc+$debit-$credit;
                    $balance = $ttl;
                }
        $opnblnc = $balance;


            DB::table('finance_ledger')->where('id',$fnledger->id)->update(['balance' => $balance]);
            
        }

        $result = $model->newQuery()->when(!is_null(request()->from_date),function ($query) {
                return $query->where('account_id',request()?->account_id)->where('bill_date','<=',Carbon::createFromFormat('d-m-Y', request()?->to_date)->format('d-m-Y'))->where('bill_date','>=',Carbon::createFromFormat('d-m-Y', request()?->from_date)->format('d-m-Y'));})->with(['account', 'account.accountGroup','user'])->orderBy('id','asc');
        return $result;

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('finance-ledger-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ajax()
  ->drawCallback('function() { $("#total").val( this.api().ajax.json().total ) }')
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [Column::make('bill_date')->title('Date')->width(70),
            Column::make('account_name')
                ->title('Account Name')
                ->orderable(false)
                ->width(70)
                ->searchable(false),
            Column::make('bill_type')->title('Voucher Type')->width(70),
            Column::make('bill_number')->title('Voucher Number')->width(70),
            Column::make('debit')->title('Debit')->width(70),
            Column::make('credit')->title('Credit')->width(70),
            Column::make('balance')->title('Balance')->width(70),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ContraFinanceLedger_' . date('YmdHis');
    }
}

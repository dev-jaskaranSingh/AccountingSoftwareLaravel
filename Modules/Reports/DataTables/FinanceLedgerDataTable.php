<?php

namespace Modules\Reports\DataTables;


use Modules\Transactions\Entities\FinanceLedger;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

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
            ->editColumn('account_group_name', function ($model) {
                if (is_null($model->account->accountGroup)) return null;
                return $model->account->accountGroup->name;
            })
            ->editColumn('created_by', function ($model) {
                if (is_null($model->user)) return null;
                return $model->user->name;
            })
            ->editColumn('bill_type', function ($model) {
                if (is_null($model->bill_type)) return null;
                return str_replace('_',' ',strtoupper($model->bill_type));
            })
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
        return $model->newQuery()
            ->when(!is_null(request()->account_id),function ($query) {
                return $query->where('account_id',request()?->account_id);
            })->with(['account', 'account.accountGroup','user'])
            ->orderBy('id','asc');
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
        return [Column::make('id')->width(40),
            Column::make('account_name')->title('Account Name')->width(80),
            Column::make('account_group_name')
                ->title('Account Group')
                ->orderable(false)
                ->width(70)
                ->searchable(false),
            Column::make('bill_type')->title('Bill Type')->width(70),
            Column::make('bill_number')->title('Bill Number')->width(70),
            Column::make('bill_date')->title('Bill Date')->width(70),
            Column::make('credit')->title('Credit')->width(70),
            Column::make('debit')->title('Debit')->width(70),
            Column::make('created_by')->title('Created BY'),
            Column::make('created_at')
                ->title('Created At')];
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

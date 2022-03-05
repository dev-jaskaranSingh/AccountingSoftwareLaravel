<?php

namespace Modules\Transactions\DataTables;


use Modules\Transactions\Entities\FinanceLedger;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        return datatables()->eloquent($query)->editColumn('action', function ($model) {
            return view('transactions::receipts._action', compact('model'));
        })->editColumn('created_at', function ($model) {
            if (is_null($model->created_at)) return null;
            return $model->created_at->format('d-m-Y h:i:s A');
        })->rawColumns(['action']);
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
            ->where('bill_type', 'Payment')
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()->setTableId('receipts-datatable-table')->columns($this->getColumns())->minifiedAjax()->dom('Bfrtip')->orderBy(1)->buttons(Button::make('create'), Button::make('export'), Button::make('print'), Button::make('reset'), Button::make('reload'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [Column::make('id'),
            Column::make('bill_type'),
            Column::make('bill_number'),
            Column::make('account_name'),
            Column::make('instr_type'),
            Column::make('instrument_no'),
            Column::make('instrument_date'),
            Column::make('credit')->title('Credit Amount'),
            Column::make('debit')->title('Debit Amount'),
            Column::make('created_at')
                ->title('Created At'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('150px')
                ->addClass('text-center'),];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'FinanceLedger_' . date('YmdHis');
    }
}

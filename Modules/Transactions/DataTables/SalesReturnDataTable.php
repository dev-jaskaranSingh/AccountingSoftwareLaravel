<?php

namespace Modules\Transactions\DataTables;


use Modules\Transactions\Entities\Purchase;
use Modules\Transactions\Entities\Sale;
use Modules\Transactions\Entities\SaleReturn;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalesReturnDataTable extends DataTable
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
            return view('transactions::sales._action', compact('model'));
        })->editColumn('account_id', function ($model) {
            if ($model->account == null) return null;
            return $model->account->name;
        })->editColumn('invoice_number', function ($model) {
            $fromYear = \Carbon\Carbon::parse(authCompany()->from_date)->format('y');
            $toYear = \Carbon\Carbon::parse(authCompany()->to_date)->format('y');
            return 'SB/' . $fromYear . '-' . $toYear . '/' . $model->invoice_number;
        })->editColumn('created_at', function ($model) {
            if (is_null($model->created_at)) return null;
            return $model->created_at->format('d-m-Y h:i:s A');
        })->rawColumns(['is_primary', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param SaleReturn $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SaleReturn $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()->with('account');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()->setTableId('sales-datatable-table')->columns($this->getColumns())->minifiedAjax()->dom('Bfrtip')->orderBy(1)->buttons(Button::make('create'), Button::make('export'), Button::make('print'), Button::make('reset'), Button::make('reload'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [Column::make('id'), Column::make('account_id')->title('Party Name'), Column::make('invoice_number')->title('Invoice Number'), Column::make('bill_date')->title('Bill Date'), Column::make('grand_total_amount')->title('Amount'), Column::make('created_at')->title('Created At'), Column::computed('action')->exportable(false)->printable(false)->width('150px')->addClass('text-center'),];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Purchase_' . date('YmdHis');
    }
}

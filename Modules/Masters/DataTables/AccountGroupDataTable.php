<?php

namespace Modules\Masters\DataTables;


use Modules\Masters\Entities\AccountGroup;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AccountGroupDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($model) {
                return view('masters::account_group._action', compact('model'));
            })->editColumn('sub_group',function($model){
                if(is_null($model->parent)) return '-';
                return $model->parent->pluck('name')->implode(', ');
            })->editColumn('is_primary',function($model){
                return $model->is_primary ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
            })->editColumn('created_at', function ($model) {
                if (is_null($model->created_at)) return null;
                return $model->created_at->format('d-m-Y h:i:s A');
            })->rawColumns(['is_primary', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param AccountGroup $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AccountGroup $model)
    {
        return $model->newQuery()->with('parent')->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('account-group-datatable-table')
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
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('is_primary')->title('Is Primary'),
            Column::make('sub_group')->title('Sub Group'),
            Column::make('created_at')->title('Created At'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('150px')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AccountGroup_' . date('YmdHis');
    }
}

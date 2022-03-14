{{--<a href="{{ route('transactions.sales.show',$model->id) }}" class="" data-id="{{ $model->id }}"><i--}}
{{--        class="fa fa-eye text-info"></i></a> |--}}
{{--<a href="{{ route('transactions.sales.edit',$model->id) }}" class="" data-id="{{ $model->id }}"><i--}}
{{--        class="fa fa-pencil text-warning"></i></a> |--}}
<a href="{{ route('transactions.sales-return.print',$model->id) }}" class="" data-id="{{ $model->id }}"><i
        class="fa fa-print text-dark"></i></a> |
{!! Form::open(['method'=>'DELETE','route'=>['transactions.sales-return.destroy',$model->id],'class'=>'delete-form','style'=>'display:inline']) !!}
<a href="javascript:void(0)" class="delete-row"><i class="fa fa-trash text-danger"></i></a>
{!! Form::close() !!}

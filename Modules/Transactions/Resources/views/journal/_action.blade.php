{{--<a href="{{ route('transactions.journal.show',$model->id) }}" class="" data-id="{{ $model->id }}"><i--}}
{{--        class="fa fa-eye text-info"></i></a> |--}}
{{--<a href="{{ route('transactions.journal.edit',$model->first_transaction_no) }}" class=""--}}
{{--   data-id="{{ $model->first_transaction_no }}"><i--}}
{{--        class="fa fa-pencil text-warning"></i></a> |--}}
{!! Form::open(['method'=>'DELETE','route'=>['transactions.journal.destroy',$model->first_transaction_no],'class'=>'delete-form','style'=>'display:inline']) !!}
<a href="javascript:void(0)" class="delete-row"><i class="fa fa-trash text-danger"></i></a>
{!! Form::close() !!}

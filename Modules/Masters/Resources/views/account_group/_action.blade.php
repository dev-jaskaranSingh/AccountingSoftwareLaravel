<a href="{{ route('master.account-group.show',$model->id) }}" class="" data-id="{{ $model->id }}"><i
        class="fa fa-eye text-info"></i></a> |
<a href="{{ route('master.account-group.edit',$model->id) }}" class="" data-id="{{ $model->id }}"><i
        class="fa fa-pencil text-warning"></i></a> |
{!! Form::open(['method'=>'DELETE','route'=>['master.account-group.destroy',$model->id],'class'=>'delete-form','style'=>'display:inline']) !!}
<a href="javascript:void(0)" class="delete-row"><i class="fa fa-trash text-danger"></i></a>
{!! Form::close() !!}

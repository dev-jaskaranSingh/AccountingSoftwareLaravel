
<a href="{{ route('admin.users.show',$model->id) }}" class="edit-appointment" data-id="{{ $model->id }}"><i class="fa fa-eye text-info"></i></a> |
<a href="{{ route('admin.users.edit',$model->id) }}" class="edit-appointment" data-id="{{ $model->id }}"><i class="fa fa-pencil text-warning"></i></a> |
{!! Form::open(['method'=>'DELETE','route'=>['admin.users.destroy',$model->id],'class'=>'delete-form','style'=>'display:inline']) !!}
<a href="javascript:void(0)" class="delete-row"><i class="fa fa-trash text-danger"></i></a>
{!! Form::close() !!}

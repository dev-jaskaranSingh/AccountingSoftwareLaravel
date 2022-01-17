<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Account Group <small>Account Group create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-2 col-sm-12 mb-3 text-center">
                        {!! Form::label('is_primary','Is Primary') !!}
                        {!! Form::checkbox('is_primary',null,false,['class'=>'form-control is_primary']) !!}
                        @error('is_primary')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3 subgroup">
                        {!! Form::label('sub_group_id','Select Sub Group') !!}
                        {!! Form::select('sub_group_id',\Modules\Masters\Entities\ItemGroupMaster::pluck('name','id')->prepend('Select',null),null,['class'=>'form-control select ']) !!}
                        @error('sub_group_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('scripts')
    <script>
        $('.is_primary').on('change',function () {
            if($(this).is(':checked')){
                $('.subgroup').hide();
            }else{
                $('.subgroup').show();
            }
        });
    </script>
@endsection

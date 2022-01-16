<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create User <small>User create form</small></h5>
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
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('email','Email') !!}
                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                        @error('email')
                        <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('mobile','Mobile') !!}
                        {!! Form::text('mobile',null,['class'=>'form-control']) !!}
                        @error('mobile')
                        <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                    @if(Route::currentRouteName() == 'admin.users.create')
                        <div class="col-md-6 col-sm-12 mb-3">
                            {!! Form::label('password','Password') !!}
                            {!! Form::text('password',null,['class'=>'form-control password']) !!}
                            @error('password')
                            <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            {!! Form::label('password_confirmation','Confirm Password') !!}
                            {!! Form::text('password_confirmation',null,['class'=>'form-control password']) !!}
                            @error('password_confirmation')
                            <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    @endif
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('is_active','Status') !!}
                        {!! Form::select('is_active',[0 =>'Inactive', 1 => 'Active'],null,['class'=>'form-control select2']) !!}
                        @error('is_active')
                        <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('is_admin','Is Admin') !!}
                        {!! Form::select('is_admin',[0 =>'Inactive', 1 => 'Active'],null,['class'=>'form-control select2']) !!}
                        @error('is_admin')
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

@endsection

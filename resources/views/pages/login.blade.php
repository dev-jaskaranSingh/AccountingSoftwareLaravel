@extends('layouts.auth')
@section('content')
    <div class="middle-box loginscreen animated fadeInDown mt-5">
        <div>
            <center>
                <img src="https://hospital.ripungupta.com/public/images/core.png" width="40%"/>
            </center>
            <br/>
            <h3>Welcome to Accounting Software</h3>
            <p>Login in. To see it in action.</p>
            <br/>
            @if(request()->route()->getPrefix() == '/user')
                @php($isEmployee = true)
                <h4>Employee Login</h4>
            @else
                @php($isEmployee = false)
                <h4>Admin Login</h4>
            @endif
            @if($isEmployee)
                {!! Form::open(['route'=>'user.login.now']) !!}
                {!! Form::hidden('type','user') !!}
            @else
                {!! Form::open(['route'=>'admin.login.now']) !!}
                {!! Form::hidden('type','admin') !!}
            @endif
            @if($isEmployee == true)
                <div class="form-group">
                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Employee Code','autocomplete'=>'off']) !!}
                    @error('email')
                    <span class="help-block">
                                {{ $message }}
                            </span>
                    @enderror
                </div>
            @else
                <div class="form-group">
                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email','autocomplete'=>'off']) !!}
                    @error('email')
                    <span class="help-block">
                                {{ $message }}
                            </span>
                    @enderror
                </div>
            @endif
            <div class="form-group">
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                @error('password')
                <span class="help-block">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::select('company_id',['company_1','company_2'],null,['class'=>'form-control select2','placeholder'=>'Company']) !!}
                @error('company_id')
                <span class="help-block">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            {!! Form::submit('Login',['class'=>'btn btn-primary block full-width m-b']) !!}
            {!! Form::close() !!}
            <p class="m-t"><small>Core Accounting Software &copy; {{ date('Y') }}</small></p>
        </div>
    </div>
@endsection

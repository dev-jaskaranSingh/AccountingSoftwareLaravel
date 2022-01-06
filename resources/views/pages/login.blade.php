@extends('layouts.auth')
@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown mt-5">
        <div>
            <div>
                <img src="https://core-solutions.in/wp-content/uploads/2017/03/core-solution-amritsar-website-development.png" />
            </div>
            <h3>Welcome to Core Payroll</h3>
            <p>Login in. To see it in action.</p>
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
                {!! Form::open(['route'=>'login.now']) !!}
                {!! Form::hidden('type','admin') !!}
            @endif
                @if($isEmployee == true)
                    <div class="form-group">
                        {!! Form::text('user_code',null,['class'=>'form-control','placeholder'=>'Employee Code','autocomplete'=>'off']) !!}
                        @error('user_code')
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
                {!! Form::submit('Login',['class'=>'btn btn-primary block full-width m-b']) !!}
            {!! Form::close() !!}
            <p class="m-t"> <small>Core Payroll &copy; 2020</small> </p>
        </div>
    </div>
@endsection

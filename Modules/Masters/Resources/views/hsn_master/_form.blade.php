<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Account Group <small>Account Group create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('hsn_code','Hsn code') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('hsn_code',null,['class'=>'form-control']) !!}
                        @error('hsn_code')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('min_amount','Min Amount') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::number('min_amount',null,['class'=>'form-control']) !!}
                        @error('min_amount')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('gst_min_percentage','GST Min (%)') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::number('gst_min_percentage',null,['class'=>'form-control']) !!}
                        @error('gst_min_percentage')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('gst_max_percentage','GST Max (%)') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::number('gst_max_percentage',null,['class'=>'form-control']) !!}
                        @error('gst_max_percentage')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('hsn_description','HSN Description') !!}
                        {!! Form::textarea('hsn_description',null,['class'=>'form-control']) !!}
                        @error('hsn_description')
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

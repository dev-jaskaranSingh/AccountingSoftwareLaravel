<style>
    .hot-container {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .address {
        height: 100px;
    }

    .filterHeader input {
        width: 90%;
        margin: 0 auto 10px;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5> {!! getCurrentRouteTitle() !!}</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('date','Select Date') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('date',now()->format('Y-m-d'),['class'=>'form-control datepicker']) !!}
                        @error('date')
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

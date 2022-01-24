<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Purchase <small>Purchase create form</small></h5>
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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="handsontable"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        const data = [];

        const container = document.getElementById('handsontable');
        const hot = new Handsontable(container, {
        data: data,
            colWidths: [140, 126, 192, 100, 100, 90, 90, 110, 97],
            colHeaders: [
                "Item",
                "HSN",
                "Unit",
                "Gross WT",
                "Net WT",
                "Rate",
                "Qty",
                "Amount",
            ],
            columns: [
                { data: 1, type: "text" },
                { data: 2, type: "text" },
                { data: 3, type: "text" },
                { data: 4, type: "numeric"},
                { data: 5, type: "numeric", className: "htMiddle"},
                { data: 6, type: "numeric", readOnly: true, className: "star htCenter"},
                { data: 7, type: "numeric", className: "htMiddle"},
                { data: 8, type: "numeric", readOnly: true, className: "star htCenter"}
            ],
            dropdownMenu: false,
            hiddenColumns: {
                indicators: true
            },
            contextMenu: true,
            multiColumnSorting: true,
            filters: true,
            rowHeaders: true,
            manualRowMove: true,
            licenseKey: "non-commercial-and-evaluation"
        });
    </script>

@endsection

@php
    $model = $model?->load('saleItems.item','account.state');
@endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
        /* Box sizing rules */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* Remove default padding */
        ul[class],
        ol[class] {
            padding: 0;
        }

        /* Remove default margin */
        body,
        h1,
        h2,
        h3,
        h4,
        p,
        ul[class],
        ol[class],
        li,
        figure,
        figcaption,
        blockquote,
        dl,
        dd {
            margin: 0;
        }

        /* Set core body defaults */
        body {
            min-height: 100vh;
            scroll-behavior: smooth;
            text-rendering: optimizeSpeed;
            line-height: 1.5;
        }

        /* Remove list styles on ul, ol elements with a class attribute */
        ul[class],
        ol[class] {
            list-style: none;
        }

        /* A elements that don't have a class get default styles */
        a:not([class]) {
            text-decoration-skip-ink: auto;
        }

        /* Make images easier to work with */
        img {
            max-width: 100%;
            display: block;
        }

        /* Natural flow and rhythm in articles by default */
        article > * + * {
            margin-top: 1em;
        }

        /* Inherit fonts for inputs and buttons */
        input,
        button,
        textarea,
        select {
            font: inherit;
        }

        .text-primary {
            color: #3e3eda !important;
        }

        tr {
            line-height: 24px !important;
        }

        td {
            font-size: 15px !important;
        }

        tr > td {
            padding-left: 15px !important;
        }

        th {
            font-size: 15px !important;
        }

        /* Remove all animations and transitions for people that prefer not to see them */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        .headerBorder {
            border-top: 2px solid rgb(55, 55, 55) !important;
            border-left: 2px solid rgb(55, 55, 55) !important;
            border-right: 2px solid rgb(55, 55, 55) !important;
        }

        .col-md-6,
        .col-md-6 {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }

        .row {
            margin-right: 0px !important;
            margin-left: 0px !important;
        }

    </style>

</head>

<body class="px-4">
<header class="mt-4 row headerBorder p-2">
    <div class="col-md-3 col-sm-3 text-center d-flex align-items-center">
        <div class="d-flex justify-content-center w-100">
            <div class="text-left">
                <h5>GST:</h5>
                <h5>03AZYPS9562J1ZC</h5>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 text-center">
        <h4>AJAB'S GRACE</h4>
        <strong>GST INVOICE</strong>
        <h1 class="text-primary" style="font-family: Algerian;font-size: 50px;">SINGH ENTERPRISES</h1>
        377,PARTAP AVENUE,PHASE-2,G.T.ROAD,AMRITSAR-143001,PUNJAB<br/>
        <b>TEL: 0183-5153221. MOB:9815595183</b><br/>
        Email : hstinu@gmail.com<br/>
        <br/>
        <i style="font-size: 10px;">( INPUT TAX CREDIT IS AVAILABLE TO A TAXABLE PERSON AGAINST THIS COPY )</i>
    </div>
    <div class="col-md-3 col-sm-3 d-flex align-items-center justify-content-center w-100">
        <div class="d-flex justify-content-center w-100">
            <img src="{{asset('/logo.png')}}" class="w-50">
        </div>
    </div>
</header>
<section class="border"
         style="border: 2px solid rgb(55, 55, 55)!important;border-bottom: 2px solid transparent!important">
    <div class="row">
        <div class="col-md-6" style="border-right: 2px solid rgb(55, 55, 55)!important;padding: 15px!important;">
            <table>
                <tr>
                    <th width="25%">BILLED TO</th>
                    <td>:</td>
                    <td>{{ $model?->account?->address }}</td>
                </tr>
                <tr>
                    <th width="25%">GSTIN</th>
                    <td>:</td>
                    <td>{{ $model?->account?->gstin ?? '-' }}</td>
                </tr>
                <tr>
                    <th width="25%">PAN</th>
                    <td>:</td>
                    <td>{{ $model?->account?->pan }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6" style="padding: 15px!important;">
            <table>
                <tr>
                    <th width="25%">INVOICE NO</th>
                    <td>:</td>
                    @php

                        $invoiceNumber = $model?->invoice_number;
                        $fromYear = \Carbon\Carbon::parse(authCompany()->from_date)->format('y');
                        $toYear = \Carbon\Carbon::parse(authCompany()->to_date)->format('y');
                        $finalInvoice = 'SB/'.$fromYear.'-'.$toYear.'/'.$invoiceNumber;
                    @endphp
                    <td>{{ $finalInvoice }}</td>
                </tr>
                <tr>
                    <th width="25%">DATED</th>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($model?->bill_date)->format('d-M-Y') }}</td>
                </tr>
                <tr>
                    <th width="25%">PLACE OF SUPPLY</th>
                    <td>:</td>
                    <td>{{ $model?->account?->state->name }}</td>
                </tr>
                <tr>
                    <th width="25%">STATE CODE</th>
                    <td>:</td>
                    <td>{{ $model?->account?->state->tin }}</td>
                </tr>
                <tr>
                    <th width="25%">SHIPPED TO</th>
                    <td>:</td>
                    <td>{{ $model?->shipped_to }}</td>
                </tr>
            </table>
        </div>
    </div>
</section>
<table class="w-100" border="2">
    <thead>
    <tr>
        <th class="text-center">Sr</th>
        <th class="text-center">DESCRIPTION</th>
        <th class="text-center">HSN</th>
        <th class="text-center">GROSS WT</th>
        <th class="text-center">NET WT</th>
        <th class="text-center">RATE/GM</th>
        <th class="text-center">AMOUNT</th>
        <th class="text-center">UNITS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($model?->saleItems as $key => $purchaseItem)
        <tr>
            <td>{{++$key}}</td>
            <td>{{ $purchaseItem->item->name }}</td>
            <td>{{ $purchaseItem->hsn_code }}</td>
            <td>{{$purchaseItem->gross_wt}}</td>
            <td>{{$purchaseItem->net_wt}}</td>
            <td>{{$purchaseItem->rate_gm}}</td>
            <td>{{$purchaseItem->amount}}</td>
            <td>{{$purchaseItem->unit}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td>
            <b>TOTAL</b><br/>
            <b>ADD TCS@0.1%</b><br/>
            <b>ADD IGST@0.1%</b><br/>
            <br/><br/>
            <b>ROUND OFF</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <div>
                <span>{{ $model?->total_amount ?? '0.00' }}  ₹</span><br/>
                <span>{{ $model?->tcs ?? '0.00' }}  ₹</span><br/>
                <span>{{ $model?->igst ?? '0.00' }} ₹</span><br/>
                <br/><br/>
                <span>{{ $model?->round_off_value ?? '0.00' }} ₹</span>
            </div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td style="line-height: 40px !important;"></td>
        <td style="line-height: 40px !important;"><b>GRAND TOTAL :</b></td>
        <td style="line-height: 40px !important;"></td>
        <td style="line-height: 40px !important;">{{round($model?->saleItems->sum('gross_wt',2))}}</td>
        <td style="line-height: 40px !important;">{{round($model?->saleItems->sum('net_wt',2))}}</td>
        <td style="line-height: 40px !important;"></td>
        <td style="line-height: 40px !important;"><strong>₹ {{ $model?->grand_total_amount }}</strong></td>
        <td style="line-height: 40px !important;"></td>
    </tr>
    <tr>
        <td style="line-height: 60px !important;"></td>
        <td style="line-height: 60px !important;" colspan="1"><b>TOTAL AMOUNT IN WORDS:</b></td>
        <td style="line-height: 60px !important;" colspan="6">
            <b>{{ getIndianCurrency($model?->grand_total_amount) }}</b></td>
    </tr>
    <tr>
        <td></td>
        <td><b>HSN/SAC</b></td>
        <td><b>TAXABLE VALUE</b></td>
        <td></td>
        <td><b>IGST</b></td>
        <td><b>TCS</b></td>
        <td><b>TOTAL TAX</b></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>-</td>
        <td>₹ {{ $model?->total_discount }}</td>
        <td><b>TAX RATE</b></td>
        <td>3%</td>
        <td>0.100%</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <h5>TOTAL</h5>
        </td>
        <td><b>₹ {{ $model?->igst ?? '0.00' }}</b></td>
        <td></td>
        <td><b>₹ {{ $model?->igst }}</b></td>
        <td><b>₹ {{ $model?->tcs ?? '0.00' }}</b></td>
        <td><b>₹ {{ $model?->igst + $model?->tcs }}</b></td>
        <td></td>
    </tr>
    <tr>
        <td style="line-height: 60px !important;"></td>
        <td style="line-height: 60px !important;" colspan="1"><b>TOTAL TAX IN WORDS:</b></td>
        <td style="line-height: 60px !important;"
        @if($model?->gold_price)
            colspan="4"
        @else
            colspan="6"
        @endif>
            <b>{{ getIndianCurrency($model?->igst + $model?->tcs) }}</b>
        </td>
        @if($model?->gold_price)
            <td style="line-height: 60px !important;">
                <b>24k Gold Price : {{ $model?->gold_price }}</b>
            </td>
        @endif
    </tr>
    <tr>
        <td colspan="8" align="center" style="padding: 25px;">
            <h4><i><u>DECLARATION</u></i></h4>
            <br/>
            <h4 style="color: red;font-family: Consolas;font-size: 30px;font-weight: bolder;">SINGH ENTERPRISES
            </h4>
            <br/>
            <h5>ICICI BANK A/C NO: 189305000820, IFSC CODE: ICIC0001893</h5>
            <h5>BRANCH: 100 FT ROAD, EAST MOHAN NAGAR, AMRITSAR, PUNJAB</h5>
            <h5>PAN : AZYPS9562J</h5>
        </td>
    </tr>
    </tbody>
</table>
<table class="w-100" border="2" style="border-top: transparent;padding: 15px !important;">
    <tr>
        <td width="40%">
            <h5>
                <u>
                    TERMS & CONDITIONS E. & OE.
                </u>
            </h5>
            <b>1. GOODS ONCE SOLD WILL NOT BE TAKEN BACK</b><br/>
            <b>2. INTEREST @ 18%P.A. WILL BE CHARGED<br/>
                &nbsp;&nbsp;&nbsp; IF THE PAYMENT IS NOT MADE<br/>
                &nbsp;&nbsp;&nbsp; WITH IN THE STIPULATED TIME.</b><br/>
            <b>3. SUBJECT TO PUNJAB JURISDICTION ONLY.</b>

        </td>
        <td style="vertical-align: bottom;" align="center">
            <h5>RECEIVER'S SIGNATURE</h5>
        </td>
        <td width="33%" align="right" style="vertical-align: top;padding: 15px!important;">
            <h4>FOR SINGH ENTERPRISES</h4>
            <br/><br/><br/><br/>
            <b>AUTHORIZED SIGNATORY</b>
        </td>
    </tr>
</table>
{{--<script>--}}
{{--    window.print();--}}
{{--</script>--}}
</body>
</html>

@extends('admin.layout')
@section('content')
    <div class="container my-4 border border-dark">
        <div class="my-4">
            <div class="row justify-content-between">
                <div class="col-md-6 col-sm-6 text-left">
                    <h4><strong>Car</strong> Details</h4>
                    <ul class="list-unstyled">
                        <li><strong>Invoice No:</strong> {{$invoice['invoice_number']}}</li>
                        <li><strong>VIN:</strong> {{$invoice['vin']}}</li>
                        <li><strong>License Plate:</strong> {{$invoice['license_plate']}}</li>
                        <li><strong>Brand:</strong> {{$invoice['brand']}}</li>
                        <li><strong>Model:</strong> {{$invoice['model']}}</li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 text-start">
                    <h4><strong>Owner</strong> Details</h4>
                    <ul class="list-unstyled">
                        <li><strong>Name:</strong> {{$client['name']}}</li>
                        <li><strong>Last Name:</strong> {{$client['last_name']}}</li>
                        <li><strong>Phone:</strong> {{$client['phone']}}</li>
                        <li><strong>Email:</strong> {{$client['email']}}</li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive pb-2">
                <h5>Part</h5>
                <table class="table table-condensed table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-5">Item Part</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoiceParts as $invoicePart)
                        @if($invoicePart->job_type == $invoicePart->typePart)
                            <tr>
                                <td>
                                    <div><strong>{{$invoicePart['name']}}</strong></div>
                                    <small>Stock No: {{$invoicePart['stock_no']}}</small>
                                </td>
                                <td>{{$invoicePart['ConvertedQuantity']}}</td>
                                <td>{{$invoicePart['price'] . $currency}}</td>
                                <td>{{$invoicePart['totalPrice'] . $currency}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive py-2">
                <h5>Liquid</h5>
                <table class="table table-condensed table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-5">Item Liquid</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoiceParts as $invoicePart)
                        @if($invoicePart->job_type == $invoicePart->typeLiquid)
                            <tr>
                                <td>
                                    <div><strong>{{$invoicePart['name']}}</strong></div>
                                </td>
                                <td>{{$invoicePart['ConvertedQuantity']}}</td>
                                <td>{{$invoicePart['price'] . $currency}}</td>
                                <td>{{$invoicePart['totalPrice'] . $currency}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive pt-2">
                <h5>Work</h5>
                <table class="table table-condensed table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-5">Item Work</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoiceParts as $invoicePart)
                        @if($invoicePart->job_type == $invoicePart->typeWork)
                            <tr>
                                <td>
                                    <div><strong>{{$invoicePart['name']}}</strong></div>
                                </td>
                                <td>{{$invoicePart['ConvertedQuantity']}}</td>
                                <td>{{$invoicePart['price'] . $currency}}</td>
                                <td>{{$invoicePart['totalPrice'] . $currency}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h4><strong>Invoice</strong> Details</h4>
                    <p class="nomargin nopadding">
                        <strong>Mechanic:</strong>
                        {{$mechanicName}}
                    </p>
                    <p>
                        <strong>Created At :</strong>
                        {{$invoice['created_at']}}
                    </p>
                </div>
                <div class="col text-right">
                    <ul class="list-unstyled">
                        <li><strong>Grand Total:</strong>{{$invoice['total_price'] . $currency}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
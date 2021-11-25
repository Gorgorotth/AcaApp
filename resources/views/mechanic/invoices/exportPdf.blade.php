<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice PDF</title>
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
</head>
<body>
<div class="container my-xl-4 border border-dark">
    <div class="my-4">
        <div class="row">
            <div class="col-md-6 col-sm-6 text-left">
                <h4><strong>Car</strong> Details</h4>
                <ul class="list-unstyled">
                    <li><strong>VIN:</strong> {{$invoice['vin']}}</li>
                    <li><strong>License Plate:</strong> {{$invoice['license_plate']}}</li>
                    <li><strong>Brand:</strong> {{$invoice['brand']}}</li>
                    <li><strong>Model:</strong> {{$invoice['model']}}</li>
                </ul>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-condensed nomargin">
                <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoiceParts as $invoicePart)
                    <tr>
                        <td>
                            <div><strong>{{$invoicePart['name']}}</strong></div>
                            <small>Stock No: {{$invoicePart['stock_no']}}</small>
                        </td>
                        <td>{{$invoicePart['quantity']}}</td>
                        <td>{{$invoicePart['price'] . $currency}}</td>
                        <td>{{$invoicePart['total_price'] . $currency}}</td>
                    </tr>
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
</body>
</html>
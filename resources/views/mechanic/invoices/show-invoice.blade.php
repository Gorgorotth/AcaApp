@extends('mechanic.sidebar')
@section('main-content')
    <div class="row">
        <div class="col-md-6 text-left">
            <h4><strong>Car</strong> Details</h4>
            <ul class="list-unstyled">
                <li><strong>Invoice No:</strong> {{$invoice['invoice_number']}}</li>
                <li><strong>VIN:</strong> {{$invoice['vin']}}</li>
                <li><strong>License Plate:</strong> {{$invoice['license_plate']}}</li>
                <li><strong>Brand:</strong> {{$invoice['brand']}}</li>
                <li><strong>Model:</strong> {{$invoice['model']}}</li>
            </ul>
        </div>
        <div class="col-md-6 col-sm-6 text-left">
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
                <th class="col-md-2">Quantity</th>
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
                <th class="col-md-2">Quantity</th>
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
                <th class="col-md-2">Quantity</th>
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
        <div class="col-md-6 text-right">
            <ul class="list-unstyled">
                <li><strong>Grand Total:</strong>{{$invoice['total_price'] . $currency}}</li>
            </ul>
            <div>
                <a class="btn btn-info"
                   href="{{route('mechanic.exportInvoiceToPdf', ['invoiceId' => $invoice['id']])}}">
                    <i class="entypo-upload">EXPORT TO PDF</i>
                </a>
                <button type="button" class="btn btn-orange"
                        onclick="$('#deleteModal').modal('toggle' , function () {$('#deleteModal').scrollIntoView()}, {focus: 'true'}, {backdrop: 'static'});">
                    <i class="entypo-trash">DELETE INVOICE</i>
                </button>
                <form method="post"
                      action="{{route('mechanic.deleteInvoice', ['invoiceId' => $invoice['id']])}}">
                    @csrf
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal"
                         aria-hidden="true" data-focus="true" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger text-center">
                                        DELETE INVOICE???
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">
                                        <i>CANCEL</i>
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="entypo-trash">DELETE</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
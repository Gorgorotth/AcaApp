@extends('mechanic.layout')
@section('content')
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
                    <div>
                        <a class="btn btn-outline-info" href="#">EXPORT TO PDF</a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                            DELETE INVOICE
                        </button>
                        <form method="post" action="{{route('mechanic.deleteInvoice', ['invoiceId' => $invoice['id']])}}">
                            @csrf
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger text-center">
                                                DELETE INVOICE???
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                CANCEL
                                            </button>
                                            <button type="submit" class="btn btn-primary">DELETE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
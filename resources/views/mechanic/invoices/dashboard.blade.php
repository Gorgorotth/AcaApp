@extends('mechanic.layout')
@section('content')
    <div class="container">
        <div class="list-group">
            <div class="row justify-content-between my-4">
                <form method="get" action="{{route('mechanic.dashboard')}}" class="d-flex col-sm-4">
                    <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search"
                           value="{{request('search')}}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                <form method="get" action="{{route('mechanic.dashboard')}}" class="col-sm-2">
                    <button class="btn btn-primary" value="{{$orderBy}}" name="sortByCreatedDate" type="submit">Sort by date</button>
                </form>
            </div>
            <div class="container">
                <div class="row mt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th class="col-md-2">
                                Date
                            </th>
                            <th class="col-md-2">
                                Invoice #
                            </th>
                            <th class="col-md-2">
                                VIN
                            </th>
                            <th class="col-md-2">
                                License Plate
                            </th>
                            <th class="col-md-1">
                                Cost
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr class="text-center">
                                <th>
                                    {{$invoice->created_at}}
                                </th>
                                <th>
                                    //Invoice number\
                                </th>
                                <th>
                                    {{$invoice->vin}}
                                </th>
                                <th>
                                    {{$invoice->license_plate}}
                                </th>
                                <th>
                                    {{$invoice->total_price}}
                                </th>
                                <th class="col-md-2">
                                    <a href="{{route('mechanic.showInvoice', ['invoiceId' => $invoice->id])}}" class="page-link">Show invoice</a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
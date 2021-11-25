@extends('admin.layout')
@section('content')
    <div class="container">
        <div class="list-group">
            <div class="d-flex justify-content-between my-4">
                <form method="get" action="{{route('admin.dashboard')}}"
                      class="d-flex justify-content-between align-content-center col-sm-11">
                    <div class="d-flex justify-content-between">
                        <input class="form-control me-2" type="text" name="search" placeholder="Search"
                               aria-label="Search"
                               value="{{request('search')}}">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </form>
                <form method="get" action="{{route('admin.dashboard')}}" class="col-sm-2">
                    <div class="end-50">
                        <input type="hidden" name="sortByCreatedDate" value="{{$orderBy}}">

                        <input hidden name="search" placeholder="Search" aria-label="Search"
                               value="{{request('search')}}">
                        <button class="text-start btn btn-primary" type="submit">Sort by date</button>
                    </div>
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
                                Invoice No
                            </th>
                            <th class="col-md-2">
                                VIN
                            </th>
                            <th class="col-md-3">
                                Customer Name
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
                                    {{$invoice['created_at']}}
                                </th>
                                <th>
                                    {{$invoice['invoice_number']}}
                                </th>
                                <th>
                                    {{$invoice['vin']}}
                                </th>
                                <th>
                                    {{$invoice['client']['name']}}
                                </th>
                                <th>
                                    {{$invoice['total_price']}}
                                </th>
                                <th>
                                    <a href="{{route('admin.show-invoice', ['invoiceId' => $invoice->id])}}"
                                       class="page-link">Show invoice</a>
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
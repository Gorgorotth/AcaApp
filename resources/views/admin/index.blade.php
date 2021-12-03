@extends('admin.sidebar')
@section('main-content')
    <div class="row page-title">
        <h2 class="col-md-6">Invoices</h2>
        <div class="page-title-controls col-md-6">
            <form method="get" action="{{route('admin.dashboard')}}"
                  class="col-sm-8">
                <div class="row">
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="search" placeholder="Search"
                               aria-label="Search"
                               value="{{request('search')}}">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-green" type="submit">
                            <i class="entypo-search">Search</i>
                        </button>
                    </div>
                </div>
            </form>
            <form method="get" action="{{route('admin.dashboard')}}" class="col-sm-4">
                <div class="end-50">
                    <input type="hidden" name="sortByCreatedDate" value="{{$orderBy}}">
                    <input hidden name="search" placeholder="Search" aria-label="Search"
                           value="{{request('search')}}">
                    <button class="text-start btn btn-primary" type="submit">Sort by date</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered responsive">
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
                    <th class="col-md-2 text-center">
                        Show
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
                        <th class="text-center">
                            <a href="{{route('admin.show-invoice', ['invoiceId' => $invoice->id])}}"
                               class="btn btn-sm btn-info">
                                <i class="entypo-doc-text-inv">Show</i>
                            </a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
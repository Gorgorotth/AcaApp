@extends('mechanic.layout')
@section('content')
    <div class="list-group mx-5 ">
        @foreach($invoices as $invoice)
            <a href="{{route('mechanic.showInvoice', ['invoiceId' => $invoice->id])}}" class="list-group-item list-group-item mt-5">
                <div class="list-group-action">
                    <p>{{$invoice->license_plate}}</p>
                    <p class="list-group-horizontal-lg">VIN</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
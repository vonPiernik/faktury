@extends('layouts.app')

@section('page-title', "Podgląd faktury")

@section('content')

    <div id="invoiceContent">
        <h4>Faktura o id {{ $invoice->id }}</h4>
        <strong>Odbiorca: </strong>{{ $invoice->customer }} <br>
        <strong>Towary: </strong> <br>
        <table class="table table-striped"> 
            <thead>
            <tr>
                <td>Nazwa</td>
                <td>Cena</td>
                <td>Ilość</td>
                <td>Wartość netto</td>
                <td>Stawka VAT</td>
                <td>Kwota VAT</td>
                <td>Wartość brutto</td>
            </tr>
            </thead>
            <tbody>
            @foreach($invoice->items()->get() as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }} zł</td>
                    <td>{{ $item->amount }} {{ $item->unit }}</td>
                    <td>{{ $item->net_value }} zł</td>
                    <td>{{ $item->vat }}%</td>
                    <td>{{ $item->vat_value }} zł</td>
                    <td>{{ $item->gross_value }} zł</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <hr>
    <a href="#" onclick="return xepOnline.Formatter.Format('invoiceContent',
                        {pageWidth:'216mm', pageHeight:'279mm', render:'download', filename:'Faktura nr {{ $invoice->id }} dla {{ $invoice->customer }}'}
                );">
        Pobierz PDF
    </a>

@endsection


@section('pagescripts')
<script src="{{ asset('js/xepOnline.jqPlugin.js') }}"></script>



@endsection
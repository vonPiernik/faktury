@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Faktura o id {{ $invoice->id }}</div>
                <div class="panel-body">
                    <div id="invoiceContent">
                        <strong>Odbiorca: </strong>{{ $invoice->customer }} <br><br>
                        <strong>Towary: </strong> <br>
                        <table class="table table-striped"> 
                            <thead>
                            <tr>
                                <td>Nazwa</td>
                                <td>Cena</td>
                                <td>Ilość</td>
                                <td>Wartość netto</td>
                                <td>Wartość brutto</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->items()->get() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->amount }} {{ $item->unit }}</td>
                                    <td>{{ $item->net_value }}</td>
                                    <td>{{ $item->gross_value }}</td>
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
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('pagescripts')
<script src="{{ asset('js/xepOnline.jqPlugin.js') }}"></script>



@endsection
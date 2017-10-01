@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Faktura o id {{ $invoice->id }}</div>
                <div class="col-md-12">
                    <strong>Odbiorca: </strong>{{ $invoice->customer }} <br>
                    <strong>Towary: </strong>
                        @foreach($invoice->items()->get() as $item)
                            {{ $item->name }},
                        @endforeach
                </div>
                <hr>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

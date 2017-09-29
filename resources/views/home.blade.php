@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Twoje faktury</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr><td>Numer</td><td>Tytuł faktury</td><td>Data wystawienia</td></tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr><td>{{ $invoice->id }}</td><td>{{ $invoice->title }}</td><td> {{ $invoice->created_at->format('d M Y') }}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>

                    <strong>Branch faktury</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                    @if(count($invoices))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Numer</td>
                                    <td>Odbiorca faktury</td>
                                    <td>Data wystawienia</td>
                                    <td>user_id</td></tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td><a href="{{ route('faktury.show',$invoice->id) }}">{{ $invoice->customer }}</a></td>
                                        <td> {{ $invoice->created_at->format('d M Y') }}</td>
                                        <td>{{ $invoice->user_id }}</td></tr>
                                    </a>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        {{ $invoices->links() }}
                    @else
                        <h3><strong>
                            Nie utworzyłeś jeszcze żadnej faktury. Możesz to zrobić <a href="{{ route('faktury.create') }}">tutaj</a>
                        </strong></h3>
                    @endif
                    <hr>

                    <strong>Branch faktury</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

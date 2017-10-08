@extends('layouts.app')

@section('page-title', "Twoje faktury")

@section('content')
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

@endsection

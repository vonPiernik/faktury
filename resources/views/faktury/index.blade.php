@extends('layouts.app')

@section('page-title', "Twoje faktury")

@section('sub-sidebar')


    @if(count($invoices))
        <ul class="invoices-list">
                @foreach($invoices as $invoice)
                    
                    <li><a href="{{ route('faktury.show',$invoice->id) }}" @click.prevent="showInvoice({{1}})">
                        <strong>{{ $invoice->customer }}</strong>
                        <small> {{ $invoice->created_at->format('d M Y') }}</small>
                    </a></li>
                @endforeach
            </tbody>
        </ul>
        <hr>
        {{ $invoices->links() }}
    @else
        <h3><strong>
            Nie utworzyłeś jeszcze żadnej faktury. Możesz to zrobić <a href="{{ route('faktury.create') }}">tutaj</a>
        </strong></h3>
    @endif

@endsection
@section('content')

@{{ invoice.customer }}

@endsection

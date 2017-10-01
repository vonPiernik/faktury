@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Utwórz nową fakturę</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <hr>
                        Formularz dodawania nowej faktury
                    <hr>
                    <strong>Branch faktury</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

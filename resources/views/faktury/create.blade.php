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
                    <form method="POST" action="/faktury">
                        {{ csrf_field() }}

                        <div class="col-md-4">Twoje dane</div>
                        <div class="col-md-4"><label for="date">Data wystawienia</label><br>
                        </div>
                        <div class="col-md-4"><label for="date">Dane klienta</label><br>
                            <input type="text" name="customer" id="customer">
                        </div>

                        <br><br>
                        <hr>

                        <div class="col-md-12">
                            @include('faktury.items.create')
                        </div>

                        <input type="submit" value="Wyślij">

                    </form>

                    <br><hr><br>

                    <div class="col-md-12">
                        <strong>Branch faktury</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('page-title', "Utwórz nową fakturę")

@section('content')

                    <form method="POST" action="/faktury">
                        {{ csrf_field() }}

                        <!-- <dane faktury> -->
                        <div class="col-md-4">Twoje dane</div>
                        <div class="col-md-4">
                            <label for="date">Data wystawienia</label><br>
                        </div>
                        <div class="col-md-4">
                            <label for="date">Dane klienta</label><br>
                            <input type="text" name="customer" id="customer" required value="Klient">
                        </div>

                        <br><br>
                        <hr>
                        <!-- </dane faktury> -->

                        <!-- <lista elementów na fakturze> -->
                        <div class="col-md-12">
                        
                            <item-list></item-list>

                        </div>               
                        <!-- </lista elementów na fakturze> -->

                        <input type="submit" value="Wyślij">

                    </form>

@endsection

@section('pagescripts')

@endsection
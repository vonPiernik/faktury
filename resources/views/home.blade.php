@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Jesteś zalogowany

                    <hr>
                    Lista użytkowników:
                    @foreach($users as $u)
                        <li>{{ $u->name }}</li>
                    @endforeach
    
                    <hr>

                    <strong>Branch faktury</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

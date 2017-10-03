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
                            <input type="text" name="customer" id="customer" required value="Klient">
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

@section('pagescripts')
<script>
var item = 1;

$("button#add-row").on("click", function(e){
    e.preventDefault();
    item=item+1;

    var itemsRow = '<tr class="items-row items-row-'+ item +'"><td><input required type="text" value="Pozycja" name="name_'+ item +'" style="width: 100%;"></td><td><input required  min="0" value="0" type="number" name="amount_'+ item +'" style="width: 50px;"></td><td><input required type="text" value="szt." name="unit_'+ item +'" size="4"></td><td><input required  min="0" value="0" type="number" name="price_'+ item +'" style="width: 50px;"></td><td><input required  min="0" value="0" type="number" name="net_value_'+ item +'" style="width: 50px;"></td><td><input required  min="0" value="0" type="number" name="gross_value_'+ item +'" style="width: 50px;"></td><td><a href="#" id="remove-row">Usuń</a></td></tr>';

    $(itemsRow).insertAfter( ".items-row:last-child()" );
    $(".items-row-" + item).hide().fadeIn();

    $("#items_amount").val(item);
})


$(".items").on("click",'#remove-row',function(e){
    e.preventDefault();
    
    $(this).parents('tr').remove();
});

</script>
@endsection
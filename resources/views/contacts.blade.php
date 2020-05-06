@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h2>Welcome  @auth {{auth()->user()->name}} @endauth</h2>
            <br>
            <div class="card">
                <div class="card-header">Contact List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <span style="display: none;" id="user_id">{{$id}}</span>
                        <table id="table_id" class="display" style="width: 100%;border:1px black solid;">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<script>
    $(document).ready(function() { 
        const id = $('#user_id').text();
        const my_url = "http://127.0.0.1:8000/api/contacts/"+id;
        $('#table_id').DataTable( {
            "ajax": {
                "url": my_url,
                "type": "POST",
                'beforeSend': function (request) {
                    request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                }
            },
            "columns": [
                { "title": "Name", "data": "data.name", "defaultContent": "<i>-</i>"},
                { "title": "Email", "data": "data.email" ,"defaultContent": "<i>-</i>"},
                { "title": "Address", "data": "data.address" ,"defaultContent": "<i>-</i>"},
                { "title": "Postal Code", "data": "data.pcode" ,"defaultContent": "<i>-</i>"},
                { "title": "City", "data": "data.city", "defaultContent": "<i>-</i>"},
                { "title": "province", "data": "data.province" ,"defaultContent": "<i>-</i>"},
                { "title": "Country", "data": "data.country" ,"defaultContent": "<i>-</i>"},
                { "title": "Save As", "data": "data.saveas", "defaultContent": "<i>-</i>"},
                { "title": "NIF", "data": "data.nif", "defaultContent": "<i>-</i>"},
                
                { "title": "Details", "data": "id" ,"render": function ( data, type, row, meta ) {
                    return '<a class="btn btn-info" style="margin-right:5px;" href="/user/' + id+ '/contact/view/' + data + '" role="button">Details</a>';
                  }
                },
            ]
        } );    
    });
</script>
@endsection

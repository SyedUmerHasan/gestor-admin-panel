@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h2>Welcome  @auth {{auth()->user()->name}} @endauth</h2>
            <br>
            <div class="card">
                <div class="card-header">Expense List</div>

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
        const my_url = "http://127.0.0.1:8000/api/expense/"+id;
        $('#table_id').DataTable( {
            "ajax": {
                "url": my_url,
                "type": "POST",
                'beforeSend': function (request) {
                    request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                }
            },
            "columns": [
                { "title": "Client", "data": "data.client" ,"defaultContent": "<i>-</i>"},
                { "title": "Date", "data": "data" ,"render": function ( data, type, row, meta ) {
                    return data.day + ", " +data.date + " " +data.month + " " +data.year;
                  }
                },
                { "title": "IRPF", "data": "data.irpf" ,"defaultContent": "<i>-</i>"},
                { "title": "IVA", "data": "data.iva" ,"defaultContent": "<i>-</i>"},
                { "title": "Status", "data": "data.status" ,"defaultContent": "<i>-</i>"},
                { "title": "Taxable", "data": "data.taxable" ,"defaultContent": "<i>-</i>"},
                { "title": "Concept", "data": "data.concept" ,"defaultContent": "<i>-</i>"},
                { "title": "Note", "data": "data.note" ,"defaultContent": "<i>-</i>"},
                { "title": "Amount", "data": "data.amount" ,"defaultContent": "<i>-</i>"},
                { "title": "Document", "data": "data.docAddr" ,"render": function ( data, type, row, meta ) {
                    return '<a class="btn btn-primary" style="margin-right:5px;" href="' + data + '" role="button">View Doc</a>';
                  }
                },
                { "title": "Details", "data": "id" ,"render": function ( data, type, row, meta ) {
                    return '<a class="btn btn-info" style="margin-right:5px;" href="/user/' + id+ '/expense/view/' + data + '" role="button">Details</a>';
                  }
                },
            ]
        } );    
    });
</script>
@endsection

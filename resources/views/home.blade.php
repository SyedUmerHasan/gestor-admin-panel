@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h2>Welcome  @auth {{auth()->user()->name}} @endauth</h2>
            <br>
            <div class="card">
                <div class="card-header">Users List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <table id="table_id" class="display" style="width: 100%;border:1px black solid;">
                            <thead>
                                {{-- <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Profession</th>
                                    <th>NI/NIF</th>
                                    <th>Action</th>
                                </tr> --}}
                            </thead>
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
        $('#table_id').DataTable( {
            "ajax": {
                "url": "http://127.0.0.1:8000/api/users",
                "type": "GET"
            },
            "columns": [
                { "title": "First Name", "data": "data.fname", "defaultContent": "<i>-</i>"},
                { "title": "Last Name", "data": "data.lname", "defaultContent": "<i>-</i>"},
                { "title": "Email", "data": "data.email", "defaultContent": "<i>-</i>"},
                { "title": "Phone Number", "data": "data.phonenumber" ,"defaultContent": "<i>-</i>"},
                { "title": "Profession", "data": "data.profession" ,"defaultContent": "<i>-</i>"},
                { "title": "Expense", "data": "id" ,"render": function ( data, type, row, meta ) {
                    return '<a class="btn btn-warning" style="margin-right:5px;" href="/expense/' + data + '" role="button">Expenses</a>';
                  }
                },
                { "title": "Income", "data": "id" ,"render": function ( data, type, row, meta ) {
                    return'<a class="btn btn-success" style="margin-right:5px;" href="/income/' + data + '" role="button">Incomes</a>';
                  }
                },
                { "title": "Contacts", "data": "id" ,"render": function ( data, type, row, meta ) {
                    return '<a class="btn btn-primary" href="/contacts/' + data + '" role="button">Contacts</a>';
                  }
                },
                { "title": "Details", "data": "id" ,"render": function ( data, type, row, meta ) {
                    return '<a class="btn btn-info" href="/user/' + data+'" role="button">View</a>';
                  }
                }
            ]
        } );    
    });
</script>
@endsection

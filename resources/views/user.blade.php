@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h2>Welcome  @auth {{auth()->user()->name}} @endauth</h2>
            <br>
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('alert'))
                <div class="alert alert-danger">{{ Session::get('alert') }}</div>
            @endif
            @if (Session::has('warning'))
                <div class="alert alert-warning">{{ Session::get('warning') }}</div>
            @endif
            <span style="display: none;" id="user_id">{{$id}}</span>
            
            <div class="card">
                <div class="card-header">
                    User Details
                    <span class="clearfix">
                        <a name="" id="" class="btn btn-info float-right" href="{{ route('user.edit', $id) }}" role="button"> Edit User</a>
                        <span class="spinner-border float-right" role="status" style="padding: 15px" id="loader">
                          <span class="sr-only">Loading...</span>
                        </span>
                    </span>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-inverse" style="">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Field</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">Name</td>
                                            <td>
                                                <div class="form-group">
                                                  <input type="text"
                                                    class="form-control" id="name" aria-describedby="helpId" disabled placeholder="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Profile Picture</td>
                                            <td>
                                                <img src="" class="img-fluid rounded-circle" style="width: 100px" id="image" alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Email Address</td>
                                            <td>
                                                <div class="form-group">
                                                  <input type="text"
                                                    class="form-control" id="email" aria-describedby="helpId" disabled placeholder="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Plan</td>
                                            <td>
                                                <div class="form-group">
                                                  <input type="text"
                                                    class="form-control" id="plan" aria-describedby="helpId" disabled placeholder="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Describe</td>
                                            <td>
                                                <div class="form-group">
                                                  <input type="text"
                                                    class="form-control" id="describe" aria-describedby="Describe" disabled placeholder="">
                                                </div>
                                            </td>
                                        </tr>
                                        
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
    {{-- swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        button: "Aww yiss!",
      }); --}}

    $(document).ready(function() { 
        const id = $('#user_id').text();
        const my_url = "http://127.0.0.1:8000/api/user/"+id;

        $.ajax({
            url: my_url,
            type: "GET",
            success: function (response) {
            console.log("response", response)
                $('#loader').hide();

                $('#image').attr('src', response.data.profilepic);
                $("#name").val(response.data.fname +" " +response.data.lname);
                $("#email").val(response.data.email);
                $("#plan").val(response.data.plan);
                $("#describe").val(response.data.describe);

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });

    });
</script>
@endsection

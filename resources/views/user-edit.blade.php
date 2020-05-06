@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h2>Welcome  @auth {{auth()->user()->name}} @endauth</h2>
            <br>
            
            <span style="display: none;" id="user_id">{{$id}}</span>
            <div class="card">
                <div class="card-header">
                    User Details
                    <span class="clearfix">
                        <a name="" id="" class="btn btn-info float-right" href="{{ route('user', $id) }}" role="button"> View User</a>
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
                                        <form action="{{ route('user.update', $id) }}" method="post">
                                            @csrf
                                            <tr>
                                                <td scope="row">First Name</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="fname" name="fname" aria-describedby="helpId"  placeholder="Enter First Name">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Last Name</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="lname" name="lname" aria-describedby="helpId"  placeholder="Enter Last Name">
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
                                                        class="form-control" id="email" aria-describedby="helpId" disabled placeholder="Enter Email Address">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Plan</td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control" name="plan" id="plan">
                                                        <option value="Basic">Basic</option>
                                                        <option value="Premium">Premium</option>
                                                        <option value="Annual Premium">Annual Premium</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Describe</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="describe" name="describe" aria-describedby="Describe"  placeholder="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"></td>
                                                <td>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </form>
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
                $("#fname").val(response.data.fname);
                $("#lname").val(response.data.lname);
                $("#email").val(response.data.email);
                $("#plan").val(response.data.plan);
                $("#describe").val(response.data.describe);
                $("#planstatus").val(response.data.planstatus);

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });

    });
</script>
@endsection

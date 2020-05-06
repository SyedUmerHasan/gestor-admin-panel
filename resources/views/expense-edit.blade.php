@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <span class="clearfix">
                <h2 class="float-left" >Welcome  @auth {{auth()->user()->name}} @endauth</h2>
                <a style="margin: 0px 5px;"  class="btn btn-info float-right" href="{{ route('expense.view', [$userid, $expenseid]) }}" role="button"> View Expense</a>
                <a style="margin: 0px 5px;"  class="btn btn-info float-right" href="{{ route('user', [$userid]) }}" role="button"> View User</a>
                <span class="spinner-border float-right" role="status" style="padding: 15px" id="loader">
                  <span class="sr-only">Loading...</span>
                </span>
            </span>
            <br>
            
            <span style="display: none;" id="user_id">{{$userid}}</span>
            <span style="display: none;" id="expense_id">{{$expenseid}}</span>
            <div class="card">
                <div class="card-header">
                    <h5>
                        Edit Expense Details
                    </h5>
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
                                        <form action="{{ route('expense.update', [$userid, $expenseid]) }}" method="get">
                                            @csrf
                                            <tr>
                                                <td scope="row">Client</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="Client" name="Client" aria-describedby="helpId" disabled placeholder="Enter Client Name">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Date</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="date" name="date" aria-describedby="helpId" disabled placeholder="Enter Date">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">IRPF</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control" id="irpf" name="irpf" aria-describedby="helpId"  placeholder="Enter IRPF">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Status</td>
                                                <td>
                                                    <div class="form-group">
                                                      <select class="form-control" name="status" id="status">
                                                        <option value="PENDING">PENDING</option>
                                                        <option value="REVISE">REVISE</option>
                                                      </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Plan</td>
                                                <td>
                                                    <div class="form-group">
                                                      <input type="text" class="form-control" name="taxable" id="taxable" aria-describedby="helpId" placeholder="Enter Taxable">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Concept</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="concept" name="concept" aria-describedby="Describe"  placeholder="Enter Concept">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Note</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="note" name="note" aria-describedby="Describe"  placeholder="Enter Note">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Amount</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="amount" name="amount" aria-describedby="Describe"  placeholder="Enter Amount">
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
        const user = $('#user_id').text();
        const expense = $('#expense_id').text();
        const my_url = "http://127.0.0.1:8000/api/user/" + user + "/expense/" + expense ;

        $.ajax({
            url: my_url,
            type: "GET",
            success: function (response) {
            console.log("response", response)
                $('#loader').hide();

                $('#Client').attr('src', response.data.profilepic);
                $("#date").val(response.data.day+ " " + response.data.date+ " " + response.data.month+ " " + response.data.year);
                $("#irpf").val(response.data.irpf);
                $("#status").val(response.data.status);
                $("#taxable").val(response.data.taxable);
                $("#concept").val(response.data.concept);
                $("#note").val(response.data.note);
                $("#amount").val(response.data.amount);

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });

    });
</script>
@endsection

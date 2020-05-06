@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <span class="clearfix">
                <h2 class="float-left">Welcome  @auth {{auth()->user()->name}} @endauth</h2>
                <a style="margin: 0px 5px;" class="btn btn-info float-right" href="{{ route('contact.edit', [$userid, $contactid]) }}" role="button"> Edit Contact</a>
                <a  style="margin: 0px 5px;" name="" id="" class="btn btn-info float-right" href="{{ route('user.edit', [$userid]) }}" role="button"> Edit user</a>
                <span class="spinner-border float-right" role="status" style="padding: 15px" id="loader">
                  <span class="sr-only">Loading...</span>
                </span>
            </span>
            <br>
            
            <span style="display: none;" id="user_id">{{$userid}}</span>
            <span style="display: none;" id="contact_id">{{$contactid}}</span>
            <div class="card">
                <div class="card-header">
                    <h4>View Contact Details</h4>
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
                                                        class="form-control" id="name" name="name" aria-describedby="helpId" disabled placeholder="Enter Client Name">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Email Address</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="email" name="email" aria-describedby="helpId" disabled placeholder="Enter Date">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Postal Code</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control" id="pcode" name="pcode" aria-describedby="helpId"disabled  placeholder="Enter IRPF">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">City</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control" id="city" name="city" aria-describedby="helpId"disabled  placeholder="Enter IRPF">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Province</td>
                                                <td>
                                                    <div class="form-group">
                                                      <input type="text" class="form-control" name="province" id="province" disabled aria-describedby="helpId" placeholder="Enter Taxable">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Country</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="country" name="country" aria-describedby="Describe"  disabled placeholder="Enter Concept">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Save As</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="saveas" name="saveas" aria-describedby="Describe" disabled placeholder="Enter Note">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">NIF</td>
                                                <td>
                                                    <div class="form-group">
                                                    <input type="text"
                                                        class="form-control" id="nif" name="nif" aria-describedby="Describe" disabled placeholder="Enter Amount">
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

    $(document).ready(function() { 
        const user = $('#user_id').text();
        const contact = $('#contact_id').text();
        const my_url = "http://127.0.0.1:8000/api/user/" + user + "/contact/" + contact ;

        $.ajax({
            url: my_url,
            type: "GET",
            success: function (response) {
            console.log("response", response)
                $('#loader').hide();

                $("#city").val(response.data.city);
                $("#country").val(response.data.country);
                $("#pcode").val(response.data.pcode);
                $("#name").val(response.data.name);
                $("#saveas").val(response.data.saveas);
                $("#email").val(response.data.email);
                $("#province").val(response.data.province);
                $("#nif").val(response.data.nif);
                $("#address").val(response.data.address);

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });

    });
</script>
@endsection

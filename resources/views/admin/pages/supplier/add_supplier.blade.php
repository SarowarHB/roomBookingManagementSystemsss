@extends('admin/masterdashboard')
@section('title')
Home
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Supplier</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="supplierAdd">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="">Supplier Name <span class="text-danger">*</span></label>
                                    <input type="text" required  class="form-control" name="name" id="name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Phone<span class="text-danger">*</span></label>
                                    <input type="number" required class="form-control" name="phone" id="phone">
                                    <span class="text-danger error-text phone_error"></span>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 ">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="text" required class="form-control" name="email" id="email">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">State<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control" name="state" id="state">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" name="city" id="city">
                                </div>
                                <div class="col-md-6 ">
                                    <label for="">Supplier Address <span class="text-danger">*</span> </label>
                                    <input type="text" required class="form-control" name="address" id="address">
                                    <span class="text-danger error-text address_error"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" name="country" id="country">
                                </div>
                                <div class="col-md-6 ">
                                    <label for="">Previous Credit Balance</label>
                                    <input type="text" class="form-control" name="credit_balance" id="credit_balance">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="">Supplier Details</label>
                                    <textarea name="details" class="form-control" id="details" cols="10" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="submitBtn" class="btn btn-block btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {

        $("#supplierAdd").on('submit', function(e) {
            e.preventDefault();
            $("#submitBtn").attr('disabled', true).text('Saving...');
            $.ajax({
                url: "{{route('storesupplier')}}",
                method: 'post',
                data: new FormData(this),
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == 1) {
                        $("#submitBtn").attr('disabled', false).text('Save');
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Attribute Add Successfully.',
                        });
                    } else {
                        $("#submitBtn").attr('disabled', false).text('Save');
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'warning',
                            title: 'Some fild is Required.',
                        })
                    };
                },
                error: function() {
                    alert('something is wrong');
                }
            });
        });

    });
</script>
@endsection
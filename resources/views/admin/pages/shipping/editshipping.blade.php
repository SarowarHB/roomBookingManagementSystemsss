@extends('admin/masterdashboard')

@section('title')
Shipping City
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Cities</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shipping</li>
                    <li class="breadcrumb-item active">Shipping Cities</li>
                    <li class="breadcrumb-item active">Edit Shipping Cities</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit City Cities</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" id="editCity">
                            @csrf
                            <div class="col-md-12 form-group mb-3">
                                <label>Divisions</label>
                                <select class="form-control" name="divisions" required id="divisions">
                                    @foreach($division as $divisions)
                                    <option value="{{$divisions->id}}" {{ $divi->id===$divisions->id? 'selected':'' }}>{{$divisions->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text divisions_error"></span>
                            </div>
                            <input type="hidden" id="updateID" value="{{$upaz->id}}">
                            <div class="col-md-12 form-group mb-3">
                                <label>Districts</label>
                                <select class="form-control" name="districts" required id="districts">
                                    <option value="{{$dist->id}}">{{$dist->name}}</option>
                                </select>
                                <span class="text-danger error-text districts_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label>Bn-Name</label>
                                <input type="text" name="b_City" id="b_City" value="{{$upaz->bn_name}}" required placeholder="বাংলা " class="form-control">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label>En-Name</label>
                                <input type="text" name="e_City" id="e_City" value="{{$upaz->name}}" required placeholder="Engilst" class="form-control">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-3 ">
                                    <a href="{{'/shipping-city'}}" class="btn bg-primary">Back</a>
                                </div>
                                <div class="col-md-6 form-group mb-3 text-right">
                                    <button type="submit" id="btnsub" class="btn bg-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function() {

        $("#divisions").change(function() {
            $("#districts").css({
                background: 'red',
                color: '#fff',
            });
            var diviselect = $(this).val();
            $.ajax({
                url: "{{route('change-divisions')}}",
                method: "get",
                data: {
                    "_token": "{{csrf_token()}}",
                    id: diviselect,
                },
                success: function(data) {
                    $("#districts").html(data);
                    $("#districts").css({
                        background: '#fff',
                        color: '#000',
                    });
                }
            });
        });
        //  edit city 
        $("#editCity").on("submit", function(e) {
            if (confirm('Are you sure')) {
                e.preventDefault();
                $("#btnsub").attr('disabled', true).text("Updating....");
                var division = $("#divisions").val();
                var district = $("#districts").val();
                var updateid = $("#updateID").val();
                var id = 2; // Update city
                var b_City = $("#b_City").val();
                var e_City = $("#e_City").val();
                $.ajax({
                    url: "{{route('actioneShippingCity')}}",
                    method: "post",
                    data: {
                        "_token": "{{csrf_token()}}",
                        id: id,
                        updateid: updateid,
                        division: division,
                        district: district,
                        b_City: b_City,
                        e_City: e_City
                    },
                    dataType: "json",
                    success: function(storeData) {
                        $("#btnsub").attr('disabled', false).text("Update");
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'City Update Successfully.',
                        });
                    }
                });
            }
        });
        // end edit city 
    });
</script>
@endsection
@extends('admin/masterdashboard')

@section('title')
Shipping City
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">All Cities</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shipping</li>
                    <li class="breadcrumb-item active">Shipping Cities</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Cities</h3>
                            </div>
                            <div class="col-md-6">
                                <h3 class="card-title float-right"><input type="text" name="search" id="search" class="form-control" id="" placeholder="Search"></h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="returnview">


                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5 ">
                <div class="card " id="editcity">
                    <div class="card-header">
                        <h3 class="card-title">Add New Cities</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" id="addCity">
                            @csrf
                            <div class="col-md-12 form-group mb-3">
                                <label>Divisions</label>
                                <select class="form-control" name="divisions" required id="divisions">
                                    <option value="">Select</option>
                                    @foreach($division as $divisions)
                                    <option value="{{$divisions->id}}">{{$divisions->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text divisions_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label>Districts</label>
                                <select class="form-control" name="districts" required disabled id="districts">
                                    <option value="">Select</option>
                                </select>
                                <span class="text-danger error-text districts_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label>Bn-Name</label>
                                <input type="text" name="b_City" id="b_City" required placeholder="বাংলা " class="form-control">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label>En-Name</label>
                                <input type="text" name="e_City" id="e_City" required placeholder="Engilst" class="form-control">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3 text-right">
                                <button type="submit" id="btnsub" class="btn bg-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section("script")
<script>
    $(document).ready(function() {
        // division change 
        $("#divisions").change(function() {
            $("#districts").attr("disabled", false);
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
                }
            });
        });
        // end  division change 

        //  store city 
        $("#addCity").on("submit", function(e) {
            if (confirm('Are you sure')) {
                e.preventDefault();
                $("#btnsub").attr('disabled', true).text("Saving....");
                var division = $("#divisions").val();
                var district = $("#districts").val();
                var id = 1; // Add city 
                var b_City = $("#b_City").val();
                var e_City = $("#e_City").val();
                $.ajax({
                    url: "{{route('actioneShippingCity')}}",
                    method: "post",
                    data: {
                        "_token": "{{csrf_token()}}",
                        division: division,
                        id: id,
                        district: district,
                        b_City: b_City,
                        e_City: e_City
                    },
                    dataType: "json",
                    success: function(storeData) {
                        $('tbody').html(storeData.datatable);
                        $("#btnsub").attr('disabled', false).text("Save");
                        $("#addCity")[0].reset();

                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'City add Successfully.',
                        });
                    }
                });
            }
        });
        // end store city 
        // city search 
        fetch_customer_data();

        function fetch_customer_data(query = '') {
            $.ajax({
                url: "{{ route('live_search.action') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#returnview').html(data);
                    $('#total_records').text(data);
                }
            })
        }
        $(document).on('keyup', '#search', function() {
            var query = $(this).val();
            fetch_customer_data(query);
        });
        //end city search 
        //   paginate start 
        $(document).on('click', '.pagination  a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split("page=")[1];
            fage_data(page);
        });

        function fage_data(page) {
            $.ajax({
              url:'/live_search/action?page='+page,
              success:function(data){
                $('#returnview').html(data);
              }
            });
        }
    });
</script>
@endsection
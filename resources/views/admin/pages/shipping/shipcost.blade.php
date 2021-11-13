@extends('admin/masterdashboard')

@section('title')
Shipping Cost
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Shipping Cost</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shipping</li>
                    <li class="breadcrumb-item active">Shipping Cost</li>
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
                                <h3 class="card-title">Cost</h3>
                            </div>
                            <div class="col-md-6">
                                <h3 class="card-title float-right"><input type="text" name="search" id="search" class="form-control" id="" placeholder="Search"></h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="returnview">

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Cost</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" id="addcost">
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
                                <select class="form-control" name="districts" required id="districts">
                                    <option value="">Select</option>
                                </select>
                                <span class="text-danger error-text districts_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label>Upazila</label>
                                <select class="form-control" name="upazila" required id="upazila">
                                    <option value="">Select</option>
                                </select>
                                <span class="text-danger error-text upazila_error"></span>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label>cost</label>
                                <input type="number" name="costprice" id="costprice" required placeholder="0.00" class="form-control">
                                <span class="text-danger error-text cost_error"></span>
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

@section('script')
<script>
    $(document).ready(function() {
        $("#districts").attr('disabled', true);
        $("#upazila").attr('disabled', true);

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

        $("#districts").change(function() {
            $("#upazila").attr("disabled", false);
            var upazila = $(this).val();

            $.ajax({
                url: "{{route('change-Upazila')}}",
                method: "get",
                data: {
                    "_token": "{{csrf_token()}}",
                    id: upazila,
                },
                success: function(data) {
                    $("#upazila").html(data);
                }
            });
        });
        // cost store 
        $('#addcost').on('submit', function(e) {
            e.preventDefault();
            var divisions = $("#divisions").val();
            var districts = $("#districts").val();
            var upazila = $("#upazila").val();
            var cost = $("#costprice").val();
            if (confirm('Are You Sure')) {
                $("#btnsub").attr('disable', true).text('Saving...');
                $.ajax({

                    url: "{{route('storeCost')}}",
                    method: 'post',
                    data: {
                        "_token": "{{csrf_token()}}",
                        divisions: divisions,
                        districts: districts,
                        upazila: upazila,
                        cost: cost
                    },
                    success: function(storeData) {
                        $("#btnsub").attr('disable', false).text('Save');
                        $("#returnview").html(storeData);
                        $('#addcost')[0].reset();
                    }
                });
            }
        });

        fetch_customer_data();

        function fetch_customer_data(query = '') {
            $.ajax({
                url: "{{ route('cost_search') }}",
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

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            get_data(page);
        });

        function get_data(page) {
            $.ajax({
                url: '/live_search/cost?page=' + page,
                success: function(data) {
                    $('#returnview').html(data);
                    $('#total_records').text(data);
                }
            });
        }
    });

    function updateCost(id) {
        var costvalue = $('.costvalue'+id).val();
        $('.costvalue'+id).attr('disable',true).text('Updating...');
        $.ajax({
            url: "{{route('updatecost')}}",
            method:"post",
            data:{
                "_token":"{{csrf_token()}}",
                id:id,
                costvalue:costvalue
            },
            success:function(dataset){
                $('.costvalue'+id).attr('disable',false).text('Update');
                $('#returnview').html(dataset);
            }
        });
    }
</script>
@endsection
@extends('admin.masterdashboard')

@section('title')
USER ACCESS
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                    <li class="breadcrumb-item active">Category</li>
                    <li class="breadcrumb-item active">Add Category</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-navy  color-palette">
            <div class="card-header">
                <h3 class="card-title">User Access</h3>
            </div>
            <form action="{{route('insert_menu_accessList')}}?>" method="POST" class="form-horizontal" role="form">
                @csrf
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select class="form-control" name="user_id" id="user_id">
                                    <option selected="" disabled="">Select User</option>
                                    @foreach($userlist as $each)
                                    <option value="{{$each->id}}">{{$each->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline" >
                    <div class="card-body">
                        <div class="col-sm-12" >
                            <div id="new_data"></div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </form>
        </div>
    </div>
</div>



@section('script')
<script>
    $(document).ready(function() {
        $('#user_id').change(function() {
            var user_id = $('#user_id').val();
            $.ajax({
                type: "post",
                url: "/get_menu_list", // path to function
                cache: false,

                data: {
                    "_token": "{{ csrf_token() }}",
                    user_id: user_id
                },
                success: function(val) {


                    $("#new_data").html(val);

                }
            });
        });
    });
</script>
@endsection
@endsection
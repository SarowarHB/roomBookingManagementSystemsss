@extends('admin/masterdashboard')

@section('title')
Profile
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-navy  color-palette">
            <div class="card-header">
                <h3 class="card-title">Profile</h3>
            </div>
            <form action="{{route('update_profile')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$profile->name}}" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{$profile->email}}" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User name</label>
                        <input type="text" class="form-control" id="Userid" name="username" value="{{$profile->username}}" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="number" class="form-control" name="phone" value="{{$profile->phone}}" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Password</label>
                        <input type="password" class="form-control" name="repassword" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Logo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" id="exampleInputFile" class="custom-file-input">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        <!-- image box  -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn bg-navy">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("input#Userid").on({
        keydown: function(e) {
            if (e.which === 32)
                return false;
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");
        }
    });
</script>

@endsection
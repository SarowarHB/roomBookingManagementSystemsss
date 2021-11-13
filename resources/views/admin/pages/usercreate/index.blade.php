@extends('admin.masterdashboard')
@section('title')
ADD new user
@endsection
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-6">
                <div class="col-sm-12">

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-10">

                    @if($errors->any())
                    <div class="alert alert-danger" {>
                        <ui>
                            @foreach($errors->all() as $error )
                            <li>{{$error}}</li>
                            @endforeach()
                        </ui>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif


                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0 text-dark">Add New User</h5>
                        </div>
                        <div class="card-body register-card-body">
                            <form action="{{route('storeuser')}}" enctype="multipart/form-data" method="post">
                            @csrf    
                            <div class="input-group mb-3">
                                  
                                    <input type="text" name="name" class="form-control" placeholder="Full name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-mobile"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="image">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-image"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-control" name="designation">
                                        <option selected disabled>Select</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Manager">Manager</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-list"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="passwordreturn" class="form-control" placeholder="Retype password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->


                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
</div>


@endsection
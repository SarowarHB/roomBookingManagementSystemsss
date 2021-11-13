@extends('admin.masterdashboard')

@section('menu-name')
All user
@endsection
@section('content')
<div class="content-wrapper">
    <br>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <!-- /.col -->
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
                            <h5 class="m-0 text-dark">Password</h5>
                        </div>
                        <div class="card-body register-card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:5%">SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th style="width:20%">Designation</th>
                                        <th style="width:20%">status</th>
                                        <th style="width:5%">Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($userlist as $key=>$user)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$user->name}}</th>
                                        <th>{{$user->email}}</th>
                                        <th>{{$user->designation}}</th>
                                        <th>
                                            @if($user->status ==1)
                                            <span style="background : green; color: white">Active</span>
                                            @elseif($user->status ==2 )
                                            <span style="background : red; color: white">Inactive</span>
                                            @else
                                            <span style="background : yellow">Undefined</span>
                                            @endif

                                        </th>
                                        <th><button class="btn btn-info" data-toggle="modal" href="#UserDialog" onclick="getData(<?php echo $user->id ?>)"> <i class="fas fa-unlock"></i> </button></th>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="UserDialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn btn-info shadow-sm rounded text-center" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
            <form action="{{route('updateuserpassword')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>New password</label>
                        <input class="form-control" type="password" name="newpassword" placeholder="New password">
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input class="form-control" type="password" name="confirmpassword" placeholder="Confirm password">

                        <input class="form-control" type="hidden" name="getUserId" id="user_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-success shadow-lg p-2 rounded text-center">save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function getData(user_id) {
        $("#user_id").val(user_id);
    }
</script>

@endsection
@extends('admin.masterdashboard')

@section('menu-name')
ALL USERS
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
                            <h5 class="m-0 text-dark">All Admins</h5>
                        </div>
                        <div class="card-body register-card-body">
                        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Join</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                     @foreach ($users as $key => $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->designation }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>
                                        @if($value->status ==1)
                                        <span style="background : green; color: white">Active</span>
                                        @elseif($value->status ==2 )
                                        <span style="background : red; color: white">Inactive</span>
                                        @else
                                        <span style="background : yellow">Undefined</span>
                                        @endif
                                       </td>
                                        <td>{{ $value->created_at }}</td>
                            
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
<!-- Content Wrapper. Contains page content -->

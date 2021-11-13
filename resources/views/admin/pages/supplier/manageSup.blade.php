@extends('admin/masterdashboard')
@section('title')
Home
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Supplier</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Supplier</li>
                    <li class="breadcrumb-item active">Manage Supplier</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn bg-indigo btn-flat float-right" data-toggle="modal" data-target="#admincreate">Add New</button>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ON</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tableid">
       
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="button" onclick="status('<?php ?>' ,0)" class="btn btn-block bg-gradient-danger btn-flat status{{$user->id}}">Block</button>
                                        <button type="button" onclick="status('<?php  ?>',1)" class="btn btn-block bg-gradient-success btn-flat status" value="">Active</button>
                                    </td>
                                </tr>
      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
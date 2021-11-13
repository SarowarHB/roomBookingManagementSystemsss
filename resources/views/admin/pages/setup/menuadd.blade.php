@extends('admin/masterdashboard')

@section('title')
Add Menu
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
                    <li class="breadcrumb-item active">Add Menu</li>
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
                <h3 class="card-title">Add Menu</h3>
                <a data-toggle="modal" data-target="#modal-default" class="btn btn-success btn-xs float-right">Add New</a>
            </div>



            <div class="card-body">
                @if(Session::has('alert'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('alert') }}</p>
                @endif
                @if(Session::has('label'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('label') }}</p>
                @endif
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>SL</td>
                            <td>Main Menu</td>
                            <td>Sub Menu</td>
                            <td>URL</td>
                        </tr>
                        <?php $i = 1; ?>
                        @foreach($mainMenu as $each)

                        <tr>
                            <td>{{ $i++; }}</td>
                            <td>{{ $each->label }}</td>
                            <td>
                                <?php
                                $sub_menu = DB::table('navigation')->where('parent_id', $each->navigation_id)->get();
                                ?>
                                <table>
                                    <?php foreach ($sub_menu as $key => $sub_value): ?>
                                        <tr>
                                            <td >{{ $sub_value->label }}</td>
                                        <tr>


                                        <?php endforeach; ?>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <?php foreach ($sub_menu as $key => $sub_values): ?>
                                        <tr>
                                            <td>{{ $sub_values->url }}</td>
                                        <tr>

                                        <?php endforeach; ?>
                                </table>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Menu Or Sub Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('storeMenu')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Main Menu</label>
                                    <select class="form-control select2" name="parent_id" style="width: 100%;">
                                        <option  selected="selected"  value="0">Select Menu</option>
                                        @foreach($mainMenu as $each)
                                        <option value="{{ $each->navigation_id }}">{{ $each->label }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label>Lavel</label>
                                    <input type="text" name="label" class="form-control" placeholder="Name of the Menu" />
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name="url" class="form-control" placeholder="Menu Url Name">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

@endsection
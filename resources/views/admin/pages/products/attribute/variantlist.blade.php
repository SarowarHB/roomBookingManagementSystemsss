@extends('admin/masterdashboard')

@section('title')
Brand
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Variants</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                    <li class="breadcrumb-item active">attribute</li>
                    <li class="breadcrumb-item active">Variant</li>
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
                                <h3 class="card-title">{{App\Models\Attribute::where('id',$id)->pluck('title')->first()}}</h3>
                            </div>
                            <div class="col-md-6">
                               <a href="{{'/attributes'}}" class="btn btn-info btn-sm float-right">Back</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th style="width: 10%">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($get as $key=>$lists)
                                <tr>
                                    <td>{{$key+1 }}</td>
                                    <td>{{$lists->name }}</td>
                                    <td>
                                        <button type="button" id="btnDelete" onclick="delete_id(<?php echo $lists->id ?>)" class="btn  btn-warning delete_btn"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Variants</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" id="vatantssub">
                            @csrf
                            <div class="col-md-12 form-group mb-3">
                                <label>Name</label>
                                <input type="text" id="name" required placeholder="Name" class="form-control">
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

@section('script')
<script>
    $(document).ready(function() {
        $('#vatantssub').on('submit', function(e) {
            e.preventDefault();
            var getID = <?php echo $id ?>;
            var name = $('#name').val();
            if (confirm('Are you Sure')) {
                $.ajax({
                    url: "{{'/storeVariant'}}",
                    method: "post",
                    data: {
                        "_token": "{{csrf_token()}}",
                        getID: getID,
                        name: name
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $("#btnsub").attr('disabled', true).text('Saving...');
                    },
                    success: function(data) {
                        $('tbody').html(data.tableData);
                        $('#vatantssub')[0].reset();
                        $("#btnsub").attr('disabled', false).text('Save');
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 8000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Variant Store Successfully'
                        });
                    }
                });
            };
        });
    });

    function delete_id(d_status) {
        if (confirm('Are You sure')) {
            var getID = <?php echo $id ?>;
            $.ajax({
                url: "/deleteStatus",
                method: 'post',
                data: {
                    '_token': "{{csrf_token()}}",
                    d_status: d_status,
                    getID: getID,
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btnDelete').attr('disabled', true);
                },
                success: function(data) {
                    $('tbody').html(data.tableData);
                    $('#btnDelete').attr('disabled', false);
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Variant Delete Successfully'
                    });
                }
            });
        }
    }
</script>
@endsection
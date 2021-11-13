@extends('admin/masterdashboard')

@section('title')
Attribute
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Attribute</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                    <li class="breadcrumb-item active">Attribute</li>
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
                        <h3 class="card-title">Attributs</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th style="width:10%">Variant</th>
                                    <th style="width: 23%">Options</th>
                                </tr>
                            </thead>
                            <tbody id="returnview">
                                @foreach($attributs as $on=>$attribute)
                                <tr>
                                    <td>{{$on+1}}</td>
                                    <td>{{$attribute->title}}</td>
                                    <td><a href="{{'/varientsPage/'.$attribute->id}}" class="btn btn-info btn-sm btn-flat">Add </a></td>
                                    <td>
                                        @if($attribute->status ==1)
                                        <button onclick="changestatus(<?php echo $attribute->id ?>,0)" class="btn btn-danger btn-sm btn-flat attrstatus{{$attribute->id}}">OFF</button>
                                        @else
                                        <button onclick="changestatus(<?php echo $attribute->id ?>,1)" class="btn btn-info btn-sm btn-flat attrstatus{{$attribute->id}}" style="padding: 4px 11px">On</button>
                                        @endif
                                        <button type="button" class="btn  btn-warning delete_btn{{$attribute->id }}" onclick="attrDelete(<?php echo $attribute->id ?>)"><i class="fas fa-trash"></i></button>
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
                        <h3 class="card-title">Add New Attribute</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" id="attrsubmit">
                            @csrf
                            <div class="col-md-12 form-group mb-3">
                                <label>Name</label>
                                <input type="text" id="name" placeholder="Name" class="form-control">
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
        $("#attrsubmit").on('submit', function(e) {
            e.preventDefault();
            $("#btnsub").attr('disabled', true).text('Saving..');
            $.ajax({
                url: "{{route('attrStore')}}",
                method: "post",
                data: {
                    "_token": "{{csrf_token()}}",
                    name: $('#name').val(),
                },
                success: function(data) {
                    if (data.status == 0) {
                        $("#btnsub").attr('disabled', false).text('Save');
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $("#attrsubmit")[0].reset();
                        $("#returnview").html(data);
                        $("#btnsub").attr('disabled', false).text('Save');
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Attribute Add Successfully.',
                        });
                    }
                }
            });
        });
    });

    function changestatus(id, status) {
        if (confirm("Are you sure")) {
            $(".attrstatus" + id).attr('disabled', true).text('.....');
            $.ajax({
                url: "{{route('attribute/status')}}",
                method: 'post',
                data: {
                    "_token": "{{csrf_token()}}",
                    id: id,
                    status: status,
                },
                success: function(data) {
                    $('#returnview').html(data);
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Status update successfully.',
                    });
                }
            });
        }
        return false;
    };

    function attrDelete(id) {
        if (confirm("Are you sure")) {
            $(".delete_btn" + id).attr('disabled', true).text('...');
            $.ajax({
                url: "{{route('delete_attribute')}}",
                method: 'post',
                data: {
                    "_token": "{{csrf_token()}}",
                    id: id,
                },
                success: function(data) {
                    $('#returnview').html(data);
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Attribute Delete Successfully.',
                    });
                }
            })
        } else {
            return;
        };
    };
</script>

@endsection
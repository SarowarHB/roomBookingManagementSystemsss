@extends('admin/masterdashboard')

@section('title')
Category
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
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"> <a class="btn bg-indigo btn-sm" href="{{route('store_category')}}">Add New Category</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parent Category</th>
                                <th>Ordering Number</th>
                                <th>Banner</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody id="tableid">
                            @foreach($categoryList as $list)
                            <tr>
                                <td>{{$list->title}}</td>
                                <td>{{App\Models\ProductCategory::where('id',$list->parent_id)->pluck('title')->first()}}</td>
                                <td>{{$list->order_by}}</td>
                                <td>
                                    <a href="{{$list->banner}}" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                        <img src="{{$list->banner}}" style="width:100%;height:70px" class="rounded  d-block  img-fluid mb-2" alt="">
                                    </a>
                                </td>
                                <td>
                                    @if($list->status == 1)
                                    <button type="button" onclick="statusupdate(<?php echo $list->id ?>,0)" class="btn bg-gradient-danger float-right btn-sm status{{$list->id}}">OFF</button>
                                    @else
                                    <button type="button" onclick="statusupdate(<?php echo $list->id ?>,1)" class="btn bg-gradient-success float-right btn-sm status{{$list->id}}">ON</button>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" onclick="deleteCategory('<?php echo $list->id ?>')" class="btn bg-gradient-danger float-right btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    <a href="{{'cate-edit/'.$list->id}}" class="btn bg-gradient-info float-right btn-sm"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function deleteCategory(id) {

        if (confirm("Are you sure")) {
            $.ajax({
                url: '/cat-delete',
                method: 'post',
                data: {
                    "_token": "{{csrf_token()}}",
                    id: id,
                },
                success: function(data) {
                    $('#tableid').html(data);
                }
            });
        }
        return false;
    };

    function statusupdate(id, status) {
        if (confirm("Are you sure")) {
            $(".status" + id).attr('disabled', true).text('.....');
            $.ajax({
                url: '/cat-updatestatus',
                method: 'post',
                data: {
                    "_token": "{{csrf_token()}}",
                    id: id,
                    status: status,
                },
                success: function(data) {
                    $('#tableid').html(data);
                }
            });
        }
        return false;
    };
</script>
@endsection
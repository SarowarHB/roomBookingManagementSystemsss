@extends('admin/masterdashboard')

@section('title')
Edit
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                    <li class="breadcrumb-item active">Category</li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="card card-body">

                        <form method="post" id="updatingdata" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Category Name</label>
                                    <input type="text" name="name" id="name" value="{{$categoryvalue->title}}" class="form-control name">
                                </div>
                                <div class="col-md-6">
                                    <label>Banner</label>
                                    <input type="file" name="banner" id="banner" value="{{$categoryvalue->banner}}" class="form-control banner">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Ordering Number</label>
                                    <input type="number" name="order_by" id="order_by" value="{{$categoryvalue->order_by}}" class="form-control order_by">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Parent Category</label>
                                    <select name="parent_id" id="parent_id" class="form-control parent_id">
                                        <option value="0">Select</option>
                                        @foreach($parent_list as $parent)
                                        <option {{$categoryvalue->parent_id==$parent->id? 'selected':''}} value="{{$parent->id}}">{{$parent->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn bg-indigo btn-sm " href="{{'/category-list'}}">Back</a>
                                    <button type="submit" class="btn btn-info btn-sm  btn-flate  updatedata" id="btnsub">Save
                                        Category</button>
                                </div>
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
        $('#updatingdata').on('submit', function(e) {
            e.preventDefault();
            $("#btnsub").attr('disabled', true).text('Updating...');
            $.ajax({
                url: "/updating/" + <?php echo $categoryvalue->id; ?>,
                method: 'post',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#btnsub').attr('disabled', false).text('Save Category');
                    if (response.status == 200) {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: true,
                            timer: 8000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Update Successfully'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
@extends('admin/masterdashboard')

@section('title')
Category
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Product List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                    <li class="breadcrumb-item active">Manage Product</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Product List</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>image</th>
                                <th>Category</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productlist as $sl=>$product)
                            <tr>
                                <td class="align-middle h4">{{$sl+1}}</td>
                                <td class="align-middle ">{{$product->name}}</td>
                                <td class="align-middle"><img src="{{asset($product->image)}}" width="150px" height="150px" class="rounded mx-aut img-thumbnail" alt=""></td>
                                <td class="align-middle">{{App\Models\ProductCategory::where('id',$product->category_id)->pluck('title')->first()}}</td>
                                <td class="align-middle"><a href="{{'editproduct/'.$product->id}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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

@endsection
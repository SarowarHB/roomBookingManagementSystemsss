@extends('admin.masterdashboard')

@section('title')
Comapny Info
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Company</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/company">Setup</a></li>
                    <li class="breadcrumb-item active">Company Update</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <!-- /.card-header -->
        @if(Session::has('success'))
        <div class="card ">
            <div class="card-body">
                
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                @endif
                @if(Session::has('label'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('label') }}</p>
          
            </div>
        </div>
        @endif
        <div class="card ">
            <div class="card-header">
                <h5 class="m-0 text-dark">Company Informations</h5>
            </div>
            <div class="card-body register-card-body">
                <form action="{{route('updateCompanyInfos')}}" enctype="multipart/form-data" method="post">
                    @csrf


                    <div class="form-group">

                        <div class="form-group ">
                            <input type="text" name="name" class="form-control" value="{{ $companyData->name }}" placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" value="{{ $companyData->email }}" placeholder="Email">
                        </div>
                        <div class="form-group ">
                            <input type="text" name="phone" class="form-control" value="{{ $companyData->contact }}" placeholder="Mobile / Phone Number">
                        </div>

                        <div class="form-group ">
                            <input type="file" class="form-control" name="logo">
                            <img src="{{asset($companyData->logo)}}" width="150px" class="img-thumbnail" alt="Company Image">
                        </div>

                        <div class="form-group ">
                            <input type="text" name="tin" value="{{ $companyData->tin }}" class="form-control" placeholder="TIN or Licence number">

                        </div>
                        <div class="form-group ">
                            <input type="text" value="{{ $companyData->website }}" name="website" class="form-control" placeholder="Company Website">

                        </div>
                        <div class="form-group ">
                            <textarea type="text" name="address" class="form-control" placeholder="Company Address">{{ $companyData->address }}</textarea>

                        </div>
                        <div class="row">

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>


    </div>
</section>


@endsection
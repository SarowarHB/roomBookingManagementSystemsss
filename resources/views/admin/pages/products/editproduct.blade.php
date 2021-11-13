@extends('admin/masterdashboard')

@section('title')
Add New Product
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add New Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                    <li class="breadcrumb-item active">Add New Product</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content ">
    <div class="container-fluid">
        <form method="post" id="productedit" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="productid" value="{{$id}}">
            <div class="row ">
                <!-- left side dive start  -->
                <div class="col-md-8">
                    <!-- product Information start  -->
                    <div class="card">
                        <div class="card-header">
                            <h6>Product Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="p_name">Product Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="pr_name" id="p_name" value="{{$getdetails->name}}" required placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="p_name">Category </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2bs4" required name="category" style="width: 100%;">
                                        <option value="0">Select</option>
                                        @foreach($mainlist as $main)
                                        <option value="{{$main->id}}" {{$getdetails->category_id == $main->id? 'selected':''}}>{{$main->title}}</option>
                                        @foreach($parent as $parents)
                                        @if($parents->parent_id == $main->id)
                                        <option value="{{$parents->id}}" {{$getdetails->category_id == $parents->id? 'selected':''}}>&nbsp;&nbsp;&nbsp;-{{$parents->title}}</option>
                                        @foreach($ultraparent as $ultraparents)
                                        @if($ultraparents->parent_id == $parents->id)
                                        <option value="{{$ultraparents->id}}" {{$getdetails->category_id == $ultraparents->id? 'selected':''}}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--{{$ultraparents->title}}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="p_name">Brand</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2bs4" required name="brand">
                                        <option value="0">Seletc</option>
                                        @foreach($brand as $brands)
                                        <option value="{{$brands->id}}" {{$getdetails->brand_id == $brands->id? 'selected':''}}>{{$brands->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="p_name">Unit</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="unit" value="{{$getdetails->unit}}" required placeholder="Unit (e.g. KG, Pc etc)" id="unit" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product Information end  -->

                    <div class="card">
                        <div class="card-header">
                            <h6>Product Variation</h6>
                        </div>
                        <div class="card-body" id="addVarient">
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="color">Color</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" {{$getdetails->has_color == 1 ? 'checked':''}} class="custom-control-input" value="1" name="colordisable" id="customSwitch9">
                                                <label class="custom-control-label" for="customSwitch9"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <select class="form-control colordis" disabled>
                                            @foreach($colorvar as $colorvariants)
                                            <option style="background:<?php echo $colorvariants->code ?>" value="{{$colorvariants->id}}"> {{$colorvariants->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="">Attribute</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <select class="form-control" id="attribu" style="width: 100%;">
                                            <option aria-readonly="">Select</option>
                                            @foreach($attribute as $attributes)
                                            <option value="{{$attributes->id}}">{{$attributes->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Product price + stock
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="">Unit price *</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="uniteprice" value="{{$getdetails->price}}" class="form-control" min="0" placeholder="0.00" required="required">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="">Discount *</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="discount" value="{{$getdetails->discount}}" class="form-control" min="0" placeholder="0.00">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="">Quantity *</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="quantity" value="{{$getdetails->quantity}}" class="form-control" min="0" placeholder="0.00" required="required">
                                </div>
                            </div>
                            <div class="row form-group">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Variant</th>
                                            <th>Variant Price</th>
                                            <th>image</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addVarientPrice">
                                        @if(!$editattribut->isEmpty())
                                        @foreach($editattribut as $editattributss)
                                        <tr class="varientremove{{$editattributss->variant_id}}">
                                            <td>
                                                <label>{{App\Models\Variant::where('id',$editattributss->variant_id)->pluck('name')->first() }}</label>
                                                <input type="hidden" name="varientid[]" value="{{$editattributss->variant_id}}">
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$editattributss->vari_price}}" placeholder="0" name="varientprice[]">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="varientsphoto[]" image id="exampleInputFile{{$editattributss->variant_id}}">
                                                            <label class="custom-file-label" for="exampleInputFile{{$editattributss->variant_id}}">Choose file</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                @if(!empty($editattributss->image))
                                                <img src="{{asset($editattributss->image)}}" width="100px" height="100px" class=" img-fluid rounded" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger btn-sm remove">Remove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        @if(!$editcolors->isEmpty())
                                        @foreach($editcolors as $editcolorss)
                                        <tr class="colorcode{{$editcolorss->color_id}}">
                                            <td style="background:<?php echo $editcolorss->color_code  ?>">
                                                <label>{{App\Models\Color::where('id',$editcolorss->color_id)->pluck('name')->first() }}</label>
                                                <input type="hidden" name="colorid[]" value="{{$editcolorss->color_id}}">
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$editcolorss->color_price}}" placeholder="0" name="colorprice[]">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="colorphoto[]" image id="exampleInputFile{{$editcolorss->color_id}}">
                                                            <label class="custom-file-label" for="exampleInputFile{{$editcolorss->color_id}}">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(!empty($editcolorss->image))
                                                <img src="{{asset($editcolorss->image)}}" width="100px" height="100px" class=" img-fluid rounded" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger btn-sm remove">Remove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Product Description
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <label for=""> Description</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="discription" id="summernote">
                                    {!! $getdetails->description !!}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- left side dive start  -->

                <!-- right side dive start  -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Shipping Configuration</div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-8">Free Shipping</div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" {{$getdetails->free_shipping? "checked":''}} name="freeShipping" value="1" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">Thumbnail Image</div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="thumbnail" onchange="thumbnailfun(this)"  id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{asset($getdetails->image)}}" id="preview" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- product images status  -->
                    <div class="card">
                        <div class="card-header">
                            <h6>Gallery Images </h6>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" multiple name="gallery[]" id="exampleInputFile30">
                                                <label class="custom-file-label" for="exampleInputFile30">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- product images end  -->
                    <div class="card">
                        <div class="card-header">Low Stock Quantity Warning</div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control" value="{{$getdetails->low_stock}}" placeholder="0" name="low_stock">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Featured</div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-8">Status</div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" value="1" {{$getdetails->featured == 1? "checked":""}} name="featured" id="customSwitch4">
                                        <label class="custom-control-label" for="customSwitch4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Todays Deal</div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-8">Status</div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" value="1" {{$getdetails->todays_deal == 1? "checked":""}}  name="todays_deal" id="customSwitch5">
                                        <label class="custom-control-label" for="customSwitch5"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Flash Deal</div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-8">Status</div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" value="1" {{$getdetails->flash_deal == 1? "checked":""}} name="flash_deal" id="customSwitch6">
                                        <label class="custom-control-label" for="customSwitch6"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Estimate Shipping Time</div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Shipping Days</label>
                                    <input type="number" class="form-control" value="{{$getdetails->shipping_time}}"  min="0" placeholder="0" name="shipping_day">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" id="productbtn" class="btn btn-block btn-success ">Update</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

@endsection
@section('script')
<script>
    function thumbnailfun(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function getidvar(classid) {
        var alertd = $('.clearChe' + classid).val();
        if ($('.varientremove' + alertd).length == 0) {
            $.ajax({
                url: '/getVarientSt',
                method: 'GET',
                data: {
                    "_token": "{{csrf_token()}}",
                    alertd: alertd,
                },
                success: function(dataget) {
                    $("#addVarientPrice").append(dataget);
                }
            });
        } else {
            alert('This Varient is already exists');
        }
    }

    $(document).ready(function() {
        // add color Varient 
        $('.colordis').on('change', function() {
            var colorid = $(this).val();
            if ($('.colorcode' + colorid).length == 0) {
                $.ajax({
                    url: "/getcolorVar",
                    method: "GET",
                    data: {
                        "_token": "{{csrf_token()}}",
                        colorid: colorid
                    },
                    success: function(colordata) {
                        $("#addVarientPrice").append(colordata);
                    }
                });
            } else {
                alert('This Color is already exists');
            }
        });
        // remove varient Table 
        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });
        // add Attribut select fild
        $('#attribu').change(function() {
            var findID = $(this).val();
            var ll = $('.clearChe' + findID).length;
            if ($('.clearChe' + findID).length == 0) {
                $.ajax({
                    url: "/getvarients",
                    method: 'GET',
                    data: {
                        '_token': "{{csrf_token()}}",
                        findID: findID
                    },
                    success: function(dataget) {
                        $("#addVarient").append(dataget);
                    }
                });
            } else {
                alert('This Attribute is already exists');
            }
        });
        // color select option disible or enable 
        $('input[name="colordisable"]').change(function() {
            if ($('input[name="colordisable"]').prop('checked') == true) {
                $('.colordis').attr('disabled', false);
            } else {
                $('.colordis').attr('disabled', true);
            }
        });

        if ($('input[name="colordisable"]').prop('checked') == true) {
            $('.colordis').attr('disabled', false);
        } else {
            $('.colordis').attr('disabled', true);
        }
        // product edit
        $("#productedit").on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{route('edit_product')}}",
                method: "post",
                data: new FormData(this),
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#productbtn').attr('disabled', true).text('Updation...');
                },
                success: function(data) {
                    $('#productbtn').attr('disabled', false).text('Save');
                    $('#productSub')[0].reset();
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Product Update Successfully.',
                    });
                }
            });
        });
    });
</script>
@endsection
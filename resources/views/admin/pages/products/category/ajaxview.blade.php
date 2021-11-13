@foreach($updatelist as $list)
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
        <button type="button" onclick="statusupdate(<?php echo $list->id ?>,0)"  class="btn bg-gradient-danger float-right btn-sm status{{$list->id}}">OFF</button>
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
@include('sweetalert::alert')
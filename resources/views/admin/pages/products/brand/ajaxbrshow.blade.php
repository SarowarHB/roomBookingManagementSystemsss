@foreach($brand as $on=>$brands)
<tr>
    <td>{{$on+1}}</td>
    <td>{{$brands->title}}</td>
    <td><img src="{{$brands->logo}}" style="width:100%;height:70px" class="rounded  d-block" alt=""></td>
    <td>
        @if($brands->status == 1)
        <button type="button" onclick="status('<?php echo $brands->id; ?>' ,0)" class="btn bg-gradient-danger float-right btn-sm status">Block</button>
        @else
        <button type="button" onclick="status('<?php echo $brands->id; ?>' ,1)" class="btn bg-gradient-success float-right btn-sm status" value="">Active</button>
        @endif
    </td>
    <td>
        <button type="button" wire:click="deletebrand({{$brands->id}})" class="btn  bg-gradient-danger float-right btn-sm status">Delete</button>
    </td>
</tr>
@endforeach
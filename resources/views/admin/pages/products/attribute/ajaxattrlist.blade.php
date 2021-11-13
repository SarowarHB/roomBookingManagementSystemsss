@foreach($attributs as $on=>$attribute)
<tr>
    <td>{{$on+1}}</td>
    <td>{{$attribute->title}}</td>
    <td><a href="{{'/varientsPage/'.$attribute->id}}" class="btn btn-info btn-sm btn-flat">Add </a></td>
    <td>
        @if($attribute->status ==1)
        <button onclick="changestatus(<?php echo $attribute->id ?>,0)" class="btn btn-danger btn-sm btn-flat attrstatus{{$attribute->id}}">OFF</button>
        @else
        <button onclick="changestatus(<?php echo $attribute->id ?>,1)" style="padding: 4px 11px" class="btn btn-info btn-flat btn-sm attrstatus{{$attribute->id}}">On</button>
        @endif
        <button type="button" class="btn  btn-warning delete_btn{{$attribute->id }}" onclick="attrDelete(<?php echo $attribute->id ?>)"><i class="fas fa-trash"></i></button>
    </td>
</tr>
@endforeach
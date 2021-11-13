@foreach($list as $on=>$user)
<tr>
    <td>{{$on+1}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->phone}}</td>
    <td>
        @if($user->status == 1)
        <button type="button" onclick="status('<?php echo $user->id; ?>' ,0)" class="btn btn-block bg-gradient-danger btn-flat status{{$user->id}}">Block</button>
        @else
        <button type="button" onclick="status('<?php echo $user->id; ?>',1)" class="btn btn-block bg-gradient-success btn-flat status{{$user->id}}" value="">Active</button>
        @endif
    </td>
</tr>
@endforeach
@include('sweetalert::alert')
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>En Name</th>
            <th>Bn Name</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @if($total_row > 0)
        @foreach ($data as $key=>$row)
        <tr>
            <td>{{$key + 1}}</td>
            <td> {{$row->name}} </td>
            <td> {{$row->bn_name}} </td>
            <td> <a class="btn btn-info btn-sm" href="edit-city/{{$row->id}}"><i class="fas fa-edit"></i></a> </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td align="center" colspan="5">No Data Found</td>
        </tr>
        @endif
    </tbody>
    </div>
</table>
{{$data->links('pagination::bootstrap-4')}}
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>En Name</th>
            <th>Bn Name</th>
            <th>Cost</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @if($total_row > 0)
        @foreach ($data as $key=>$row)
        <tr>
            <td>{{$key + 1}}</td>
            <td> {{$row->name}} </td>
            <td> {{$row->bn_name}} </td>
            <td>
                <input type="number" class="form-control costvalue{{$row->shippingID}}" value="{{$row->cost}}" >
            </td>
            <td><button type="button" class="btn btn-info btn-sm btn-flate" onclick="updateCost(<?php echo $row->shippingID ?>)" >Update</button></td>
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

@include('sweetalert::alert')


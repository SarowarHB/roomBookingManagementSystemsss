<div>
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 5%;">ON</th>
                                <th>Name</th>
                                <th width="20%">logo</th>
                                <th width="10%">Status</th>|
                                <th width="10%">Options</th>|
                            </tr>
                        </thead>
                        <tbody id="data">
                            @foreach($brand as $on=>$brands)
                            <tr>
                                <td>{{$on+1}}</td>
                                <td>{{$brands->title}}</td>
                                <td><img src="{{$brands->logo}}" style="width:100%;height:70px" class="rounded  d-block" alt=""></td>
                                <td>
                                    @if($brands->status == 1)
                                    <button type="button" wire:click="status({{$brands->id}},0)" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn bg-gradient-danger float-right btn-sm status">OFF</button>
                                    @else
                                    <button type="button" wire:click="status({{$brands->id}},1)" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn bg-gradient-success float-right btn-sm status" value="">ON</button>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="deletebrand({{$brands->id}})" class="btn  bg-gradient-danger float-right btn-sm status"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h6>Add Brand</h6>
                </div>
                <div class="card-body">

                    <form wire:submit.prevent="save">
                        <label for="">Logo</label>
                        <input type="file" name="file" wire:model="logo" class="form-control" id="image-input">
                        @error('logo') <span class="text-danger">{{$message}}</span>@enderror
                        <br>
                        <label for="">Name</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name') <span class="text-danger">{{$message}}</span>@enderror<br>
                        <br>
                        <button type="submit" class="btn btn-info btn-flat">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
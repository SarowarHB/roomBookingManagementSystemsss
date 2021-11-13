@if($checkif == 1)
<div class="row form-group">
    <div class="col-md-3">
        <label>{{$lablename}}</label>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <select class="form-control clearChe{{$calssCon}}" onchange="getidvar(<?php echo $calssCon ?>)">
                <option>Select</option>
                @foreach($getvarients as $getvarient)
                <option value="{{$getvarient->id}}">{{$getvarient->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@elseif($checkif == 2)


<tr class="varientremove{{$getpricefile->id}}">
    <td>
        <label>{{$getpricefile->name}}</label>
        <input type="hidden" name="varientid[]" value="{{$getpricefile->id}}">
    </td>
    <td>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="0" name="varientprice[]">
        </div>
    </td>
    <td>
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="varientsphoto[]" image  id="exampleInputFile{{$getpricefile->id}}">
                    <label class="custom-file-label" for="exampleInputFile{{$getpricefile->id}}">Choose file</label>
                </div>

            </div>
        </div>
    </td>
    <td>
        <div class="form-group">
            <button type="button" class="btn btn-danger btn-sm remove">Remove</button>
    </td>
</tr>


@elseif($checkif == 3)
<tr class="colorcode{{$getcolor->id}}">
    <td style="background:<?php echo $getcolor->code  ?>">
        <label>{{$getcolor->name}}</label>
        <input type="hidden" name="colorid[]" value="{{$getcolor->id}}">
        <input type="hidden" name="colorcode[]" value="{{$getcolor->code}}">
    </td>
    <td>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="0" name="colorprice[]">
        </div>
    </td>
    <td>
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="colorphoto[]" image  id="exampleInputFile{{$getcolor->id}}">
                    <label class="custom-file-label" for="exampleInputFile{{$getcolor->id}}">Choose file</label>
                </div>
            </div>
        </div>
    </td>
    <td>
        <div class="form-group">
            <button type="button" class="btn btn-danger btn-sm remove">Remove</button>
    </td>
</tr>
@endif

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
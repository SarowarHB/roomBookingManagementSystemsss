<?php
$added_menu = DB::table('admin_role')->where('admin_id', $user_id)->get();
?>
<div class="row">

    <div class="col-md-12">
        <br>
        <table border="1" class="table table-bordered datatable" id="table-1">
            <tr>
                <td style="text-align:right;">All Check</td>
                <td style="color:red;"> <input type="checkbox" id="checkAll"> All Check</td>
            </tr>
            <?php
            foreach ($navigationList as $key => $each_value):
                $sub_menu = DB::table('navigation')->where('parent_id', $each_value->navigation_id)->get();
                ?>
                <tr>
                    <th><center style="text-align: center;"><?php echo $each_value->label; ?></center></th>
                <td>
                    <ul class="list-group">
                        <?php foreach ($sub_menu as $key => $sub_value): ?>
                                                                                                <!--<input type="hidden" name="parent_id[]" value="<?php // echo $sub_value['parent'];                  ?>"/>-->
                            <li class="list-group-item"><input <?php
                                foreach ($added_menu as $each_added_menu) {
                                    if ($each_added_menu->navigation_id == $sub_value->navigation_id) {
                                        echo "checked";
                                    }
                                }
                                ?> type="checkbox" value="<?php echo $sub_value->navigation_id; ?>" name="navigation[]"/>&nbsp;&nbsp;&nbsp;<?php echo $sub_value->label; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2">
            <center>


                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </center>

            </td>
            </tr>
        </table>
    </div>
</div>
<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>
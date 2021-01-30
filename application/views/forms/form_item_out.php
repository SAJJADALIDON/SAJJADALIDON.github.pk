<?php //echo "<pre/>"; print_r($warehouses); exit(); ?>
<?php
$rowOption = '';
foreach ($items as $item) {            
        $rowOption .= '<option value="' . $item->item_id . '">' . $item->item_name .' [Code: '.$item->item_code.']'.' [Qtt: '.$item->inventory_quantity.']'.'</option>';
}
?>
<script>
function addRow() {
var item_count = $("#item_area tr").length + 1;

var item = '<tr><td><select class="form-control" name="item[' + item_count + ']" ><option value="">Selsect Item</option>';         
        item += '<?php echo $rowOption; ?>';
        item += '</select></td>';
        item += '<td ><input class="form-control" type="text" name="unit_price[' + item_count + ']" placeholder="Unit Price"/></td>';
        item += '<td ><input class="form-control" type="text" name="quantity[' + item_count + ']" placeholder="Quantity"/></td>';
        item += '</tr>';

         $('#item_area').append(item);
}
</script>

<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Item Out</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

            <?=form_open(base_url().'inventory/item_out', 'role="form" class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="warehouse" class="col-sm-2 hidden-xs control-label col-xs-offset-0 col-xs-2">Warehouse: *</label>
                <div class="col-sm-6 col-xs-12">
                    <select name="warehouse" id="warehouse" class="form-control" required >
                        <option value="">Select Warehouse</option>
                        <?php foreach ($warehouses as $warehouse) { ?>
                            <option value="<?=$warehouse->warehouse_id;?>"><?=$warehouse->warehouse_name;?></option>
                        <?php } ?>
                    </select>
                </div><span class="visible-xs"><br/><br/></span>
                <a href="<?=base_url('settings/add_warehouse'); ?>" class="btn btn-warning btn-flat col-xs-offset-2 col-xs-8 col-sm-2 col-sm-offset-0">Add Warehouse</a>
            </div>
            <div class="form-group">
                <label for="note" class="col-sm-2 hidden-xs control-label col-xs-offset-0 col-xs-2">Note: </label>
                <div class="col-sm-6 col-xs-12">
                    <?php
                    $data_text = array(
                        'name'        => 'note',
                        'id'          => 'note',
                        'rows'        => '2',
                        'placeholder' => 'Invoice note',
                        'class'       => 'form-control',
                      );
                    echo form_textarea($data_text) ?>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="item_area">
                    <tr>
                        <td>
                            <select name="item[1]" id="item[1]" class="form-control" required >
                                <option value="">Select Item</option>
                                <?php foreach ($items as $item) { ?>
                                    <option value="<?=$item->item_id;?>"><?=$item->item_name.' [Code: '.$item->item_code.']'.' [Qtt: '.$item->inventory_quantity.']';?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><?=form_input('unit_price[1]', set_value('unit_price[1]'), 'placeholder="Unit Price" class="form-control" required') ?></td>
                        <td><?=form_input('quantity[1]', set_value('quantity[1]'), 'placeholder="Quantity" class="form-control" required') ?></td>
                    </tr>
                </tbody>
            </table><br/>
            <a class="btn btn-default btn-flat" type="button" href="javascript:addRow()"><i class="glyphicon glyphicon-plus-sign"></i> Add More Row</a>
            <br/><br/>
            <div>
                <button type="submit" class="btn btn-primary btn-flat col-xs-6 col-xs-offset-2  col-sm-offset-3"><i class="glyphicon glyphicon-ok"></i> Save</button>&nbsp;
                <button type="reset" class="btn btn-default btn-flat">Reset</button>
            </div>
            <?=form_close(); ?>
            <br/>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.row -->
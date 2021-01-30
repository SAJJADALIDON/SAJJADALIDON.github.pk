<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Remove Damage Item</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=form_open(base_url().'inventory/update_damage_item/remove', 'role="form" class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="item_id" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Item: *</label>
                <div class="col-sm-8 col-xs-12">
                <select name="item_id" id="item_id" class="form-control" required >
                    <option value="">Select Item</option>
                    <?php foreach ($items as $item) { ?>
                        <option value="<?=$item->item_id;?>"><?=$item->item_name.' [Code: '.$item->item_code.']'.' [Qtt: '.$item->inventory_damage_qtt.']';?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="quantity" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Quantity: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('quantity', set_value('quantity'), 'id="quantity" placeholder="Quantity" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-offset-1 col-sm-offset-3">
                    <p class="text-muted">* Required fields.</p>
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-flat col-xs-6 col-xs-offset-2  col-sm-offset-3"><i class="glyphicon glyphicon-ok"></i> Save</button>&nbsp;
                <button type="reset" class="btn btn-default btn-flat">Reset</button>
            </div>
            <?=form_close(); ?>
            <br/>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.row -->
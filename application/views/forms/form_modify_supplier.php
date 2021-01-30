<div class="box">
    <div class="box-body">
        <?=form_open(base_url('suppliers/modify/'.$supplier->supplier_id), 'role="form" class="form-horizontal"'); ?>
        <div class="form-group">
            <label for="supplier_name" class="col-sm-2 hidden-xs control-label col-xs-2">Supplier Name: *</label>
            <div class="col-sm-8 col-xs-12">
                <?=form_input('supplier_name', $supplier->supplier_name, 'id="supplier_name" placeholder="Supplier Name" class="form-control" required') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="supplier_key_person" class="col-sm-2 hidden-xs control-label col-xs-2">Contact Person: *</label>
            <div class="col-sm-8 col-xs-12">
                <?=form_input('supplier_key_person', $supplier->supplier_key_person, 'id="supplier_key_person" placeholder="Contact Person" class="form-control" required') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="supplier_email" class="col-sm-2 hidden-xs control-label col-xs-2">Email: *</label>
            <div class="col-sm-8 col-xs-12">
                <?=form_input('supplier_email', $supplier->supplier_email, 'id="supplier_email" placeholder="Email Address" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="user@domain.com" class="form-control" required') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="supplier_phone" class="col-sm-2 hidden-xs control-label col-xs-2">Phone: </label>
            <div class="col-sm-8 col-xs-12">
                <?=form_input('supplier_phone', $supplier->supplier_phone, 'id="supplier_phone" placeholder="Phone" class="form-control"') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="address" class="col-sm-2 hidden-xs control-label col-xs-2">Address: </label>
            <div class="col-sm-8 col-xs-12">
                <?=form_input('supplier_address', $supplier->supplier_address, 'id="address" placeholder="Address" class="form-control"') ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-offset-1">
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

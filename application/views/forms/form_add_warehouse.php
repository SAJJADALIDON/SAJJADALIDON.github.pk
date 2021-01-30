<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add Warehouse</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=form_open(base_url('settings/add_warehouse'), 'role="form" class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="warehouse_name" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Warehouse Name: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('warehouse_name', set_value('warehouse_name'), 'id="warehouse_name" placeholder="Warehouse Name" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Phone: </label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('phone', set_value('phone'), 'id="phone" placeholder="Warehouse\'s Phone" class="form-control"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Email: </label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('email', set_value('email'), 'id="email" placeholder="Warehouse\'s Email Address" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="warehouse@domain.com" class="form-control"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Address: </label>
                <div class="col-sm-8 col-xs-12">
                    <?php
                    $data_text = array(
                        'name'        => 'address',
                        'id'          => 'address',
                        'value'       => $this->session->flashdata('address'),
                        'rows'        => '5',
                        'placeholder' => 'Warehouse Address',
                        'class'       => 'form-control',
                      );
                    echo form_textarea($data_text) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="incharge" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Incharge: *</label>
                <div class="col-sm-8 col-xs-12">
                <select name="incharge" id="incharge" class="form-control" required >
                    <option value="">Select User</option>
                    <?php foreach ($users as $user) { ?>
                        <option value="<?=$user->user_full_name;?>"><?=$user->user_full_name;?></option>
                    <?php } ?>
                </select>
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
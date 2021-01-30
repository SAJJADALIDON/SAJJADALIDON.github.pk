<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add New Supplier</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=form_open(base_url().'suppliers/add_supplier', 'role="form" class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="name" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Name: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('name', set_value('name'), 'id="name" placeholder="Supplier Name" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Phone: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('phone', set_value('phone'), 'id="phone" placeholder="Supplier Phone" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Email: </label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('email', set_value('email'), 'id="email" placeholder="Supplier Email Address" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="supplier@domain.com" class="form-control"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="key_person" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Key Person: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('key_person', set_value('key_person'), 'id="key_person" placeholder="Key Contact Person Name" class="form-control" required') ?>
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
                        'placeholder' => 'Supplier\'s Address',
                        'class'       => 'form-control',
                      );
                    echo form_textarea($data_text) ?>
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
<!-- Modal -->
<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <?=form_open_multipart(base_url('items/save_category'), 'role="form" class="form-horizontal"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <div class="col-sm-10 col-xs-12 col-sm-offset-1">
                <?=form_input('cat_name', '', 'id="cat_name" placeholder="Category Name" class="form-control" required') ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary col-xs-6 col-sm-offset-2 btn-flat"><i class="glyphicon glyphicon-ok"></i> Save</button>
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
      <?=form_close(); ?>
    </div>
  </div>
</div>
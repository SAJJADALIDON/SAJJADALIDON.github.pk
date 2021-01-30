<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add New Item</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

            <?=form_open_multipart(base_url().'items/add_item', 'role="form" class="form-horizontal"'); ?>
            <?php
            $option = array();
            $option[0] = 'Select Category';
            foreach ($categories as $value) {
                    $option[$value->cat_id] = $value->cat_name;
            }
            ?>
            <div class="form-group">
                <label for="category_id" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Category: *</label>
                <div class="col-sm-6 col-xs-12">
                    <?=form_dropdown('category_id', $option, '', 'id="category_id" class="form-control"') ?>
                </div>
                <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#catModal">Add New Category</button>
            </div>
            <div class="form-group">
                <label for="item_code" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Item Code: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('item_code', set_value('item_code'), 'id="item_code" placeholder="Item Code" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="item_name" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Item Name: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('item_name', set_value('item_name'), 'id="item_name" placeholder="Item Name" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="item_description" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Item Description: </label>
                <div class="col-sm-8 col-xs-12">
                    <?php
                    $data_text = array(
                        'name'        => 'item_description',
                        'id'          => 'item_description',
                        'value'       => $this->session->flashdata('item_description'),
                        'rows'        => '5',
                        'placeholder' => 'Item Description',
                        'class'       => 'form-control',
                      );
                    echo form_textarea($data_text) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="item_image" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">Image: </label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_upload('item_image', '', 'id="item_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed only max_size = 150KB, max_width = 1024px, max_height = 768px, types = gif | jpg | png .</p>
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
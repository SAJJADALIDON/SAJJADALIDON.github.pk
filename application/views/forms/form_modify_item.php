<?php //  echo "<pre>"; print_r($item); exit();
?>
<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Modify Item</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=form_open_multipart(base_url().'items/modify/'.$item->item_id, 'role="form" class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="category" class="control-label col-xs-2">Category: *</label>
                <div class="col-sm-9 col-xs-12">
                    <select name="category" id="category" class="form-control" >
                    <?php $categories = $this->db->get('category')->result();
                    foreach ($categories as $category) {?>
                        <option value="<?php echo $category->cat_id;?>" <?php echo ($category->cat_id == $item->cat_id)?'selected':'';?>><?php echo $category->cat_name;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="item_code" class="control-label col-xs-2">Item Code: *</label>
                <div class="col-sm-9 col-xs-12">
                    <?=form_input('item_code', $item->item_code, 'id="item_code" placeholder="Item Code" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="item_name" class="control-label col-xs-2">Item Name: *</label>
                <div class="col-sm-9 col-xs-12">
                    <?=form_input('item_name', $item->item_name, 'id="item_name" placeholder="Item Name" class="form-control" required') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="item_description" class="control-label col-xs-2">Item Description: </label>
                <div class="col-sm-9 col-xs-12">
                    <?php
                    $data_text = array(
                        'name'        => 'item_description',
                        'id'          => 'item_description',
                        'value'       => $item->item_description,
                        'rows'        => '4',
                        'placeholder' => 'Item Description',
                        'class'       => 'form-control',
                      );
                    echo form_textarea($data_text) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="item_image" class="control-label col-xs-2">Image: </label>
                <div class="col-sm-9 col-xs-12">
                      <?php $image_link = './item_iamages/'.$item->item_code.'_thumb.jpg'; ?>
                      <?php if(file_exists ($image_link)): ?>
                        <img id="img-<?=$item->item_id;?>" src="<?=base_url($image_link);?>" alt="image-<?=$item->item_id;?>"><br/><br/>
                      <?php endif; ?>
                    <?=form_upload('item_image', '', 'id="item_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed only max_size = 150KB, max_width = 1024px, max_height = 768px, types = gif | jpg | png .</p>
                    <p class="text-muted pull-right">* Required fields.</p>                    
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-flat col-xs-6 col-xs-offset-2"><i class="glyphicon glyphicon-ok"></i> Save</button>&nbsp;
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
<div class="box">
    <div class="box-header">
        <span class="box-title">Items</span>
        <?php if ($this->session->userdata('role')): ?>
        <div class="content-nav">
            <div class="btn-group col-md-8 col-sm-8 col-xs-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-1">
                <a href="<?=base_url('items/add_item'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-plus-sign"></i> <span class="hidden-xs"> Add New Item</span></a>
                <a href="<?=base_url('items/view_barcodes'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-barcode"></i> <span class="hidden-xs"> View Barcodes</span></a>
                <a href="<?=base_url('csv/download_csv/items'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i><span class="hidden-xs"> Download</span></a>
                <a href="<?=base_url('csv'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-plane"></i> CSV Upload</a>
            </div>                              
        </div>
        <?php endif; ?>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th class="hidden-xs">Image</th>
                    <th>Item Name</th>
                    <th class="hidden-xs">Category</th>
                    <th class="hidden-md hidden-sm hidden-xs">Item Description</th>
                    <?php if ($this->session->userdata('role')): ?>
                    <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <a href="#" data-name="item_code" data-type="text" data-url="<?=base_url('items/update_item'); ?>" data-pk="<?=$item->item_id; ?>" class="data-modify-<?=$item->item_id; ?> no-style"><?=$item->item_code; ?></a>
                            </td>
                            <td class="hidden-xs">
                                <?php $image_link = './item_iamages/'.$item->item_image_name.'_thumb'.$item->item_image_type; ?>
                                <?php if(($item->item_image_name) AND file_exists ($image_link)): ?>
                                    <a href="#imgDisplay" id="display-image-<?=$item->item_id;?>" data-id="display-image-<?=$item->item_id;?>" data-toggle="modal" class="display-image">
                                        <img id="img-<?=$item->item_id;?>" src="<?=base_url($image_link);?>" alt="image-<?=$item->item_id;?>">
                                    </a>
                                <?php else: ?>
                                    <img id="img-<?=$item->item_id;?>" src="<?=base_url('./item_iamages/image-placeholder_thumb.jpg');?>" alt="image-<?=$item->item_id;?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" data-name="item_name" data-type="textarea" data-rows="4" data-url="<?=base_url('items/update_item'); ?>" data-pk="<?=$item->item_id; ?>" class="data-modify-<?=$item->item_id; ?> no-style"><?=$item->item_name; ?></a>
                            </td>
                            <td class="hidden-xs">
                                <?php $str = '[';
                                foreach ($categories as $value) {
                                    $str .= "{value:" . $value->cat_id . ",text:'" . $value->cat_name . " '},";
                                }
                                $str = substr($str, 0, -1);
                                $str .= "]"; ?>
                                <a href="#" data-name="cat_id" data-type="select" data-url="<?=base_url('items/update_item'); ?>" data-source="<?=$str; ?>" data-value="<?=$item->cat_id; ?>" data-pk="<?=$item->item_id; ?>" class="data-modify-<?=$item->item_id; ?> no-style"><?=$item->cat_name; ?></a>
                            </td>
                            <td class="hidden-md hidden-sm hidden-xs">
                                <a href="#" data-name="item_description" data-type="textarea" data-rows="4" data-url="<?=base_url('items/update_item'); ?>" data-pk="<?=$item->item_id; ?>" class="data-modify-<?=$item->item_id; ?> no-style"><?=$item->item_description; ?></a>
                            </td>
                            <?php if ($this->session->userdata('role')): ?>
                            <td>
                                <a href="#viewBarcode" class="barcode" data-id="<?=$item->item_code;?>" data-toggle="modal"><span data-toggle="tooltip" data-placement="top" title="View Barcode" ><i class="glyphicon glyphicon-barcode"></i></span></a>&nbsp;
                                <a href="<?php echo base_url('items/modify/' . $item->item_id); ?>"><i data-toggle="tooltip" data-placement="top" title="Modify Item" class="glyphicon glyphicon-edit"></i></a>&nbsp;
                                <a href="#imgChange" class="update" data-id="<?=$item->item_id;?>" data-toggle="modal"><span data-toggle="tooltip" data-placement="top" title="Update Image" ><i class="glyphicon glyphicon-picture"></i></span></a>&nbsp;
                                <a data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')" href="<?=base_url('items/delete_item/'.$item->item_id); ?>" class=""><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Item Code</th>
                    <th class="hidden-xs">Image</th>
                    <th>Item Name</th>
                    <th class="hidden-xs">Category</th>
                    <th class="hidden-md hidden-sm hidden-xs">Item Description</th>
                    <?php if ($this->session->userdata('role')): ?>
                    <th>Action</th>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->

<!-- script For Update Image -->
<script type="text/javascript">
$(document).on("click", ".update", function () {
     var itemId = $(this).data('id'); //Get the id
     var imgsrc = $('img[alt="image-'+itemId+'"]').attr('src');
     imgsrc = imgsrc.replace('_thumb','');
     $(".modal-body #modal-img").attr('src', imgsrc);
     $(".modal-body #item-id").val( itemId );
});

// For display Image preview
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("item_image").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("modal-img").src = oFREvent.target.result;
        };
    };
</script>

<!-- Modal For Update Image -->
<div class="modal fade" id="imgChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <?=form_open_multipart(base_url().'items/update_image', 'role="form" class="form-horizontal"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Change Item Image</h4>
      </div>
      <div class="modal-body">
          <p class="text-center">Current Image</p>
          <div id="img-change" class="text-center">
                <img id="modal-img" src="" alt="Not available"  style="max-height: 200px; max-width: 300px;">
          </div><br/><br/>
            <input type="hidden" name="item-id" id="item-id" value=""/>
            <div class="form-group">
                <div class="col-xs-12">
                 <span class="btn btn-lg btn-default btn-flat btn-file col-xs-10 col-xs-offset-1 ">
                    <i class="glyphicon glyphicon-open"></i> Choose Image <input type="file"  id="item_image" name="item_image" onchange="PreviewImage();">
                </span>
                 </div><br/><br/>
                <div class="col-xs-12">
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed only max_size = 150KB, max_width = 1024px, max_height = 768px, types = gif | jpg | png .</p>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary col-xs-6 col-sm-offset-2 btn-flat">Upload</button>
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
      <?=form_close(); ?>
    </div> <!-- modal-content --> 
  </div> <!-- .modal-dialog  -->
</div> <!-- .modal  -->

<!-- script For Display Image -->
<script type="text/javascript">
$(document).on("click", ".display-image", function () {
     var itemId = $(this).data('id'); //Get the id
     var imgId = $('a#'+itemId).html(); 
     imgId = imgId.replace('_thumb','');
     $("#display-image").html( imgId );
});
</script>

<!-- Modal For Display Image -->
<div class="modal fade" id="imgDisplay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-body text-center" id="display-image"></div>
  </div> <!-- .modal-dialog  -->
</div> <!-- .modal  -->


<!-- script For Barcode Image -->
<script type="text/javascript">
$(document).on("click", ".barcode", function () {
     var itemId = $(this).data('id'); //Get the id
     img = '<img src="<?php echo base_url();?>barcodes/'+itemId+'.jpg">';
     $("#view-barcode").html( img );
});
</script>

<!-- Modal For Barcode view -->
<div class="modal fade" id="viewBarcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Barcode Image</h4>
      </div>
        <div class="modal-body text-center" id="view-barcode"><p>Can't show the barcode.</p></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
    </div> <!-- modal-content --> 
  </div> <!-- .modal-dialog  -->
</div> <!-- .modal  -->
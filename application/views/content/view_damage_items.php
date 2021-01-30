<div class="box">
    <div class="box-header">
        <span class="box-title">Damage Items</span>
        <?php if ($this->session->userdata('role')): ?>
        <div class="content-nav">
            <div class="btn-group col-md-6 col-sm-10 col-xs-10 col-md-offset-3 col-sm-offset-2 col-xs-offset-2">
                <a href="<?=base_url('inventory/update_damage_item/add'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-plus-sign"></i> Add New</a>
                <a href="<?=base_url('inventory/update_damage_item/remove'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-minus-sign"></i> Remove</a>
                <a href="<?=base_url('csv/download_csv/inventory'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i> Download </a>
            </div>                              
        </div>
        <?php endif; ?>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="hidden-xs">Item Code</th>
                    <th>Item Name</th>
                    <th class="hidden-xs">Category</th>
                    <th class="hidden-md hidden-sm hidden-xs">Item Description</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($damage_items)): ?>
                    <?php foreach ($damage_items as $item): ?>
                        <tr>
                            <td class="hidden-xs"><?=$item->item_code?></td>
                            <td><?=$item->item_name?></td>
                            <td class="hidden-xs"><?=$item->cat_name?></td>
                            <td class="hidden-md hidden-sm hidden-xs"><?=$item->item_description?></td>
                            <td><?=$item->inventory_damage_qtt?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="hidden-xs">Item Code</th>
                    <th>Item Name</th>
                    <th class="hidden-xs">Category</th>
                    <th class="hidden-md hidden-sm hidden-xs">Item Description</th>
                    <th>Quantity</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
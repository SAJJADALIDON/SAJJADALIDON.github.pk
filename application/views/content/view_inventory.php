<div class="box">
    <div class="box-header">
        <span class="box-title">Inventory</span>
        <?php if ($this->session->userdata('role')): ?>
        <div class="content-nav">
            <div class="btn-group col-sm-6 col-xs-10 col-sm-offset-3 col-xs-offset-1">
                <a href="<?=base_url('inventory/item_in'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-plus-sign"></i> Inventory In</a>
                <a href="<?=base_url('inventory/item_out'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-minus-sign"></i> Inventory Out</a>
                <a href="<?=base_url('csv/download_csv/inventory'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i><span class="hidden-xs"> Download</span></a>
            </div>                              
        </div>
        <?php endif; ?>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th class="hidden-xs">Category</th>
                    <th class="hidden-md hidden-sm hidden-xs">Item Description</th>
                    <th>Quantity</th>
                    <th class="hidden-sm hidden-xs">Alert Qtt.</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($inventory)): ?>
                    <?php foreach ($inventory as $item): ?>
                        <tr class="<?=($item->inventory_quantity <= $item->alert_qtt)?'danger':''; ?>">
                            <td><?=$item->item_code; ?></td>
                            <td><?=$item->item_name; ?></td>
                            <td class="hidden-xs"><?=$item->cat_name; ?></td>
                            <td class="hidden-md hidden-sm hidden-xs"><?=$item->item_description; ?></td>
                            <td><?=$item->inventory_quantity; ?></td>
                            <td class="hidden-sm hidden-xs"><?=$item->alert_qtt; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th class="hidden-xs">Category</th>
                    <th class="hidden-md hidden-sm hidden-xs">Item Description</th>
                    <th>Quantity</th>
                    <th class="hidden-sm hidden-xs">Alert Qtt.</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
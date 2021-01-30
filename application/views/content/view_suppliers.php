<div class="box">
    <div class="box-header">
        <span class="box-title">Suppliers</span>
        <?php if ($this->session->userdata('role')): ?>
        <div class="content-nav">
            <div class="btn-group col-md-6 col-sm-8 col-xs-8 col-md-offset-3 col-sm-offset-2 col-xs-offset-2">
                <a href="<?php echo base_url('suppliers/add_supplier'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-plus-sign"></i> Add New </a>
                <a href="<?=base_url('csv/download_csv/supplier'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i> Download</a>
            </div>                              
        </div>
        <?php endif; ?>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th class="hidden-xs">Address</th>
                    <th>Phone</th>
                    <th class="hidden-xs">Email</th>
                    <th>Key Person</th>
                    <?php if ($this->session->userdata('role')): ?>
                    <th class="hidden-xs">Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($suppliers)): ?>
                    <?php foreach ($suppliers as $supplier): ?>
                        <tr>
                            <td>
                                <a href="#" data-name="supplier_name" data-type="text" data-url="<?=base_url('suppliers/update_supplier'); ?>" data-pk="<?=$supplier->supplier_id; ?>" class="data-modify-<?=$supplier->supplier_id; ?> no-style"><?=$supplier->supplier_name; ?></a>
                            </td>
                            <td class="hidden-xs">
                                <a href="#" data-name="supplier_address" data-type="textarea" data-rows="4" data-url="<?=base_url('suppliers/update_supplier'); ?>" data-pk="<?=$supplier->supplier_id; ?>" class="data-modify-<?=$supplier->supplier_id; ?> no-style"><?=$supplier->supplier_address; ?></a>
                            </td>
                            <td>
                                <a href="#" data-name="supplier_phone" data-type="text" data-url="<?=base_url('suppliers/update_supplier'); ?>" data-pk="<?=$supplier->supplier_id; ?>" class="data-modify-<?=$supplier->supplier_id; ?> no-style"><?=$supplier->supplier_phone; ?></a>
                            </td>
                            <td class="hidden-xs">
                                <a href="#" data-name="supplier_email" data-type="text" data-url="<?=base_url('suppliers/update_supplier'); ?>" data-pk="<?=$supplier->supplier_id; ?>" class="data-modify-<?=$supplier->supplier_id; ?> no-style"><?=$supplier->supplier_email; ?></a>
                            </td>
                            <td>
                                <a href="#" data-name="supplier_key_person" data-type="text" data-url="<?=base_url('suppliers/update_supplier'); ?>" data-pk="<?=$supplier->supplier_id; ?>" class="data-modify-<?=$supplier->supplier_id; ?> no-style"><?=$supplier->supplier_key_person; ?></a>
                            </td>
                            <?php if ($this->session->userdata('role')): ?>
                            <td class="hidden-xs">
                                <div class="btn-group">
                                  <a href="<?php echo base_url('suppliers/modify/' . $supplier->supplier_id); ?>"><i data-toggle="tooltip" data-placement="top" title="Modify" class="glyphicon glyphicon-edit"></i></a>&nbsp;
                                  <a data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this supplier?')" href="<?=base_url('suppliers/delete_supplier/'.$supplier->supplier_id); ?>" class=""><i class="glyphicon glyphicon-trash"></i></a>
                                </div>                              
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Supplier Name</th>
                    <th class="hidden-xs">Address</th>
                    <th>Phone</th>
                    <th class="hidden-xs">Email</th>
                    <th>Key Person</th>
                    <?php if ($this->session->userdata('role')): ?>
                    <th class="hidden-xs">Action</th>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
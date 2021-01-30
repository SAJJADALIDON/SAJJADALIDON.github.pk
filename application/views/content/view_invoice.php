<div class="box">
    <div class="box-header">
        <span class="box-title">Invoice</span>
        <?php if ($this->session->userdata('role')): ?>
        <div class="content-nav text-center">
            <div class="btn-group col-md-8 col-sm-10 col-xs-10 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
                <a href="<?=base_url('inventory/item_in'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-plus-sign"></i> Inventory In</a>
                <a href="<?=base_url('inventory/item_out'); ?>" class="btn btn-default btn-flat "><i class="glyphicon glyphicon-minus-sign"></i> Inventory Out</a>
                <a href="<?=base_url('csv/download_csv/invoice_purchase'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i> Purchase <span class="hidden-sm hidden-xs">Transections</span></a>
                <a href="<?=base_url('csv/download_csv/invoice_out'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i> Sales <span class="hidden-sm hidden-xs">Transections</span></a>
            </div>                              
        </div>
        <?php endif; ?>
    </div>  <!-- .box-header -->
    <br/>
    <div class="">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#purchases" data-toggle="tab"><strong>In</strong></a></li>
            <li><a href="#sales" data-toggle="tab"><strong>Out</strong></a></li>
        </ul>
        <div class="box-body table-responsive">
            <div class="tab-content">
                <div class="tab-pane active" id="purchases">
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th class="hidden-xs">Grand Total</th>
                                <th class="hidden-xs">User</th>
                                <th class="hidden-xs">Note</th>
                                <?php if ($this->session->userdata('role')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($purchases)): ?>
                                <?php foreach ($purchases as $purchase): ?>
                                    <tr>
                                        <td><?php echo $purchase->date; ?>
                                        </td>
                                        <td><?php echo $purchase->supplier_name; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo $purchase->total_price; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo $purchase->user_full_name; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo $purchase->note; ?>
                                        </td>
                                        <?php if ($this->session->userdata('role')): ?>
                                        <td>
                                            <a href="<?=base_url('invoice/view/purchase/'.$purchase->invoice_id); ?>" data-toggle="tooltip" data-placement="top" title="View Invoice"><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;
                                            <a href="<?=base_url('invoice/modify/purchase/'.$purchase->invoice_id); ?>" data-toggle="tooltip" data-placement="top" title="Modify"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;
                                            <a data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')" href="<?=base_url('invoice/delete/purchase/'.$purchase->invoice_id); ?>" class=""><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="6">
                                            <span>No data available.</span>
                                        </td>
                                    </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th class="hidden-xs">Grand Total</th>
                                <th class="hidden-xs">User</th>
                                <th class="hidden-xs">Note</th>
                                <?php if ($this->session->userdata('role')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="sales">
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Warehouse</th>
                                <th class="hidden-xs">Grand Total</th>
                                <th class="hidden-xs">User</th>
                                <th class="hidden-xs">Note</th>
                                <?php if ($this->session->userdata('role')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($sales)): ?>
                                <?php foreach ($sales as $sale): ?>
                                    <tr>
                                        <td><?php echo $sale->date; ?>
                                        </td>
                                        <td><?php echo $sale->warehouse_name; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo $sale->total_price; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo $sale->user_full_name; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo $sale->note; ?>
                                        </td>
                                        <?php if ($this->session->userdata('role')): ?>
                                        <td>
                                            <a href="<?=base_url('invoice/view/sales/'.$sale->invoice_id); ?>" data-toggle="tooltip" data-placement="top" title="View Invoice"><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;
                                            <a href="<?=base_url('invoice/modify/sales/'.$sale->invoice_id); ?>" data-toggle="tooltip" data-placement="top" title="Modify"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;
                                            <a data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')" href="<?=base_url('invoice/delete/sales/'.$sale->invoice_id); ?>" class=""><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="6">
                                            <span>No data available.</span>
                                        </td>
                                    </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Warehouse</th>
                                <th class="hidden-xs">Grand Total</th>
                                <th class="hidden-xs">User</th>
                                <th class="hidden-xs">Note</th>
                                <?php if ($this->session->userdata('role')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- .tab-pane -->
            </div><!-- .tab-content -->
        </div><!-- .tab-content -->
    </div><!-- nav-tabs-custom -->
</div> <!-- .box -->
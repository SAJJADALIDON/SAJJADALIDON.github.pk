<?php 
$str = '[';
foreach ($users as $value) {
   $str .= "{value:'".$value->user_full_name."' ,text:'".$value->user_full_name." '},";
}
$str = substr($str, 0, -1);
$str .= "]";
?>
<div class="box">
    <div class="box-header">
        <span class="box-title">Settings</span>
    </div><!-- /.box-header -->
    <div class="">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#warehouse" data-toggle="tab"><strong>Warehouses</strong></a></li>
            <li><a href="#category" data-toggle="tab"><strong>Categories</strong></a></li>
            <li><a href="#system" data-toggle="tab"><strong>System Settings</strong></a></li>
        </ul>
        <div class="box-body table-responsive">
            <div class="tab-content">
                <div class="tab-pane active" id="warehouse">
                    <?php if ($this->session->userdata('role')): ?>
                        <div class="content-nav">
                            <div class="btn-group col-md-4 col-sm-8 col-xs-8 col-md-offset-4 col-sm-offset-2 col-xs-offset-2">
                                <a href="<?php echo base_url('settings/add_warehouse'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-plus-sign"></i> Add Warehouse </a>
                                <a href="<?=base_url('csv/download_csv/warehouse'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i> Download csv</a>
                            </div>                              
                        </div><br/><br/><br/>
                    <?php endif; ?>
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Warehouse Name</th>
                                <th>Incharge</th>
                                <th class="hidden-xs">Phone</th>
                                <th class="hidden-sm hidden-xs">Address</th>
                                <th class="hidden-xs">Email</th>
                                <?php if ($this->session->userdata('role')): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($warehouses)): ?>
                                <?php foreach ($warehouses as $warehouse): ?>
                                    <tr>
                                        <td>
                                            <a href="#" data-name="warehouse_name" data-type="text" data-url="<?= base_url('settings/update_warehouse'); ?>" data-pk="<?= $warehouse->warehouse_id; ?>" class="data-modify-<?= $warehouse->warehouse_id; ?> no-style"><?= $warehouse->warehouse_name; ?></a>
                                        </td>
                                        <td>
                                            <a href="#" data-name="warehouse_incharge" data-type="select" data-source="<?=$str; ?>" data-value="<?= $warehouse->warehouse_incharge; ?>" data-url="<?= base_url('settings/update_warehouse'); ?>" data-pk="<?= $warehouse->warehouse_id; ?>" class="data-modify-<?= $warehouse->warehouse_id; ?> no-style"><?= $warehouse->warehouse_incharge; ?></a>
                                        </td>
                                        <td class="hidden-xs">
                                            <a href="#" data-name="warehouse_phone" data-type="text" data-url="<?= base_url('settings/update_warehouse'); ?>" data-pk="<?= $warehouse->warehouse_id; ?>" class="data-modify-<?= $warehouse->warehouse_id; ?> no-style"><?= $warehouse->warehouse_phone; ?></a>
                                        </td>
                                        <td class="hidden-sm hidden-xs">
                                            <a href="#" data-name="warehouse_address" data-type="textarea" data-rows="4" data-url="<?= base_url('settings/update_warehouse'); ?>" data-pk="<?= $warehouse->warehouse_id; ?>" class="data-modify-<?= $warehouse->warehouse_id; ?> no-style"><?= $warehouse->warehouse_address; ?></a>
                                        </td>
                                        <td class="hidden-xs">
                                            <a href="#" data-name="warehouse_email" data-type="text" data-url="<?= base_url('settings/update_warehouse'); ?>" data-pk="<?= $warehouse->warehouse_id; ?>" class="data-modify-<?= $warehouse->warehouse_id; ?> no-style"><?= $warehouse->warehouse_email; ?></a>
                                        </td>
                                        <?php if ($this->session->userdata('role')): ?>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-default modify" name="modify-<?= $warehouse->warehouse_id; ?>"><i class="glyphicon glyphicon-edit"></i><span class="hidden-sm hidden-xs">  Modify</span></a>
                                                <a onclick="return confirm('Are you sure you want to delete this warehouse?')" href="<?= base_url('settings/delete_warehouse/' . $warehouse->warehouse_id); ?>"  class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="hidden-sm hidden-xs"> Delete</span></a>
                                            </div>                              
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="7">
                                            <span>No data available.</span>
                                        </td>
                                    </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Warehouse Name</th>
                                <th>Incharge</th>
                                <th class="hidden-xs">Phone</th>
                                <th class="hidden-sm hidden-xs">Address</th>
                                <th class="hidden-xs">Email</th>
                                <?php if ($this->session->userdata('role')): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- .tab-pane -->
                <div class="tab-pane" id="category">
                    <?php if ($this->session->userdata('role')): ?>
                        <div class="content-nav text-center">
                            <div class="btn-group col-md-4 col-sm-8 col-xs-8 col-md-offset-4 col-sm-offset-2 col-xs-offset-2">
                                <a href="<?php echo base_url('items/add_category'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-plus-sign"></i> Add Category </a>
                                <a href="<?=base_url('csv/download_csv/category'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-save"></i> Download csv</a>
                            </div>                              
                        </div><br/><br/><br/>
                    <?php endif; ?>
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <?php if ($this->session->userdata('role')): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?php echo $category->cat_id; ?>
                                        </td>
                                        <td>
                                            <a href="#" data-name="cat_name" data-type="text" data-url="<?= base_url('items/update_category'); ?>" data-pk="<?= $category->cat_id; ?>" class="data-modify-<?= $category->cat_id; ?> no-style"><?= $category->cat_name; ?></a>
                                        </td>
                                        <?php if ($this->session->userdata('role')): ?>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-default modify" name="modify-<?= $category->cat_id; ?>"><i class="glyphicon glyphicon-edit"></i><span class="hidden-sm hidden-xs">  Modify</span></a>
                                                <a onclick="return confirm('Are you sure you want to delete this category?')" href="<?= base_url('items/delete_category/' . $category->cat_id); ?>"  class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="hidden-sm hidden-xs"> Delete</span></a>
                                            </div>                              
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="7">
                                            <span>No data available.</span>
                                        </td>
                                    </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <?php if ($this->session->userdata('role')): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- .tab-pane -->
                <div class="tab-pane" id="system">
                    <div class="box-header">
                        <?php if ($this->session->userdata('role')): ?>
                            <div class="content-nav">
                                <a name="modify" href = "#" class="btn btn-default btn-flat modify col-md-3 col-sm-4 col-xs-6 col-md-offset-5 col-sm-offset-4 col-xs-offset-3">
                                    <i class="glyphicon glyphicon-edit"></i> Modify Settings
                                </a>
                            </div>
                        <?php endif; ?>
                    </div><!-- /.box-header -->
                    <br/>
                    <dl class="dl-horizontal">
                        <dt>Brand Name: </dt>
                        <dd>
                            <blockquote>
                                <p>
                                    <a href="#" data-name="brand_name" data-type="text" data-url="<?php echo base_url('settings/update'); ?>" data-pk="<?= @$settings->settings_id; ?>" class="data-modify no-style"><?= @$settings->brand_name; ?></a>
                                </p>
                            </blockquote>
                        </dd>
                        <dt>Alert Email ID: </dt>
                        <dd>
                            <blockquote>
                                <p>
                                    <a href="#" data-name="alert_email" data-type="text" data-url="<?php echo base_url('settings/update'); ?>" data-pk="<?= @$settings->settings_id; ?>" class="data-modify no-style"><?= @$settings->alert_email; ?></a>
                                </p>
                            </blockquote>
                        </dd>
                        <dt>Alert Status: </dt>
                        <dd>
                            <blockquote>
                                <p>
                                    <a href="#" data-name="alert_on" data-type="select" data-source="[{value:0,text:'Off'},{value:1,text:'On'}]" data-value="<?= (@$settings->alert_on) ? '1' : '0'; ?>" data-url="<?php echo base_url('settings/update'); ?>" data-pk="<?= @$settings->settings_id; ?>" class="data-modify no-style"><?= (@$settings->alert_on) ? 'On' : 'Off'; ?></a>
                                </p>
                            </blockquote>
                        </dd>
                        <dt>Contact Phone: </dt>
                        <dd>
                            <blockquote>
                                <p>
                                    <a href="#" data-name="phone" data-type="text" data-url="<?php echo base_url('settings/update'); ?>" data-pk="<?= @$settings->settings_id; ?>" class="data-modify no-style"><?= @$settings->phone; ?></a>
                                </p>
                            </blockquote>
                        </dd>
                        <dt>Address: </dt>
                        <dd>
                            <blockquote>
                                <p>
                                    <a href="#" data-name="address" data-type="textarea" data-rows="2"  data-url="<?php echo base_url('settings/update'); ?>" data-pk="<?= @$settings->settings_id; ?>" class="data-modify no-style"><?= @$settings->address; ?></a>
                                </p>
                            </blockquote>
                        </dd>
                    </dl>
                </div><!-- /.tab-pane -->
            </div><!-- .tab-content -->
        </div><!-- .tab-content -->
    </div><!-- nav-tabs-custom -->
</div> <!-- .box -->
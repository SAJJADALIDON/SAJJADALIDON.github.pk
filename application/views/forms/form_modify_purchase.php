<?php //echo "<pre/>"; print_r($invoice); exit(); ?>
<?php
$ids = explode(',', $invoice->item_ids);
$price = explode(',', $invoice->unit_prices);
$quantity = explode(',', $invoice->quantities);
?>

<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Modify Purchase</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

            <?=form_open(base_url().'invoice/update/purchase/'.$invoice->invoice_id, 'role="form" class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="supplier" class="col-sm-2 hidden-xs control-label col-xs-offset-0 col-xs-2">Supplier: *</label>
                <div class="col-sm-6 col-xs-12">
                    <select name="supplier" id="supplier" class="form-control" required >
                        <option value="">Select Supplier</option>
                        <?php foreach ($suppliers as $supplier) { ?>
                            <option value="<?=$supplier->supplier_id;?>" <?=($invoice->supplier_id == $supplier->supplier_id)?'selected':'';?> ><?=$supplier->supplier_name;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="note" class="col-sm-2 hidden-xs control-label col-xs-offset-0 col-xs-2">Note: </label>
                <div class="col-sm-6 col-xs-12">
                    <?php
                    $data_text = array(
                        'name'        => 'note',
                        'id'          => 'note',
                        'value'       => $invoice->note,
                        'rows'        => '2',
                        'placeholder' => 'Invoice note',
                        'class'       => 'form-control',
                      );
                    echo form_textarea($data_text) ?>
                </div>
            </div>
            <?php
            $rowOption = '';
            $option = array();
            $option[0] = 'Remove The Item';
            foreach ($items as $item) {
                    $option[$item->item_id] = $item->item_name;                                    
            }
            ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="item_area">
                    <?php 
                    foreach ($ids as $key => $id){ ?>
                    <tr>
                        <td>
                           <?=form_dropdown('item['.($key+1).']', $option, $id, 'class="form-control"') ?>
                        </td>
                        <td><?=form_input('unit_price['.($key+1).']', $price[$key], 'placeholder="Unit Price" class="form-control" required') ?></td>
                        <td><?=form_input('quantity['.($key+1).']', $quantity[$key], 'placeholder="Quantity" class="form-control" required') ?></td>
                    </tr>
                    <?php 
                    } ?>
                </tbody>
            </table><br/><br/>
            <div>
                <button type="submit" class="btn btn-primary btn-flat col-xs-6 col-xs-offset-2  col-sm-offset-3"><i class="glyphicon glyphicon-ok"></i> Save</button>&nbsp;
                <button type="reset" class="btn btn-default btn-flat">Reset</button>
            </div>
            <?=form_close(); ?>
            <br/>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.row -->
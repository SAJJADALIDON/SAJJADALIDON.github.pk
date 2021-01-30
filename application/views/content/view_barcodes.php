<div class="box  col-xs-12">
    <div class="box-header">
        <span class="box-title">Items Barcodes</span>
        <div class="content-nav">
            <a href="javascript:window.print()" class="btn btn-default btn-flat col-md-3 col-sm-4 col-xs-6 col-md-offset-3 col-sm-offset-2 col-xs-offset-2">
                <i class="glyphicon glyphicon-print"></i> Print
            </a>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
            <?php if (!empty($items)): ?>
                <p class="thumbnail_container">
                <?php foreach ($items as $item): ?>
                    <p class="text-center thumbnail col-md-3 col-sm-4 col-xs-6">
                    <span class="item_code"><?php echo $item->item_code; ?></span>
                    <img src="<?php echo base_url().'barcodes/'.strtoupper($item->item_code).'.jpg';?>" ><br/>
                    </p>
                <?php endforeach; ?>
                </p>
            <?php else: ?>
                        <p>No data available.</p>
            <?php endif; ?>
    </div><!-- /.box-body -->
</div><!-- /.box -->
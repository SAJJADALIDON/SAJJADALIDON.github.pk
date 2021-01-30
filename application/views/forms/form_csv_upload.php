<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">CSV Upload</h3>
        <?php if ($this->session->userdata('role')): ?>
        <div class="content-nav col-lg-offset-8 col-md-offset-7 col-sm-offset-6 col-xs-offset-6">
            <a href="<?=base_url('csv/download_csv/category'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-list"></i><span class="hidden-xs"> Download</span> category</a>
            <a href="<?=base_url('csv/download_template'); ?>" class="btn btn-warning btn-flat"><i class="glyphicon glyphicon-save"></i><span class="hidden-xs"> Download</span> template</a>
        </div>
        <?php endif; ?>
        </div><!-- /.box-header -->
        <div class="box-body">            
            <div class="col-xs-10 col-xs-offset-1">
                <h3>Important to know before upload!</h3>
                <p><strong> >> </strong> Download the template csv file to upload your data.</p>
                <p><strong> >> </strong> Download the category file to know category ids.</p>
                <p><strong> >> </strong> The first row of a template CSV file as a column header row. Don't change the first row of the template csv file.</p>
                <p><strong> >> </strong> Maximun file size 1MB.</p>
                <p class=""><strong> Warning:</strong> The function assumes that the number of column headers will match the number of values in each row.</p>
            <br/>
            </div>
            <form id="csv-upload-form" method="post" action="<?php echo base_url() ?>csv/importcsv" enctype="multipart/form-data">
                <div class="row">
                <span class="btn btn-lg btn-default btn-flat btn-file col-sm-3 col-xs-4 col-xs-offset-1">
                    <i class="glyphicon glyphicon-open"></i> Upload CSV<input type="file" name="csv_file" onchange="this.form.submit()" >
                </span>
                </div>
            </form>
            <br/>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.row -->
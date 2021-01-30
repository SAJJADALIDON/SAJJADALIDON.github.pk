<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Reset Password</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=form_open(base_url('login/reset_password'), 'role="form" class="form-horizontal"'); ?>
            <?=form_hidden('key', $key);?>
            <?=form_hidden('mail', $mail);?>
            <div class="form-group">
                <label for="password" class="col-sm-2 hidden-xs control-label col-xs-offset-1">New Password: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_password('password', '', 'id="password" placeholder="New Password (Minimum 6 character)" class="form-control" required="required"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cpassword" class="col-sm-2 col-md-3 hidden-xs control-label col-sm-offset-1 col-md-offset-0">Confirm New Password: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_password('cpassword', '', 'id="cpassword" placeholder="Confirm New Password" class="form-control" required="required"') ?>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-flat col-xs-6 col-xs-offset-2  col-sm-offset-3"><i class="glyphicon glyphicon-retweet"></i> Reset Password</button>&nbsp;
                <a href="<?=base_url('login')?>" class="btn btn-default btn-flat">Cancel</a>
            </div>
            <?=form_close(); ?>
            <br/>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.row -->
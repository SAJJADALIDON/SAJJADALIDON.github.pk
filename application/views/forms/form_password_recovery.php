<div class="row">
    <div class="col-xs-12">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Password Recovery</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

            <?=form_open(base_url('login/password_recovery'), 'role="form" class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="email" class="col-sm-2 hidden-xs control-label col-xs-offset-1 col-xs-2">You Email: *</label>
                <div class="col-sm-8 col-xs-12">
                    <?=form_input('email', set_value('email'), 'id="email" placeholder="User Email Address" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="user@domain.com" class="form-control" required') ?>
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
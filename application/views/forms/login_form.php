<div class="row">
    <?=form_open(base_url('login')); ?>
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-4 col-sm-4">
            <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>   
        </div>
    </div>
    <div class="login-form form-signin">
        <h1 class="text-center login-title">Sign in</h1>
        <img class="profile-img" src="<?=base_url('assets/images/photo.jpg') ?>" alt="">
        <?=form_input('email',  set_value('email'), 'type="email" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Email" class="form-control" required autofocus') ?>
        <?=form_password('password', '', 'placeholder="Password" class="form-control" required') ?>
        <button class="btn btn-lg btn-danger btn-block" type="submit">Sign in</button>
        <label class="checkbox pull-left">
            <i class="glyphicon glyphicon-question-sign"> </i> <a href="<?=base_url('login/password_recovery'); ?>"> Forgot Password.</a>
        </label>
    </div>
    <?=form_close(); ?>
</div> <!-- /.row -->
<div class="box">
    <div class="box-header">
        <span class="box-title">Users</span>
        <?php if ($this->session->userdata('role')): ?>
            <div class="content-nav">
                <a href="<?php echo base_url('users/add_user'); ?>" class="btn btn-default btn-flat col-md-3 col-sm-4 col-xs-6 col-sm-offset-4 col-xs-offset-3">
                    <i class="glyphicon glyphicon-plus-sign"></i> Add New User
                </a>
            </div>
        <?php endif; ?>
    </div>  <!-- .box-header -->
    <br/>
    <div class="">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#user" data-toggle="tab"><strong>Users</strong></a></li>
            <li><a href="#admin" data-toggle="tab"><strong>Admins</strong></a></li>
        </ul>
        <div class="box-body table-responsive">
            <div class="tab-content">
                <div class="tab-pane active" id="user">
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th class="hidden-xs">Email</th>
                                <th class="hidden-sm hidden-xs">Address</th>
                                <th>User Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <?php if (!$user->user_role): ?>
                                    <tr>
                                        <td>
                                            <a href="#" data-name="user_name" data-type="text" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_full_name; ?></a>
                                        </td>
                                        <td>
                                            <a href="#" data-name="user_phone" data-type="text" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_phone; ?></a>
                                        </td>
                                        <td class="hidden-xs">
                                            <a href="#" data-name="user_email" data-type="text" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_email; ?></a>
                                        </td>
                                        <td class="hidden-sm hidden-xs">
                                            <a href="#" data-name="user_address" data-type="textarea" data-rows="4" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_address; ?></a>
                                        </td>
                                        <td>
                                            <a href="#" data-name="user_role" data-type="select" data-url="<?= base_url('users/update_user'); ?>" data-source="[{value:0,text:'User'},{value:1,text:'Admin'}]" data-value="<?= $user->user_role; ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= ($user->user_role) ? 'Admin' : 'User'; ?></a>
                                        </td>
                                        <td>
                                            <?php if ($this->session->userdata('role') OR ($this->session->userdata('user_id') == $user->user_id)): ?>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-default modify" name="modify-<?= $user->user_id; ?>"><i class="glyphicon glyphicon-edit"></i><span class="hidden-sm hidden-xs">  Modify</span></a>
                                                <?php if (($this->session->userdata('user_id') == $user->user_id) OR ($this->session->userdata('user_id') == 1)): ?>
                                                <a href="#changePass" class="update btn btn-sm btn-default" data-id="<?=$user->user_id; ?>" data-toggle="modal"><i class="glyphicon glyphicon-asterisk"></i><span class="hidden-sm hidden-xs"> Password</span></a>
                                                <?php endif; ?>
                                                <a onclick="return confirm('Are you sure you want to delete this user?')" href="<?= base_url('users/delete_user/' . $user->user_id); ?>"  class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="hidden-sm hidden-xs"> Delete</span></a>
                                            </div>   
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
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
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th class="hidden-xs">Email</th>
                                <th class="hidden-sm hidden-xs">Address</th>
                                <th>User Role</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="admin">
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th class="hidden-xs">Email</th>
                                <th class="hidden-sm hidden-xs">Address</th>
                                <th>User Role</th>
                                <?php if ($this->session->userdata('role')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <?php if ($user->user_role): ?>
                                    <?php if (($user->user_id == 1) AND ($this->session->userdata('user_id') != 1)){
                                        continue;
                                    } ?>
                                    <tr>
                                        <td>
                                            <a href="#" data-name="user_name" data-type="text" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_full_name; ?></a>
                                        </td>
                                        <td>
                                            <a href="#" data-name="user_phone" data-type="text" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_phone; ?></a>
                                        </td>
                                        <td class="hidden-xs">
                                            <a href="#" data-name="user_email" data-type="text" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_email; ?></a>
                                        </td>
                                        <td class="hidden-sm hidden-xs">
                                            <a href="#" data-name="user_address" data-type="textarea" data-rows="4" data-url="<?= base_url('users/update_user'); ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= $user->user_address; ?></a>
                                        </td>
                                        <td>
                                            <a href="#" data-name="user_role" data-type="select" data-url="<?= base_url('users/update_user'); ?>" data-source="[{value:0,text:'User'},{value:1,text:'Admin'}]" data-value="<?= $user->user_role; ?>" data-pk="<?= $user->user_id; ?>" class="data-modify-<?= $user->user_id; ?> no-style"><?= ($user->user_role) ? 'Admin' : 'User'; ?></a>
                                        </td>
                                        <?php if ($this->session->userdata('role')): ?>
                                        <td>
                                            <?php if (($this->session->userdata('user_id') == $user->user_id) OR ($this->session->userdata('user_id') == 1)): ?>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-default modify" name="modify-<?= $user->user_id; ?>"><i class="glyphicon glyphicon-edit"></i><span class="hidden-sm hidden-xs">  Modify</span></a>
                                                <a href="#changePass" class="update btn btn-sm btn-default" data-id="<?= $user->user_id; ?>" data-toggle="modal"><i class="glyphicon glyphicon-asterisk"></i><span class="hidden-sm hidden-xs"> Password</span></a>
                                                <a onclick="return confirm('Are you sure you want to delete this user?')" href="<?= base_url('users/delete_user/' . $user->user_id); ?>"  class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="hidden-sm hidden-xs"> Delete</span></a>
                                            </div>                              
                                            <?php endif; ?>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th class="hidden-xs">Email</th>
                                <th class="hidden-sm hidden-xs">Address</th>
                                <th>User Role</th>
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

<!-- script For Update Image -->
<script type="text/javascript">
$(document).on("click", ".update", function() {
    var Id = $(this).data('id'); //Get the id
    $(".modal-content #id").val(Id);
});
</script>

<!-- Modal For change Password -->
<div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?=form_open(base_url('users/update_password'), 'role="form" class="form-horizontal"'); ?>
            <input type="hidden" name="id" value="" id="id"/>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-10 col-xs-12 col-sm-offset-1">
                        <?=form_password('current-pass', '', 'placeholder="Current Password" class="form-control" required') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-xs-12 col-sm-offset-1">
                        <?=form_password('password', '', 'placeholder="Password (Minimum 6 characters)" class="form-control" required') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-xs-12 col-sm-offset-1">
                        <?=form_password('c-password', '', 'placeholder="Confirm Password" class="form-control" required') ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary col-xs-6 col-sm-offset-2 btn-flat">Update</button>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div> <!-- modal-content --> 
    </div> <!-- .modal-dialog  -->
</div> <!-- .modal  -->
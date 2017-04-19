<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
?>
<div class="container paddingT75">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <h2 class="col-lg-12">Edit User</h2>
                <br>
                <br>
                <form role="form" method="post" action="<?=base_url();?>Manage_user/update_user/<?=$e_user[0]->id;?>">
                    <div class="form-group col-md-3">
                        <label for="username">Username *</label>
                        <input type="text" class="form-control custom-text" name="username"  maxlength="50" placeholder="Username *" value="<?php echo $e_user[0]->username;?>" required="" readonly>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="full_name">Full Name *</label>
                        <input type="text" class="form-control custom-text" name="full_name"  maxlength="50" placeholder="Full Name *" value="<?php echo $e_user[0]->full_name;?>" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="role">User Role *</label>
                        <?php
                        $select_id=$e_user[0]->role;
                        ?>
                        <select name="role" class="form-control custom-text" required>
                            <option value="">Select role</option>
                            <option <?php if($select_id=='student') echo 'selected'; ?>  value="student">student</option>
                            <option <?php if($select_id=='teacher') echo 'selected'; ?>  value="teacher">teacher</option>
                            <option <?php if($select_id=='admin') echo 'selected'; ?>  value="admin">admin</option>
                            <option <?php if($select_id=='supeadmin') echo 'selected'; ?>  value="supeadmin">supeadmin</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-default custom-text">Update</button>
                    </div>
                </form>
            </div>
            <?php if (isset($success_msg)) { echo $success_msg; } ?>
        </div>
    </div>
</div>
<!-- /edit_profile_personal -->
<?php
$this->load->view('common/footer');
?>

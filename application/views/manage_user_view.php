<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
?>
<div class="container paddingT75">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <h3>Manage Users</h3>
                    <hr>
                    <a href="<?=base_url();?>manage_user/add_user">Add user</a>
                    <a class="download-pdf" target="_blank" title="Download as PDF" href="<?=base_url();?>manage_user/user_pdf"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""> </a>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Role</th>
                                <th colspan="2" class="txt-center">Option</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php $k=1; for ($i = 0; $i < count($all_user); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <td><?php echo $all_user[$i]->username;?></td>
                                <td><?php echo $all_user[$i]->full_name;?></td>
                                <td><?php echo $all_user[$i]->role;?></td>
                                <td><a href="<?=base_url();?>manage_user/load_edit_user/<?=$all_user[$i]->id;?>"> Edit </a></td>
                                <td><a href="<?=base_url();?>manage_user/delete_user/<?=$all_user[$i]->id;?>" onclick="return confirm('Are you sure you want to delete this item?');"> Delete </a></td>
                            </tr>
                        <?php $k++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /news -->

<?php
$this->load->view('common/footer');
?>

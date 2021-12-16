<?php
    $id = $this->uri->segment(5);
    $league_id = $this->uri->segment(4);
    $routes = "admin/sport-club/action/".(!empty($id) ? $league_id."/".$id : $league_id);
    echo form_open_multipart($routes, array("class"=>"modal-content")); 
?>
<!-- <form class="modal-content" method="post"> -->
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit User</h5>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label" for="name">Nama League</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nama League" value="<?php echo set_value('name') ? set_value('name') : (isset($data_sportClub) ? $data_sportClub->name : ''); ?>">
            <span class="alert-danger"><?php echo form_error('name'); ?></span>
        </div>
        <div class="mb-3">
            <label class="form-label" for="country">Negara</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Negara" value="<?php echo set_value('country') ? set_value('country') : (isset($data_sportClub) ? $data_sportClub->country : ''); ?>">
            <span class="alert-danger"><?php echo form_error('country'); ?></span>
        </div>
        <div class="mb-3>
            <label class="form-label" for="logo">Logo</label>
            
            <input type="file" class="form-control" id="logo" name="logo"  >
            <?php 
            if (!empty($id)) {
            ?>
                <img src="<?php echo isset($data_sportClub) ? $data_sportClub->logo : ''; ?>" width="150" height="150"alt="">
                <?php echo $data_sportClub->logo;?>
                <input type='hidden' name='logo-lama' value="<?php echo $data_sportClub->logo?>">
                <span class="alert-danger"><?php echo form_error('logo-lama'); ?></span>
            <?php
            }
            ?>
            <span class="alert-danger"><?php echo form_error('logo'); ?></span>
        </div>
   
    </div>
    <div class="modal-footer">
    <button type="button" onclick="history.back()" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

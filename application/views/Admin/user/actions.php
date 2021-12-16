<form class="modal-content" method="post">
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit User</h5>
    </div>
    <div class="modal-body">
    <div class="mb-3">
        <label class="form-label" for="first-name">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Jhon Doe" value="<?php echo set_value('fullname') ? set_value('fullname') : (isset($data_user) ? $data_user->fullname : '') ; ?>">
        <span class="alert-danger"><?php echo form_error('fullname'); ?></span>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
        <label class="form-label" for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Jhon04" value="<?php echo set_value('username') ? set_value('username') : (isset($data_user) ? $data_user->username : '') ; ?>">
        <span class="alert-danger"><?php echo form_error('username'); ?></span>
        </div>
        <div class="mb-3 col-md-6">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="******">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">e-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="jhon04@example.com" value="<?php echo set_value('email') ? set_value('email') : (isset($data_user) ? $data_user->email : '') ; ?>"> 
        <span class="alert-danger"><?php echo form_error('email'); ?></span>
    </div>
    <div class="mb-3">
        <label class="form-label" for="gender">Gender</label>
        <input type="hidden" name="gender-lama" value="<?php echo !empty($data_user)  ? $data_user->gender : ''?>">
        <div class="form-check">
            <label class="form-label form-check-label">
            <input type="checkbox" name="gender" id="gender" value="male" class="form-check-input"<?php echo set_value('gender') === "male" ? 'checked' : ( !empty($data_user) && $data_user->gender  === 'male' ? 'checked disabled' : '') ; ?>> Male </label>
        </div>
        <div class="form-check">
            <label class="form-label form-check-label">
            <input type="checkbox" name="gender" id="gender" value="female" class="form-check-input" <?php echo set_value('gender') === "female" ? 'checked' : ( !empty($data_user)  && $data_user->gender === 'female' ? 'checked disabled' : '') ; ?> <?php isset($data_user->gender) && $data_user->gender  === 'female' ? 'disabled' : '' ; ?>>Female </label>
        </div>
        <span class="alert-danger"><?php echo form_error('gender'); ?></span>
        <span class="alert-danger"><?php echo form_error('gender-lama'); ?></span>

    </div>
    <div class="mb-3">
        <label for="role">Role</label>
        <select class="form-control" name="role" id="role">
        <?php 
            $role = ['admin', 'editor','user', 'guest'];
            foreach($role as $data){
                if ($data === set_value('role') || $data ===  $data_user->role)
                {
                    echo "<option value='$data' selected>".ucfirst($data)."</option>";
                }
                else {

                    echo "<option value='$data'>".ucfirst($data)."</option>";
                }
            }
        ?>
        <span class="alert-danger"><?php echo form_error('role'); ?></span>
        </select>
    </div>



    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/user')?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
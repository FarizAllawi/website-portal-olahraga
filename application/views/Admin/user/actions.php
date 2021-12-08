<form method="post">
    <label for="fullname">Nama Lengkap</label>
    <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname') ? set_value('fullname') : (isset($data_user) ? $data_user->fullname : '') ; ?>"><br>

    <label for="email">email</label>
    <input type="email" name="email" id="email" value="<?php echo set_value('email') ? set_value('email') : (isset($data_user) ? $data_user->email : '') ; ?>"><br>

    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?php echo set_value('username') ? set_value('username') : (isset($data_user) ? $data_user->username : '') ; ?>"><br>

    <label for="password">Password</label>
    <input type="text" name="password" id="password"><br>

    <label for="gender">Gender</label>
    <input type="checkbox" name="gender" id="gender" value="male" <?php echo set_value('gender') === "male" ? 'checked' : ( isset($data_user->gender) && $data_user->gender  === 'male' ? 'checked' : '') ; ?>>Male
    <input type="checkbox" name="gender" id="gender" value="female" <?php echo set_value('gender') === "female" ? 'checked' : ( isset($data_user->gender)  && $data_user->gender === 'female' ? 'checked' : '') ; ?>>Female <br>
    
    <label for="role">Role</label>
    <select name="role" id="role" value="male">Male

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
    </select>
    <br>
    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
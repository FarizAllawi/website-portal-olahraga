<form method="post">
    <label for="name_league">Nama Club</label>
    <input type="text" name="name" id="name" value="<?php echo set_value('name') ? set_value('name') : (isset($data_sportClub) ? $data_sportClub->name : '') ; ?>"><br>
    
    <label for="name_league">Negara</label>
    <input type="text" name="country" id="country" value="<?php echo set_value('country') ? set_value('country') : (isset($data_sportClub) ? $data_sportClub->country : '') ; ?>"><br>

    <label for="avatar">Logo</label>
	<input type="file" name="avatar" id="avatar" accept="image/png, image/jpeg, image/jpg, image/gif">

    <label for="sport_type">Sport Club</label>
    <select name="sport_type">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_sportType)) {
        echo "<option><strong>Data Tipe Olahraga Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('sport_type')) || (set_value('sport_type') == "--- Pilih Tipe Olahraga ---") ?"<option>--- Pilih Tipe Olahraga ---</option>" : ''; 
        foreach ($data_sportType as $sport) {
            if ( (isset($data_league) && $data_league->sport_type == $sport->id) || set_value('sport_type') == $sport->id) {
                echo "<option value='$sport->id'selected>$sport->name_type</option>";  
            }
            else {
                echo "<option value='$sport->id'>$sport->name_type</option>";
            }
                    
        }
    }
    ?>
    </select>
    <label for="name_league">Nama Liga</label>
    <input type="text" name="name_league" id="name_league" value="<?php echo set_value('name_league') ? set_value('name_league') : (isset($data_league) ? $data_league->name_league : '') ; ?>"><br>
    
    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
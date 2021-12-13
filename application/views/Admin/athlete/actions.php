<?php 
    $id_match = $this->uri->segment(4);
    $id_athlete = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : null;
    echo form_open_multipart("admin/athlete/action/$id_match/$id_athlete");

?>

    <label for="photo-baru">Photo</label>
    <input type="file" name="photo" id="photo-baru">
    <?php 
    if (!empty($id_athlete)) {
    ?>
            <input type='hidden' name='photo-lama' value="<?php echo $data_athlete->photo?>">
    <?php
        }
    ?>
    <br>

    <label for="name">Nama Athlete</label>
    <input type="text" name="name" id="name" value="<?php echo set_value('name') ? set_value('name') : (isset($data_athlete) ? $data_athlete->name : ''); ?>"><br>
    
    <label for="gender">Gender</label>
    <input type="checkbox" name="gender" id="gender" value="male" <?php echo set_value('gender') === "male" ? 'checked' : ( isset($data_athlete->gender) && $data_athlete->gender  === 'male' ? 'checked' : '') ; ?>>Male
    <input type="checkbox" name="gender" id="gender" value="female" <?php echo set_value('gender') === "female" ? 'checked' : ( isset($data_athlete->gender)  && $data_athlete->gender === 'female' ? 'checked' : '') ; ?>>Female <br>

    <label for="gender">Tanggal Lahir</label>
    <input type="date" name="date_birth" id="date_birth" value="<?php echo set_value('date_birth') ? set_value('date_birth') : (isset($data_athlete) ? $data_athlete->date_birth : ''); ?>"><br>

    <label for="backNumber">Back Number</label>
    <input type="text" name="backNumber" id="backNumber" value="<?php echo set_value('backNumber') ? set_value('backNumber') : (isset($data_athlete) ? $data_athlete->backNumber : ''); ?>"><br>

    <label for="backNumber">Height</label>
    <input type="text" name="height" id="height" value="<?php echo set_value('height') ? set_value('height') : (isset($data_athlete) ? $data_athlete->height : ''); ?>"><br>

    <label for="backNumber">Weight</label>
    <input type="text" name="weight" id="weight" value="<?php echo set_value('weight') ? set_value('weight') : (isset($data_athlete) ? $data_athlete->weight : ''); ?>"><br>

    <label for="player_type">Player Type</label>
    <select name="player_type">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_playerType)) {
        echo "<option><strong>Data Player Type Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('player_type')) || (set_value('player_type') == "--- Pilih Player Type ---") ?"<option>--- Pilih Player Type ---</option>" : ''; 
        foreach ($data_playerType as $playerType) {
            if ( (isset($data_athlete) && $data_athlete->player_type == $playerType->id) || set_value('playerType') == $playerType->id) {
                echo "<option value='$playerType->id' selected>$playerType->player_type</option>";  
            }
            else {
                echo "<option value='$playerType->id'>$playerType->player_type</option>";
            }
                    
        }
    }
    ?>
    </select><br>

    <label for="sport_club">Sport Club</label>
    <select name="sport_club">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_sportClub)) {
        echo "<option><strong>Data Club Olahraga Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('sport_club')) || (set_value('sport_club') == "--- Pilih Club Olahraga ---") ?"<option>--- Pilih Club Olahraga ---</option>" : ''; 
        foreach ($data_sportClub as $sport) {
            if ( (isset($data_athlete) && $data_athlete->sport_club == $sport->id) || set_value('sport_club') == $sport->id) {
                echo "<option value='$sport->id' selected>$sport->name</option>";  
            }
            else {
                echo "<option value='$sport->id'>$sport->name</option>";
            }
                    
        }
    }
    ?>
    </select><br>
    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
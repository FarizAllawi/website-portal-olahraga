<form method="post">
    <label for="match_time">Menit</label>
    <input type="time" name="match_time" id="match_time" value="<?php echo set_value('match_time') ? set_value('match_time') : (isset($data_foul) ? date('H:i',strtotime($data_foul->minute)) : '') ; ?>"><br>

    <label for="foul_type">Tipe Pelanggaran</label>
    <select name="foul_type">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_foulType)) {
        echo "<option><strong>Data Tipe Pelanggaran Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('foul_type')) || (set_value('foul_type') == "--- Pilih Tipe Pelanggaran ---") ?"<option>--- Pilih Tipe Pelanggaran ---</option>" : ''; 
        foreach ($data_foulType as $foulType) {
            if ( (isset($data_foul) && $data_foul->foul_type == $foulType->id) || set_value('foul_type') == $foulType->id) {
                echo "<option value='$foulType->id' selected>$foulType->foul_name</option>";  
            }
            else {
                echo "<option value='$foulType->id'>$foulType->foul_name</option>";
            }
                    
        }
    }
    ?>
    </select><br>

    <label for="match">Pertandingan</label>
    <select name="match">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_match)) {
        echo "<option><strong>Data Club Olahraga Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('match')) || (set_value('match') == "--- Pilih Pertandingan ---") ?"<option>--- Pilih Pertandingan ---</option>" : ''; 
        foreach ($data_match as $match) {
            if ( (isset($data_foul) && $data_foul->match_id == $match->id) || set_value('match') == $match->id) {
                echo "<option value='$match->id' selected>$match->match_date | $match->club_1 - $match->club_2</option>";  
            }
            else {
                echo "<option value='$match->id'>".date('Y-m-d',strtotime($match->match_date))." | $match->club_1 - $match->club_2</option>";
            }
    
        }
    }
    ?>
    </select><br>

    <label for="player">Pemain</label>
    <select name="player">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_player)) {
        echo "<option><strong>Data Pemain Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('')) || (set_value('sport_club') == "--- Pilih Pemain ---") ?"<option>--- Pilih Pemain ---</option>" : ''; 
        foreach ($data_player as $player) {
            if ( (isset($data_foul) && $data_foul->athlete_id == $player->id) || set_value('player') == $player->id) {
                echo "<option value='$player->id' selected>$player->name</option>";  
            }
            else {
                echo "<option value='$player->id'>$player->name</option>";
            }
                    
        }
    }
    ?>
    </select><br>
    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
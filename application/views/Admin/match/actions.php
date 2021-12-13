<form method="post">
    <label for="sport_club_1">Select Sport Club 1</label>
    <select name="sport_club_1">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_sportClub)) {
        echo "<option><strong>Data Club Olahraga Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('sport_club_1')) || (set_value('sport_club_1') == "--- Pilih Tipe Olahraga ---") ?"<option>--- Pilih Tipe Olahraga ---</option>" : ''; 
        foreach ($data_sportClub as $sport) {
            if ( (isset($data_match) && $data_match->sport_club_1 == $sport->id) || set_value('sport_club_1') == $sport->id) {
                echo "<option value='$sport->id' selected>$sport->name</option>";  
            }
            else {
                echo "<option value='$sport->id'>$sport->name</option>";
            }
                    
        }
    }
    ?>
    </select><br>

    <label for="sport_club_1">Select Sport Club 2</label>
    <select name="sport_club_2">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_sportClub)) {
        echo "<option><strong>Data Club Olahraga Kosong !!!</strong></option>";
    }
    else {
        echo empty(set_value('sport_club_2')) || (set_value('sport_club_2') == "--- Pilih Tipe Olahraga ---") ?"<option>--- Pilih Tipe Olahraga ---</option>" : ''; 
        foreach ($data_sportClub as $sport) {
            if ( (isset($data_match) && $data_match->sport_club_2 == $sport->id) || set_value('sport_club_2') == $sport->id) {
                echo "<option value='$sport->id' selected>$sport->name</option>";  
            }
            else {
                echo "<option value='$sport->id'>$sport->name</option>";
            }
                    
        }
    }
    ?>
    </select><br>
    <?php 
        $id = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : 
    ?>
    <label for="club_1_score">club 1 score</label>
    <input type="text" name="club_1_score" id="club_1_score" value="<?php echo empty($id) ?  0 : (set_value('club_1_score') ? set_value('club_1_score') : (isset($data_match) ? $data_match->club_1_score : '')) ; ?>" <?php echo empty($id) ? "disabled" : ''?>><br>

    <label for="club_1_score">club 2 score</label>
    <input type="text" name="club_1_score" id="club_1_score" value="<?php echo empty($id) ?  0 : (set_value('club_2_score') ? set_value('club_2_score') : (isset($data_match) ? $data_match->club_2_score : '')) ; ?>" <?php echo empty($id) ? "disabled" : ''?>><br>

    <?php 
        $date = null;
        $time = null;
        if (isset($data_match)) {
            $date = date('Y-m-d', strtotime($data_match->match_date));
            $time = date('H:i', strtotime($data_match->match_date));
        }
    ?>
    <label for="match_date">Date</label>
    <input type="date" name="match_date" id="match_date" value="<?php echo set_value('match_date') ? set_value('match_date') : (isset($data_match) ? $date : '') ; ?>">
    <label for="match_time">Time</label>
    <input type="time" name="match_time" id="match_time" value="<?php echo set_value('match_time') ? set_value('match_time') : (isset($data_match) ? $time : '') ; ?>"><br>
    
    <label for="match_status">Match Status</label>
    <select name="match_status" id="match_status">

    <?php 
        $role = ['draft', 'published'];
        foreach($role as $data){
            if ($data === set_value('role') || $data ===  $data_match->match_status)
            {
                echo "<option value='$data' selected>$data</option>";
            }
            else {

                echo "<option value='$data'>$data</option>";
            }
        }
    ?>
    </select>
    <br>
    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
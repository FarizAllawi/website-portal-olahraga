<form class="modal-content" method="post">
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit Foul</h5>
    </div>
    <div class="modal-body">
    <div class="mb-3">
        <label class="form-label" for="first-match_time">Menit</label>
        <input type="time" class="form-control"  name="match_time" id="match_time" value="<?php echo set_value('match_time') ? set_value('match_time') : (isset($data_foul) ? date('H:i',strtotime($data_foul->minute)) : '') ; ?>">
        <span class="alert-danger"><?php echo form_error('match_time'); ?></span>
    </div>
    <div class="mb-3">
        <label for="foul_type">Tipe Pelanggaran</label>
        <select name="foul_type" class="form-control"> 
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
        </select>
        <span class="alert-danger"><?php echo form_error('foul_type'); ?></span>

    </div>

    <div class="mb-3">
        <label for="match">Pertandingan</label>
        <select name="match" class="form-control">
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
        </select>
        <span class="alert-danger"><?php echo form_error('match'); ?></span>

    </div>

    <div class="mb-3">
        <label for="player">Pemain</label>
        <select name="player" class="form-control">
        <?php
        if (empty($data_player)) {
            echo "<option><strong>Data Pemain Kosong !!!</strong></option>";
        }
        else {
            echo empty(set_value('player')) || (set_value('player') == "--- Pilih Pemain ---") ?"<option>--- Pilih Pemain ---</option>" : ''; 
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
        </select>
        <span class="alert-danger"><?php echo form_error('player'); ?></span>
    </div>
    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/user')?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

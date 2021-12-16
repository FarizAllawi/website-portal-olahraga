<form class="modal-content" method="post">
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit Match</h5>
    </div>
    <div class="modal-body">
    <div class="row">
    <?php 
        $id = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : '';
    ?>
    <div class="mb-3 col-md-6">
            <label for="sport_club_1">Club 1</label>
            <select class="form-control" name="sport_club_1" id="sport_club_1" <?php echo !empty($id) ? "disabled" : ''?>>
            <?php
                // var_dump($data_sportType);die;
                if (empty($data_sportClub)) {
                    echo "<option><strong>Data Club Olahraga Kosong !!!</strong></option>";
                }
                else {
                    echo empty(set_value('sport_club_1')) || (set_value('sport_club_1') == "--- Pilih Club Olahraga ---") ?"<option>--- Pilih Club Olahraga ---</option>" : ''; 
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
            <span class="alert-danger"><?php echo form_error('sport_club_1'); ?></span>
            </select>
        </div>
        <div class="mb-3 col-md-6">
        <label for="sport_club_2">Club 1</label>
            <select class="form-control" name="sport_club_2" id="sport_club_2" <?php echo !empty($id) ? "disabled" : ''?>>
            <?php
                // var_dump($data_sportType);die;
                if (empty($data_sportClub)) {
                    echo "<option><strong>Data Club Olahraga Kosong !!!</strong></option>";
                }
                else {
                    echo empty(set_value('sport_club_2')) || (set_value('sport_club_2') == "--- Pilih Club Olahraga ---") ?"<option>--- Pilih Club Olahraga ---</option>" : ''; 
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
            <span class="alert-danger"><?php echo form_error('sport_club_2'); ?></span>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
        <label class="form-label" for="club_1_score">Score Club 1</label>
            <input type="text" class="form-control" name="club_1_score" id="club_1_score" value="<?php echo empty($id) ?  0 : (set_value('club_1_score') ? set_value('club_1_score') : (isset($data_match) ? $data_match->club_1_score : '')) ; ?>" <?php echo empty($id) ? "disabled" : ''?>>
            <span class="alert-danger"><?php echo form_error('club_1_score'); ?></span>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="club_2_score">Score Club 2</label>
            <input type="text" class="form-control" name="club_2_score" id="club_2_score" value="<?php echo empty($id) ?  0 : (set_value('club_2_score') ? set_value('club_2_score') : (isset($data_match) ? $data_match->club_2_score : '')) ; ?>" <?php echo empty($id) ? "disabled" : ''?>>
            <span class="alert-danger"><?php echo form_error('club_2_score'); ?></span>
        </div>
    </div>

    <?php 
        $date = null;
        $time = null;
        if (isset($data_match)) {
            $date = date('Y-m-d', strtotime($data_match->match_date));
            $time = date('H:i', strtotime($data_match->match_date));
        }
    ?>

    <div class="row">
        <div class="mb-3 col-md-6">
        <label class="form-label" for="match_date">Date</label>
            <input type="date" class="form-control" name="match_date" id="match_date" value="<?php echo set_value('match_date') ? set_value('match_date') : (isset($data_match) ? $date : '') ; ?>">
            <span class="alert-danger"><?php echo form_error('match_date'); ?></span>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="match_time">Time</label>
            <input type="time" class="form-control" name="match_time" id="match_time" value="<?php echo set_value('match_time') ? set_value('match_time') : (isset($data_match) ? $time : '') ; ?>">
            <span class="alert-danger"><?php echo form_error('match_time'); ?></span>
        </div>
    </div>

    <div class="mb-3">
        <label for="match_status">Match Status</label>
        <select class="form-control" name="match_status" id="match_status">
        <?php 
            $role = ['draft', 'published'];
            echo empty(set_value('role')) || (set_value('role') == "--- Pilih Match Status ---") ?"<option>--- Pilih Match Status ---</option>" : ''; 
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
        <span class="alert-danger"><?php echo form_error('match_status'); ?></span>
        </select>
    </div>




    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/match/league/'.$this->uri->segment(4))?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

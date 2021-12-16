<?php 
    $id_club = $this->uri->segment(4);
    $id_athlete = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : null;
    echo form_open_multipart("admin/athlete/action/$id_club/$id_athlete" , array("class"=>"modal-content"));

?>

<div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit Athlete</h5>
    </div>
    <div class="modal-body">
    <div class="mb-3">
        <label class="form-label" for="photo">Photo</label>
            
            <input type="file" class="form-control" id="photo" name="photo"  >
            <?php 
            if (!empty($id_athlete)) {
            ?>
                <img src="<?php echo isset($data_athlete) ? $data_athlete->photo : ''; ?>" width="150" height="150"alt="">
                <?php echo $data_athlete->photo;?>
                <input type='hidden' name='photo-lama' value="<?php echo $data_athlete->photo?>">
                <span class="alert-danger"><?php echo form_error('photo-lama'); ?></span>
            <?php
            }
            ?>
            <span class="alert-danger"><?php echo form_error('photo'); ?></span>
    </div>
   
    <div class="mb-3">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name') ? set_value('name') : (isset($data_athlete) ? $data_athlete->name : ''); ?>">
        <span class="alert-danger"><?php echo form_error('name'); ?></span>
    </div>
    <div class="mb-3">
        <label class="form-label" for="backNumber">Back Number</label>
        <input type="text" class="form-control" name="backNumber" id="backNumber" value="<?php echo set_value('backNumber') ? set_value('backNumber') : (isset($data_athlete) ? $data_athlete->backNumber : ''); ?>">
        <span class="alert-danger"><?php echo form_error('backNumber'); ?></span>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
        <label class="form-label" for="username">Height</label>
        <input type="text" class="form-control" name="height" id="height" value="<?php echo set_value('height') ? set_value('height') : (isset($data_athlete) ? $data_athlete->height : ''); ?>">
        <span class="alert-danger"><?php echo form_error('height'); ?></span>
        </div>
        <div class="mb-3 col-md-6">
        <label class="form-label" for="weight">Weight</label>
        <input type="text" class="form-control" name="weight" id="weight" value="<?php echo set_value('weight') ? set_value('weight') : (isset($data_athlete) ? $data_athlete->weight : ''); ?>">
        <span class="alert-danger"><?php echo form_error('weight'); ?></span>    
    </div>
    <div class="mb-3">
        <label class="form-label" for="backNumber">Date Birth</label>
        <input type="date" class="form-control"name="date_birth" id="date_birth" value="<?php echo set_value('date_birth') ? set_value('date_birth') : (isset($data_athlete) ? $data_athlete->date_birth : ''); ?>">
        <span class="alert-danger"><?php echo form_error('backNumber'); ?></span>
    </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="gender">Gender</label>
        <input type="hidden" name="gender-lama" value="<?php echo !empty($data_athlete)  ? $data_athlete->gender : ''?>">
        <div class="form-check">
            <label class="form-label form-check-label">
            <input type="checkbox" name="gender" id="gender" value="male" class="form-check-input"<?php echo set_value('gender') === "male" ? 'checked' : ( !empty($data_athlete) && $data_athlete->gender  === 'male' ? 'checked disabled' : '') ; ?>> Male </label>
        </div>
        <div class="form-check">
            <label class="form-label form-check-label">
            <input type="checkbox" name="gender" id="gender" value="female" class="form-check-input" <?php echo set_value('gender') === "female" ? 'checked' : ( !empty($data_athlete)  && $data_athlete->gender === 'female' ? 'checked disabled' : '') ; ?> <?php isset($data_user->gender) && $data_user->gender  === 'female' ? 'disabled' : '' ; ?>>Female </label>
        </div>
        <span class="alert-danger"><?php echo form_error('gender'); ?></span>
        <span class="alert-danger"><?php echo form_error('gender-lama'); ?></span>
    </div>
    <div class="mb-3">
        <label for="player_type">Player Type</label>
        <select name="player_type" class="form-control">
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
        </select>
        <span class="alert-danger"><?php echo form_error('player_type'); ?></span>
    </div>

    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/athlete/club/'.$this->uri->segment(4))?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<?php
$id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : null;

echo form_open_multipart('admin/sport-club/action/' . $id); ?>
<label for="name_league">Nama Club</label>
<input type="text" name="name" id="name" value="<?php echo set_value('name') ? set_value('name') : (isset($data_sportClub) ? $data_sportClub->name : ''); ?>"><br>

<label for="name_league">Negara</label>
<input type="text" name="country" id="country" value="<?php echo set_value('country') ? set_value('country') : (isset($data_sportClub) ? $data_sportClub->country : ''); ?>"><br>

<label for="avatar">Logo</label>
<input type="file" name="logo" id="logo-baru">
<?php 
    if (!empty($id)) {
?>
        <input type='hidden' name='logo-lama' value="<?php echo $data_sportClub->logo?>">
<?php
    }
?>

<label for="sport_type">Liga</label>
<select name="liga">
    <?php
    // var_dump($data_sportType);die;
    if (empty($data_league)) {
        echo "<option><strong>Data Liga Kosong !!!</strong></option>";
    } else {
        echo empty(set_value('liga')) || (set_value('liga') == "--- Pilih Liga ---") ? "<option>--- Pilih Liga ---</option>" : '';
        foreach ($data_league as $league) {
            if ((isset($data_sportClub) && $league->id == $data_sportClub->sport_league) || set_value('liga') == $data_sportClub->sport_league) {
                echo "<option value='$league->id' selected>$league->name_league</option>";
            } else {
                echo "<option value='$league->id'>$league->name_league</option>";
            }
        }
    }
    ?>
</select>
<button type="submit">submit</button> <br>

<?php 
    echo validation_errors() ;
    echo !empty($error) ? $error : null;
?>
</form>
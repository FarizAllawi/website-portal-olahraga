<form method="post">
    <label for="player_type">Tipe Nama</label>
    <input type="text" name="player_type" id="player_type" value="<?php echo set_value('name_type') ? set_value('name_type') : (isset($data_playerType) ? $data_playerType->player_type : '') ; ?>"><br>
    <label for="sport_type">Tipe Olahraga</label>
    <select name="sport_type">
        <?php
        // var_dump($data_foulType);die;
        if (empty($data_sportType)) {
            echo "<option><strong>Data Tipe Olahraga Kosong !!!</strong></option>";
        } else {
            echo empty(set_value('sport_type')) || (set_value('sport_type') == "--- Pilih Tipe Olahraga ---") ? "<option>--- Pilih Tipe Olahraga ---</option>" : '';
            foreach ($data_sportType as $sport) {
                if (isset($data_playerType) || $sport->id && $sport->id == $data_playerType->sport_type) {
                    echo "<option value='$sport->id' selected>$sport->name_type</option>";
                } else {
                    echo "<option value='$sport->id'>$sport->name_type</option>";
                }
            }
        }
        ?>
    </select>
    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
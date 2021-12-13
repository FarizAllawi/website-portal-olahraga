<form method="post">
    <label for="foul_name">Tipe Nama</label>
    <input type="text" name="foul_name" id="foul_name" value="<?php echo set_value('foul_name') ? set_value('foul_name') : (isset($data_foulType) ? $data_foulType->foul_name : '') ; ?>"><br>
    <label for="sport_type">Tipe Olahraga</label>
    <select name="sport_type">
        <?php
        // var_dump($data_sportType);die;
        if (empty($data_sportType)) {
            echo "<option><strong>Data Tipe Olahraga Kosong !!!</strong></option>";
        } else {
            echo empty(set_value('sport_type')) || (set_value('sport_type') == "--- Pilih Tipe Olahraga ---") ? "<option>--- Pilih Tipe Olahraga ---</option>" : '';
            foreach ($data_sportType as $sport) {
                if (isset($data_foulType) || set_value('sport_type') && $sport->id == $data_foulType->sport_type) {
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
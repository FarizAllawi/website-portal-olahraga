<form method="post">
    <label for="type_name">Tipe Nama</label>
    <input type="text" name="name_type" id="name_type" value="<?php echo set_value('name_type') ? set_value('name_type') : (isset($data_sportType) ? $data_sportType->name_type : '') ; ?>"><br>

    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
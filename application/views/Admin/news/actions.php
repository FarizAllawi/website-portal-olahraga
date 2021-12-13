<?php 
    $id_sportType = $this->uri->segment(4);
    $id_news = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : null;
    echo form_open_multipart("admin/news/action/$id_sportType/$id_news");

?>

    <label for="thumbnail-baru">Thumbnail</label>
    <input type="file" name="thumbnail" id="thumbnail-baru">
    <?php 
    if (!empty($id_athlete)) {
    ?>
            <input type='hidden' name='thumbnail-lama' value="<?php echo $data_news->thumbnail?>">
    <?php
        }
    ?>
    <br>

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo set_value('title') ? set_value('title') : (isset($data_news) ? $data_news->title : ''); ?>"><br>
    
    <label for="title">Description</label>
    <input type="text" name="description" id="description" value="<?php echo set_value('description') ? set_value('description') : (isset($data_news) ? $data_news->description : ''); ?>"><br>

    <label for="body">Body</label>
    <textarea name="body" id="body"><?php echo set_value('body') ? set_value('body') : (isset($data_news) ? $data_news->body : ''); ?></textarea><br>

    <label for="news_status">News Status</label>
    <select name="news_status" id="news_status">

    <?php 
        $role = ['draft', 'published'];
        foreach($role as $data){
            if ($data === set_value('news_status') || $data ===  $data_news->news_status)
            {
                echo "<option value='$data' selected>$data</option>";
            }
            else {

                echo "<option value='$data'>$data</option>";
            }
        }
    ?>
    </select>
    
    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
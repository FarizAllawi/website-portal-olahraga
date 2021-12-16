<?php
    $id = $this->uri->segment(5);
    $league_id = $this->uri->segment(4);
    $routes = "admin/news/action/".(!empty($id) ? $league_id."/".$id : $league_id);
    echo form_open_multipart($routes, array("class"=>"modal-content")); 
?>
<!-- <form class="modal-content" method="post"> -->
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit News</h5>
    </div>
    <div class="modal-body">
        <div class="mb-3>
            <label class="form-label" for="logo">Thumbnail</label>
            
            <input type="file" class="form-control" id="thumbnail" name="thumbnail"  >
            <?php 
            if (!empty($id)) {
            ?>
                <img src="<?php echo isset($data_news) ? $data_news->thumbnail : ''; ?>" width="150" height="150"alt="">
                <?php echo $data_news->thumbnail;?>
                <input type='hidden' name='thumbnail-lama' value="<?php echo $data_news->thumbnail?>">
                <span class="alert-danger"><?php echo form_error('thumbnail-lama'); ?></span>
            <?php
            }
            ?>
            <span class="alert-danger"><?php echo form_error('thumbnail'); ?></span>
        </div>
        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title') ? set_value('title') : (isset($data_news) ? $data_news->title : ''); ?>">
            <span class="alert-danger"><?php echo form_error('title'); ?></span>
        </div>
        <div class="mb-3">
            <label class="form-label" for="country">Description</label>
            <textarea class="form-control" name="description" id="description"><?php echo set_value('description') ? set_value('description') : (isset($data_news) ? $data_news->description : ''); ?></textarea>
            <span class="alert-danger"><?php echo form_error('description'); ?></span>
        </div>
        <div class="mb-3">
            <label class="form-label" for="country">Body</label>
            <textarea class="form-control" name="body" id="body"><?php echo set_value('body') ? set_value('body') : (isset($data_news) ? $data_news->body : ''); ?></textarea>
            <span class="alert-danger"><?php echo form_error('body'); ?></span>
        </div>

        <div class="mb-3">
            <label for="news_status">News Status</label>
            <select class="form-control" name="news_status" id="news_status">

            <?php 
                $role = ['draft', 'published'];
                echo empty(set_value('news_status')) ? "<option value='' selected>-- Pilih Status News --</option>" : "<option value='null'>-- Pilih Status News --</option>";
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
            <span class="alert-danger"><?php echo form_error('news_status'); ?></span>
        </div>
   
    </div>
    <div class="modal-footer">
    <button type="button" onclick="history.back()" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>


   
<form method="post">


    <label for="rating">Rating</label>
    <input type="hidden" name="rating-lama" value="<?php echo isset($data_review->rating) ? $data_review->rating : ''?>"> 
    <input type="checkbox" name="rating" id="rating" value="1" <?php echo set_value('rating') === "1" ? 'checked' : ( isset($data_review->rating) && $data_review->rating  === '1' ? 'checked disabled' : '') ; ?>>1
    <input type="checkbox" name="rating" id="rating" value="2" <?php echo set_value('rating') === "2" ? 'checked' : ( isset($data_review->rating)  && $data_review->rating === '2' ? 'checked disabled' : '') ; ?>>2 
    <input type="checkbox" name="rating" id="rating" value="3" <?php echo set_value('rating') === "3" ? 'checked' : ( isset($data_review->rating)  && $data_review->rating === '3' ? 'checked disabled' : '') ; ?>>3 
    <input type="checkbox" name="rating" id="rating" value="4" <?php echo set_value('rating') === "4" ? 'checked' : ( isset($data_review->rating)  && $data_review->rating === '4' ? 'checked disabled' : '') ; ?>>4 
    <input type="checkbox" name="rating" id="rating" value="5" <?php echo set_value('rating') === "5" ? 'checked' : ( isset($data_review->rating)  && $data_review->rating === '5' ? 'checked disabled' : '') ; ?>>5 


    <label for="comment">Comment</label>
    <textarea name="comment" id="body"><?php echo set_value('comment') ? set_value('comment') : (isset($data_review) ? $data_review->comment : ''); ?></textarea><br>

    <button type="submit">submit</button> <br>

    <?php echo validation_errors() ?>
</form>
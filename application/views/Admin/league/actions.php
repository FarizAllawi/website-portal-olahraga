<form class="modal-content" method="post">
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit League</h5>
    </div>
    <div class="modal-body">
    <div class="mb-3">
        <label class="form-label" for="name_league">Nama Liga</label>
        <input type="text" class="form-control" id="name_league" name="name_league" placeholder="Nama Liga" value="<?php echo set_value('name_league') ? set_value('name_league') : (isset($data_league) ? $data_league->name_league : '') ; ?>">
        <span class="alert-danger"><?php echo form_error('name_league'); ?></span>
    </div>

    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/league/'.$this->uri->segment(4))?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
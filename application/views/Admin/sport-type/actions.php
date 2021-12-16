<form class="modal-content" method="post">
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit Sport Type</h5>
    </div>
    <div class="modal-body">
    <div class="mb-3">
        <label class="form-label" for="name_type-name">Sport Type</label>
        <input type="text" class="form-control" id="name_type" name="name_type" placeholder="Sport Type Name" value="<?php echo set_value('name_type') ? set_value('name_type') : (isset($data_sportType) ? $data_sportType->name_type : '') ; ?>">
        <span class="alert-danger"><?php echo form_error('fullname'); ?></span>
    </div>
    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/sport-type')?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

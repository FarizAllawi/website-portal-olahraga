<form class="modal-content" method="post">
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit Foul Type</h5>
    </div>
    <div class="modal-body">
    <div class="mb-3">
        <label class="form-label" for="foul_name">Nama Pelanggaran</label>
        <input type="text" class="form-control" id="foul_name" name="foul_name" placeholder="Nama Pelanggaran" value="<?php echo set_value('foul_name') ? set_value('foul_name') : (isset($data_foulType) ? $data_foulType->foul_name : '') ; ?>">
        <span class="alert-danger"><?php echo form_error('foul_name'); ?></span>
    </div>

    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/foul-type/'.$this->uri->segment(4))?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
a
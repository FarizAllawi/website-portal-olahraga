<form class="modal-content" method="post">
    <div class="modal-header">
    <h5 class="modal-title" id="add-modal">Add/Edit Foul Type</h5>
    </div>
    <div class="modal-body">
    <div class="mb-3">
        <label class="form-label" for="player_type">Nama Tipe Pemain</label>
        <input type="text" class="form-control" id="player_type" name="player_type" placeholder="Nama Pelanggaran" value="<?php echo set_value('player_type') ? set_value('player_type') : (isset($data_playerType) ? $data_playerType->player_type : '') ; ?>">
        <span class="alert-danger"><?php echo form_error('player_type'); ?></span>
    </div>

    </div>
    <div class="modal-footer">
    <a href="<?php echo site_url('admin/foul-type/'.$this->uri->segment(4))?>" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

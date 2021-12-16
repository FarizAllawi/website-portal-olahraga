<div id="mainContent">
            <div class="container-fluid">
              <div class="row gap-20">
                <div class="col-md-4">
                  <div class="bdrs-3 ov-h bgc-white bd">
                    <div class="bgc-deep-purple-500 ta-c p-30">
                      <h1 class="fw-300 mB-5 lh-1 c-white"><?php echo date('l'); ?></h1>
                      <h3 class="c-white"><?php echo date('d F Y'); ?></h3>
                    </div>
                    <div class="pos-r">
                      <div class="m-0 p-0 mT-20 email-wrapper remain-height ov-h">
                        <div class="email-list h-100 layers">
                            <div class="layer w-100 fxg-1 scrollable pos-r">
                                <?php 
                                    foreach ($match_today as $match) {
                                        echo "<div class='email-list-item peers fxw-nw p-20 bdB bgcH-grey-100 cur-p'>
                                                    <div class='peer mR-10'>
                                                        <i class='fa fa-fw fa-clock-o c-blue-500'></i>
                                                    </div>
                                                    <div class='peer peer-greed ov-h'>
                                                        <span class='fw-600'>$match->club_1 vs $match->club_2 | ".date('H:i', strtotime($match->match_date))." | $match->match_status</span>
                                                        <div class='c-grey-600'>
                                                            <span class='c-grey-700'>$match->club_1_score - $match->club_2_score</span>
                                                        </div>
                                                    </div>
                                                </div>";
                                    }
                                ?>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                <div class="row gap-20">
                <div class="col-md-12">
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="row">
                      <div class="col-sm-6">
                        <h4 class="c-grey-900 mB-20">Match</h4>
                      </div>
                      <div class="col-sm-6">
                        <a href="<?php echo site_url('admin/match/action/'.$this->uri->segment(4))?>" class="btn cur-p btn-success btn-color float-end">Add Match</a>
                      </div>
                    </div>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Match</th>
                            <th>Score</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Match</th>
                            <th>Score</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php 
                         foreach($data_match as $match) {
                          echo "<tr>
                                <td>$match->club_1 vs $match->club_2</td>
                                <td>$match->club_1_score - $match->club_2_score</td>
                                <td>".date('d F Y', strtotime($match->match_date))."</td>
                                <td>$match->match_status</td>

                                <td>
                                  <a href='".site_url('admin/match/action/'.$this->uri->segment(4).'/'.$match->id)."' class='btn cur-p btn-warning m-3'>edit</a>
                                  <button type='button' class='btn cur-p btn-danger btn-color m-3' data-bs-toggle='modal' data-bs-target='#delete-modal$match->id'>Delete</button>
                                <div class='modal fade' id='delete-modal$match->id' tabindex='-1' aria-labelledby='delete-modal' aria-hidden='true' style='display:none'>
                                  <div class='modal-dialog modal-md modal-dialog-centered'>
                                    <div class='modal-content'>
                                      <div class='modal-header'>
                                        <h5 class='modal-title' id='add-modal'>Delete User</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                      </div>
                                      <div class='modal-body'>Yakin ingin menghapus club $match->club_1 vs $match->club_2</div>
                                      <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>cancel</button>
                                        <a href='".site_url('admin/match/delete/'.$match->id)."' class='btn btn-danger'>Confirm</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                </td>
                               </tr>
                              "; 
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
                </div>
              </div>
              <div class="modal fade" id="calendar-edit">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="bd p-15">
                      <h5 class="m-0">Add Event</h5>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label fw-500">Event title</label>
                          <input class="form-control bdc-grey-200">
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <label class="fw-500 form-label">Start</label>
                            <div class="timepicker-input input-icon mb-3">
                              <div class="input-group">
                                <div class="input-group-text bgc-white bd bdwR-0">
                                  <i class="ti-calendar"></i>
                                </div>
                                <input type="text" class="form-control bdc-grey-200 start-date" placeholder="Datepicker" data-provide="datepicker">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="fw-500 form-label">End</label>
                            <div class="timepicker-input input-icon mb-3">
                              <div class="input-group">
                                <div class="input-group-text bgc-white bd bdwR-0">
                                  <i class="ti-calendar"></i>
                                </div>
                                <input type="text" class="form-control bdc-grey-200 end-date" placeholder="Datepicker" data-provide="datepicker">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="fw-500 form-label">Event title</label>
                          <textarea class="form-control bdc-grey-200" rows="5"></textarea>
                        </div>
                        <div class="text-end">
                          <button class="btn btn-primary cur-p btn-color" data-dismiss="modal">Done</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
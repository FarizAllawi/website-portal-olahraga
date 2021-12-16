<div id="mainContent">
    
<h4 class="c-grey-900 mT-10 mB-30">Pilih Liga Athlete</h4>
<button type="button" onclick="history.back()" class="btn btn-info mB-20">Kembali</button>


    <div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item w-100">
        <div class="row gap-20">
        <!-- #Toatl Visits ==================== -->
        <?php
            foreach($data_club as $club) {
                echo "
                        <div class='col-md-3'>
                            <a href='".site_url('admin/athlete/club/'.$club->id)."'>
                                <div class='peers fxw-nw ai-c p-20 bdB bgc-white bgcH-grey-50 cur-p'>
                                    <div class='peer'>
                                        <img src='$club->logo' alt='' class='w-5r h-5r bdrs-50p'>
                                    </div>
                                    <div class='peer peer-greed pL-20'>
                                        <h2 class='mB-0 lh-1 fw-400'>$club->name</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    ";
            }
        ?>
        
    </div>
</div>
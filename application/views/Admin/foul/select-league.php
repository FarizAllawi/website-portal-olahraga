<div id="mainContent">
    
<h4 class="c-grey-900 mT-10 mB-30">Pilih Liga Foul</h4>
<a href="<?php echo site_url('admin/sport-club'); ?>" class="btn btn-info mB-20">Kembali</a>

    <div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item w-100">
        <div class="row gap-20">
        <!-- #Toatl Visits ==================== -->
        <?php
            foreach($data_league as $league) {
                echo "<a href='".site_url('admin/foul/league/'.$league->id)."' class='col-md-3'>
                        <div class='layers bd bgc-white p-20'>
                            <div class='layer w-100 mB-10'>
                            <h1 class='lh-1'>$league->name_league</h1>
                            </div>
                        </div>
                        </a>";
            }
        ?>
        </div>
    </div>
    </div>
</div>
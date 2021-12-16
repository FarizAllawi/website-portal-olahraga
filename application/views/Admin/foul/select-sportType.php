<div id="mainContent">
<h4 class="c-grey-900 mT-10 mB-30">Pilih Olahraga Foul</h4>
    <div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item w-100">
        <div class="row gap-20">
        <!-- #Toatl Visits ==================== -->
        <?php
            foreach($sport_type as $sport) {
                echo "<a href='".site_url('admin/foul/sport/'.$sport->id)."' class='col-md-3'>
                        <div class='layers bd bgc-white p-20'>
                            <div class='layer w-100 mB-10'>
                            <h1 class='lh-1'>$sport->name_type</h1>
                            </div>
                        </div>
                        </a>";
            }
        ?>
        </div>
    </div>
    </div>
</div>
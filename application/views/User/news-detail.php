<div class="hero">
    <h1 class="hero-caption"><?php echo $news->title; ?></h1>
</div>
</section>
<section id="contant" class="contant main-heading single-blog">
    <div class="row">
        <div class="container">
        <div class="col-md-9">
            <div class="feature-post">
                <div class="feature-img">
                    <img src="<?php echo $news->thumbnail; ?>" class="img-responsive" alt="#" />
                </div>
                <div class="feature-cont">
                    <div class="post-people">
                    <div class="left-profile">
                        <div class="post-info">
                            <img src="<?php echo site_url('template/userpage/'); ?>images/profile-img.png" alt="#" />
                            <span>
                                <h4>by <?php echo $news->fullname; ?></h4>
                                <h5>on May 27, 2018</h5>
                            </span>
                        </div>
                        <span class="share"></span>
                    </div>
                    </div>
                    <div class="post-heading">
                        <?php echo $news->body; ?>
                    </div>
                </div>
            </div>
            <div class="feature-contant">
            </div>
        </div>
        <div class="col-md-3">
            <?php
                foreach($lastest_news_result as $lastest_news) {
                    if ($lastest_news->id != $news->id) {
                        echo "<a href='".site_url('news/'.$lastest_news->news_slug)."'>
                                <div class='blog-sidebar'>
                                <div class='category-menu'>
                                    <ul>
                                    <li>
                                        <span><img src='$lastest_news->thumbnail' alt=''></span>
                                        <span>
                                            <p>$lastest_news->title</p>
                                            <p class='date'>".date('d M, Y', strtotime($lastest_news->created_at))."</p>
                                        </span>
                                    </li>
                                    </ul>
                                </div>
                            </div></a>";
                    } 
                }
            ?>
            <aside id="sidebar" class="left-bar">
                <div class="feature-matchs">
                    <div class="team-btw-match">
                    <h4 class="heading">Jadwal Pertandingan</h4>
                    <?php 
                        foreach($data_match as $match) {
                            echo "<a href='".site_url('league/'.$match->league.'/match')."'> 
                                    <ul>
                                    <li>
                                        <img src='$match->logo_club_1' alt='' width='100' height='100'>
                                        <span>$match->club_1</span>
                                    </li>
                                    <li class='vs'><span>vs</span></li>
                                    <li>
                                        <img src='$match->logo_club_2' alt='' width='100' height='100'>
                                        <span>$match->club_2</span>
                                    </li>
                                    
                                    </ul></a>";
                        }
                    ?>
                    </div>
                </div>
            </aside>
        </div>
        </div>
    </div>
</section>
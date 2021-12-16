<div class="hero">
<h1 class="hero-caption"><?php echo $data_sport->name_type; ?></h1>
</div>
<section id="contant" class="contant main-heading team">
<div class="container">
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-8 col-sm-8 col-xs-12">
            <div class="feature-post small-blog">
                <div class="col-md-5">
                    <div class="feature-img">
                        <img src="<?php echo $lastest_news->thumbnail;?>" class="img-responsive" alt="#" />
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="feature-cont">
                        <div class="post-info">
                        <span>
                            <h4><?php echo $lastest_news->fullname;?></h4>
                            <h5>on <?php echo date('M d, Y', strtotime($lastest_news->created_at));?></h5>
                        </span>
                        </div>
                        <div class="post-heading">
                        <h3><?php echo $lastest_news->title;?></h3>
                        <p><?php echo $lastest_news->description;?></p>
                        <div class="full">
                            <a class="btn" href="<?php echo site_url('news/'.$lastest_news->news_slug);?>">Read More</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-xs-12">
            <div class="news-post-holder">
                <div class="news-post-widget">
                    <img class="img-responsive" src="<?php echo $lastest_news_result[0]->thumbnail?>" alt="">
                    <div class="news-post-detail">
                        <h2><a href="<?php echo site_url('news/'.$lastest_news_result[0]->news_slug);?>"><?php echo $lastest_news_result[0]->title; ?></h2>
                        <span class="date"><?php echo date('d M Y', strtotime($lastest_news_result[0]->created_at)); ?></span>
                        <p><?php echo $lastest_news_result[0]->description; ?></p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <div class="row">
        <?php 
            $lastest_news_id = [];
            for($i = 1; $i < count($lastest_news_result); $i++)
            {
                if ($lastest_news_result[$i]->id != $lastest_news->id)
                {
                    echo "
                    <div class='col-lg-4 col-sm-4 col-xs-12'>
                    <div class='news-post-holder'>
                    <div class='news-post-widget'>
                        <img class='img-responsive' src='".$lastest_news_result[$i]->thumbnail."' alt=''>
                        <div class='news-post-detail'>
                            <h2><a href='".site_url('news/'.$lastest_news_result[$i]->news_slug)."'>".$lastest_news_result[$i]->title."</a></h2>
                            <span class='date'>".date('d M Y', strtotime($lastest_news_result[$i]->created_at))."</span>
                            <p>".$lastest_news_result[$i]->description."</p>
                        </div>
                    </div>
                    </div>
                </div>
                
                ";
                }
                array_push($lastest_news_id, $lastest_news_result[$i]->id);

            }
        ?>
        </div>
    </div>
</div>
</div>

<?php 
foreach($data_league as $league){
    echo "<div class='container'>
            <h2><a href=".site_url('league/'.str_replace(' ', '-', strtolower($league->name_league))).">$league->name_league</a></h2>
            <div class='row'>";
    $index = 0;
    foreach($data_news["$league->name_league"] as $news) {
        $index++;
        if (!in_array($news->id,$lastest_news_id))
        {
            if($news->id != $lastest_news_result[0]->id) {
?>      
                <div class="col-lg-4 col-sm-4 col-xs-12">
                <div class="news-post-holder">
                    <div class="news-post-widget">
                        <img class="img-responsive" src="<?php echo $news->thumbnail; ?>" alt="">
                        <div class="news-post-detail">
                        <h2><a href="<?php echo site_url('news/'.$news->news_slug); ?>"><?php echo $news->title; ?></a></h2>
                        <span class="date"><?php date('d M Y', strtotime($news->created_at))?></span>
                        <p><?php echo $news->description; ?></p>
                        </div>
                    </div>
                </div>
            </div>    
<?php
            }
        }
    }
    echo "  </div>
            </div>";

}


?>
</section>
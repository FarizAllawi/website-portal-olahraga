<div class="hero">
        <h1 class="hero-caption"><?php echo $data_league->name_league; ?></h1>
    </div>
</section>
<div class="matchs-info">
         <div class="container">
            <div class="col-md-6 col-sm-6 col-xs-12">
               <a href="<?php echo site_url('/league/'.$this->uri->segment(2));?>" class="btn btn-xl btn-info news-button">Berita</a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <a href="<?php echo site_url('/league/'.$this->uri->segment(2).'/match');?>" class="btn btn-xl btn-info match-button">Pertandingan</a>
            </div>
         </div>
      </div>
      <section id="contant" class="contant">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-sm-4 col-xs-12">
                  <aside id="sidebar" class="left-bar">
                     <div class="feature-matchs">
                        <div class="team-btw-match">
                            <?php 
                                foreach($data_match as $match) {
                                    echo "<ul>
                                            <li>
                                                <img src='$match->logo_club_1' alt='' width='100' height='100'>
                                                <span>$match->club_1</span>
                                            </li>
                                            <li class='vs'><span>vs</span></li>
                                            <li>
                                                <img src='$match->logo_club_2' alt='' width='100' height='100'>
                                                <span>$match->club_2</span>
                                            </li>
                                            </ul>";
                                }
                            ?>
                        </div>
                     </div>
                  </aside>
               </div>
               <div class="col-lg-8 col-sm-8 col-xs-12">
                   <?php foreach($data_news as $news) {?>
                  <div class="feature-post small-blog">
                     <div class="col-md-5">
                        <div class="feature-img">
                           <img src="<?php echo $news->thumbnail; ?>" class="img-responsive" alt="#" />
                        </div>
                     </div>
                     <div class="col-md-7">
                        <div class="feature-cont">
                           <div class="post-info">
                              <span>
                                 <h4>by <?php echo $news->fullname; ?></h4>
                                 <h5>on <?php echo date('M d, Y', strtotime($news->created_at));?></h5>
                              </span>
                           </div>
                           <div class="post-heading">
                              <h3><?php echo $news->title; ?></h3>
                              <p><?php echo $news->description; ?></p>
                              <div class="full">
                                 <a class="btn" href="<?php echo site_url('news/'.$news->news_slug); ?>">Read More</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php }; ?>
               </div>
            </div>
         </div>
      </section>
      <div class="team-holder theme-padding">
         <div class="container">
            <div class="main-heading-holder">
               <div class="main-heading sytle-2">
                  <h2>Club <?php echo $data_league->name_league; ?></h2>
               </div>
            </div>
            <div id="team-slider">
               <div class="container">
                  <div class="team-btw-match">
                     <ul>
                         <?php foreach($data_sportClub as $club) {
                             echo "<li>
                                        <img src='$club->logo' alt='' width='100' height='100'>
                                        <span>$club->name</span>
                                    </li>"; 
                         }
                         ?>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
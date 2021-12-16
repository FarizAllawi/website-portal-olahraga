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
      <div class="container">
          <div class="col-lg-9 col-md-9">
            <div class="team-holder theme-padding">
                <div class="main-heading-holder">
                    <div class="main-heading sytle-2">
                       <h2>Jadwal Pertandingan</h2>
                    </div>
                 </div>
                 <div id="team-slider">
                    <div class="team-btw-match">
                        <?php foreach($data_match as $match) { 
                        ?>
                            <div class="row">
                            <div class="col-md-4">
                                <?php echo date('d M Y - H:i', strtotime($match->match_date)); ?>
                            </div>
                            <div class="col-md-8">
                                <ul>
                                    <li>
                                       <img src="<?php echo $match->logo_club_1; ?>" alt="" width="100" height="100">
                                       <span><?php echo $match->club_1; ?></span>
                                    </li>
                                    <li class="vs"><span>vs</span></li>
                                    <li>
                                       <img src="<?php echo $match->logo_club_2; ?>" alt="" width="100" height="100">
                                       <span><?php echo $match->club_1; ?></span>
                                    </li>
                                 </ul>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                     </div>
                     <div class="main-heading-holder">
                        <div class="main-heading sytle-2">
                           <h2>Jadwal Pertandingan</h2>
                        </div>
                     </div>
                 </div>
             </div>
          </div>
          <div class="col-md-3">
              <?php
                foreach($lastest_news_result as $lastest_news) {
                        echo "<a href='".site_url('news/'.$lastest_news->news_slug)."'>
                                <div class='blog-sidebar'>
                                <div class='category-menu'>
                                    <ul>
                                    <li>
                                        <span><img src='$lastest_news->thumbnail' alt='' width='210' height='210'></span>
                                        <span>
                                            <p>$lastest_news->title</p>
                                            <p class='date'>".date('d M, Y', strtotime($lastest_news->created_at))."</p>
                                        </span>
                                    </li>
                                    </ul>
                                </div>
                            </div></a>";
                }
            ?>
            <div class="blog-sidebar">
               <h4 class="heading">Popular News</h4>
               <div class="category-menu">
                  <ul>
                     <li>
                        <span><img src="images/profile-img2.png" alt="#"></span>
                        <span>
                           <p>Two touch penalties, imaginary cards</p>
                           <p class="date">22 Feb, 2016</p>
                        </span>
                     </li>
                  </ul>
               </div>
            </div>
            <aside id="sidebar" class="left-bar">
               <div class="feature-matchs">
                  <div class="team-btw-match">
                     <ul>
                        <li>
                           <img src="images/img-01_002.png" alt="">
                           <span>Portugal</span>
                        </li>
                        <li class="vs"><span>vs</span></li>
                        <li>
                           <img src="images/img-02.png" alt="">
                           <span>Germany</span>
                        </li>
                     </ul>
                     <ul>
                        <li>
                           <img src="images/img-03_002.png" alt="">
                           <span>Portugal</span>
                        </li>
                        <li class="vs"><span>vs</span></li>
                        <li>
                           <img src="images/img-04_003.png" alt="">
                           <span>Germany</span>
                        </li>
                     </ul>
                     <ul>
                        <li>
                           <img src="images/img-05_002.png" alt="">
                           <span>Portugal</span>
                        </li>
                        <li class="vs"><span>vs</span></li>
                        <li>
                           <img src="images/img-06.png" alt="">
                           <span>Germany</span>
                        </li>
                     </ul>
                     <ul>
                        <li>
                           <img src="images/img-07_002.png" alt="">
                           <span>Portugal</span>
                        </li>
                        <li class="vs"><span>vs</span></li>
                        <li>
                           <img src="images/img-08.png" alt="">
                           <span>Germany</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </aside>
            <aside id="sidebar" class="left-bar">
               <div class="feature-matchs">
                  <table class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Team</th>
                           <th>P</th>
                           <th>W</th>
                           <th>L</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td><img src="images/img-01_004.png" alt="">Liverpool</td>
                           <td>10</td>
                           <td>12</td>
                           <td>20</td>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td><img src="images/img-02_002.png" alt="">Chelsea</td>
                           <td>10</td>
                           <td>12</td>
                           <td>20</td>
                        </tr>
                        <tr>
                           <td>3</td>
                           <td><img src="images/img-03_003.png" alt="">Norwich City</td>
                           <td>20</td>
                           <td>15</td>
                           <td>20</td>
                        </tr>
                        <tr>
                           <td>4</td>
                           <td><img src="images/img-04_002.png" alt="">West Brom</td>
                           <td>60</td>
                           <td>10</td>
                           <td>60</td>
                        </tr>
                        <tr>
                           <td>5</td>
                           <td><img src="images/img-05.png" alt="">sunderland</td>
                           <td>30</td>
                           <td>06</td>
                           <td>30</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </aside>
         </div>
      </div>
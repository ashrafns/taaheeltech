<?php 
include('header.php'); 
?>

    <!--====== APPIE PAGE TITLE PART ENDS ======-->

        <!-- Blog Start -->
        <section class="blogpage-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="row">

                        <?php 
                        if(isset($_GET['article_search']) && !empty($_GET['article_search'])) 
                            {
                                $article_search = input_secure($_GET['article_search']);
                                $read = mysqli_query($conn,"SELECT * FROM articales  WHERE pvalid='1' AND article_name LIKE '%". $article_search ."%' ORDER BY ID DESC");
                            } else {
                                $read = mysqli_query($conn,"SELECT * FROM articales WHERE pvalid='1' ORDER BY ID DESC");
                            }

                            while ($row=mysqli_fetch_array($read)) 
                            {
                            ?>

                            <div class="col-lg-6">
                                <div class="post-item-1">
                                    <img src="<?php echo 'admin/'. $row['articale_img']; ?>" alt="" style=" height:250px;"> 
                                    <div class="b-post-details">
                                        <h3><a href="single-news.html"><?php echo $row['articale_name']; ?></a></h3>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="blog-sidebar">
                            <aside class="widget widget-search">
                                <form class="search-form" action="" method="get">
                                    <input type="search" name="article_search" id="article_search" placeholder="Search...">
                                    <button type="submit"><i class="fal fa-search"></i></button>
                                </form>
                            </aside>
                            <aside class="widget widget-categories">
                                <h3 class="widget-title">Categories</h3>
                                <ul>
                                    <?php 
                                    $category_read = mysqli_query($conn,"SELECT * FROM category WHERE pvalid='1' ORDER BY ID DESC");
                                    while ($category_row=mysqli_fetch_array($category_read)) {
                                    ?>
                                    <li><a href="#"><?php echo $category_row['cat_name']; ?> </a><span>(24)</span></li>
                                    <?php } ?>
                                </ul>
                            </aside>
                            <aside class="widget widget-trend-post">
                                <h3 class="widget-title">Popular Posts</h3>

                                <div class="popular-post">
                                    <a href="single-post.html"><img src="assets/images/blog/p1.jpg" alt=""></a>
                                    <h5><a href="single-post.html">Using creative problem Solving</a></h5>
                                    <span>March 10, 2020</span>
                                </div>
                                
                            </aside>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog End -->

    

<?php include('footer.php'); ?>
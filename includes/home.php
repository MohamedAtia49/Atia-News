<div class="col-md-8">

                <h1 class="page-header">
                    <?=$title?>
                    <small><?=$page?></small>
                </h1>

                <?php 
                    $postsSql = 'SELECT * FROM `posts` ';
                    $allPosts = mysqli_query($con , $postsSql);

                    while($row = mysqli_fetch_assoc($allPosts)):
                        $post_id = $row['post_id'];
                        $cat_id = $row['cat_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content']; 
                    ?>                    
                            <h2>
                            <a href="post.php?p_id=<?=$post_id?>"><?=$post_title?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?=$post_author?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post_date?></p>
                            <hr>
                            <div class="text-center">
                                <img src="images/<?=$post_image?>" alt="">
                            </div>
                            <hr>
                            <p><?=substr($post_content , 0 , 100)?>.....</p>
                            <a class="btn btn-primary" href="post.php?p_id=<?=$post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <?php endwhile; ?>

                <!-- First Blog Post -->
                

                <hr>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>
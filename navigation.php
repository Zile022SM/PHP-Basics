<nav id="nav">
                <a href="/index.php">Homepage</a>
                <a href="/news.php">All news</a>
                <a href="form.php">Contact Form</a>

                <?php 
                 include_once './pagesContent.php';

                 //var_dump($pages);
                 if(count($pages) > 0){
                    foreach ($pages as $key => $value) {
                        ?>
                            <a href='/page.php?id=<?php echo $value['id']; ?>'><?php echo $value['title']; ?></a>
                        <?php
                     }
                 }
                
                ?>
</nav>
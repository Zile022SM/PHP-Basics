<?php

  $currentPage = null;
  if(isset($_GET['id'])) {
     include_once './pagesContent.php';

     foreach($pages as $page){
        if($page['id'] == $_GET['id']){
          $currentPage = $page;
        }
     }
      
     //var_dump($currentPage);
  }else{
    echo "Nema id";
  }

?>

<!DOCTYPE html>
<html>
    <?php
        $pageTitle = $currentPage['title'];
        require_once './head.php';
    ?>
    <body>
        <div id="wrapper">
            <?php
                include_once './header.php';
            ?>
            <?php
                include_once './navigation.php';
            ?>
            <main id="content">
                
                <h1><?php echo $pageTitle ?></h1>
                <?php echo $currentPage['content']; ?>
            </main>
            <?php
                include_once './footer.php';
            ?>
        </div>
    </body>
</html>


<?php
   
   $serijalizovaneVesti = file_get_contents(__DIR__ . '/data/listaVesti.txt'); 
   $vesti = unserialize($serijalizovaneVesti);

   $categories = array();

   if(count($vesti) > 0){
        foreach($vesti as $key => $value){
            $categories[$value['category_id']] = $value['category'];
        }
   }

?>

<nav id="nav">
               
                <a href="/index.php">Homepage</a>
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
                

                if(count($categories) > 0){
                    foreach ($categories as $key => $value) {
                        ?>
                            <a href='/news_by_category.php?category_id=<?php echo $key; ?>'><?php echo $value; ?></a>
                        <?php
                     }
                }
                ?>
</nav>
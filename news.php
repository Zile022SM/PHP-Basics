
<!DOCTYPE html>
<html>
    <?php
        $pageTitle = "Naslovna";
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
                
                <h2>Njanovije vesti sortirane po kategoriji</h2>

                
                <?php $serijalizovaneVesti = file_get_contents(__DIR__ . '/listaVesti.txt'); 
                $vesti = unserialize($serijalizovaneVesti);

                  function array_sort_by_column(&$arr,$col,$dir=SORT_ASC) {
                    $sort_col = array();
                    foreach ($arr as $key=> $row) {
                        $sort_col[$key] = $row[$col];
                    }
  
                    array_multisort($sort_col, $dir, $arr);
                }

                 array_sort_by_column($vesti, 'category');
                 //var_dump($vesti);
                ?>

                <?php 
                   if(count($vesti) > 0) {
                    foreach($vesti as $vest) {
                 ?>
                 
                    <article class="news" style="display:flex;justify-content:space-between;column-gap:20px;align-items:start">
                        <div class="newsImage">
                            <img src="<?php echo $vest['image_ln']; ?>" alt="Nije SALA: Kako da pobrdite insomniju!" style="width: 200px; height: 200px">
                        </div>
                        <div class="newsContent">
                            <h3>
                                <a href=""><?php echo $vest['title']; ?></a>
                            </h3>
                            <p class="description">
                               <?php echo $vest['description']; ?>
                            </p>
                            <p class="categories">
                                <span><?php echo $vest['category']; ?> / <?php echo $vest['subcategory']; ?></span>
                            </p>
                        </div>
                    </article>
                <?php
                    }
                } else {
                ?>
                    <p>Nema vesti</p>
                <?php
                }
                ?>
                
            </main>
            <?php
                include_once './footer.php';
            ?>
        </div>
    </body>
</html>

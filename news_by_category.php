<?php
 
    $currentCategory = NULL;

    if(isset($_GET['category_id']) && is_numeric($_GET['category_id']) && $_GET['category_id'] > 0){
        $idFromRequest = $_GET['category_id'];

        $idFromRequest = strip_tags($idFromRequest);

        $idFromRequest = (int) $idFromRequest;

        $serializedNews = file_get_contents(__DIR__ . '/data/listaVesti.txt');
        $news = unserialize($serializedNews);

        //var_dump($news);

        if(count($news) > 0){

            foreach($news as $value){
                if($value['category_id'] == $idFromRequest){
                    $currentCategory = $value['category'];
                }
            }

        }
    }

    if(is_null($currentCategory)){
        $pageTitle = "No news found";
        header("HTTP/1.0 404 Not Found");
    }else{
        $pageTitle = $currentCategory;
    }

?>
<!DOCTYPE html>
<html>
    <?php
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
                
                <h2>Njanovije vesti sortirane po kategoriji <?php echo $pageTitle; ?></h2>

                <?php 
                   if(count($vesti) > 0) {
                    foreach($vesti as $vest) {
                        if($vest['category_id'] == $idFromRequest){
                 ?>
                 
                    <article class="news" style="display:flex;justify-content:space-between;column-gap:20px;align-items:start">
                        <div class="newsImage">
                            <img src="<?php echo $vest['image_ln']; ?>" alt="Nije SALA: Kako da pobrdite insomniju!" style="width: 200px; height: 200px">
                        </div>
                        <div class="newsContent">
                            <h3>
                                <a href="single-news.php?id=<?php echo $vest['id']; ?>"><?php echo $vest['title']; ?></a>
                            </h3>
                            <p class="description">
                               <?php echo $vest['description']; ?>
                            </p>
                            <p class="categories">
                                <span><?php echo $vest['category']; ?> / <?php echo $vest['subcategory']; ?></span>
                            </p>
                            <p class="views">
                                <span>Views : <?php echo $vest['views']; ?></span>
                            </p>
                        </div>
                    </article>
                <?php
                    }
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

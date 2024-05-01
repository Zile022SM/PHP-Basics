<!DOCTYPE html>
<html>
    <?php
        $pageTitle = "First page";
        require_once './head.php';

        $singleNews = NULL;

        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
           $idFromRequest = $_GET['id'];

           $idFromRequest = strip_tags($idFromRequest);

           $idFromRequest = (int) $idFromRequest;

           $serializedNews = file_get_contents(__DIR__ . '/listaVesti.txt');
           $news = unserialize($serializedNews);

           //var_dump($news);
           if(count($news) > 0){

            foreach($news as $key => $value){
                if($value['id'] == $idFromRequest){
                    $singleNews = $value;
                }
            }

          }
        }

        if(is_null($singleNews)){
            $pageTitle = "No news found";
            header("HTTP/1.0 404 Not Found");
        }else{
            $pageTitle = $singleNews['title'];
        }
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
                
                <h1><?php echo $pageTitle; ?></h1>

                <?php 
                
                  if(!is_null($singleNews)){

                ?>
                    <article class="news" style="display:flex;justify-content:center;column-gap:20px;align-items:start;flex-wrap:wrap">
                        <div class="newsImage">
                            <img src="<?php echo str_replace('_ln', '_f', $singleNews['image_ln']);?>" alt="Nije SALA: Kako da pobrdite insomniju!" style="width: 100%; height: 200px">
                        </div>
                        <div class="newsContent">
                            <h3>
                                <a href="single-news.php?id=<?php echo $singleNews['id']; ?>"><?php echo $singleNews['title']; ?></a>
                            </h3>
                            <p class="description">
                               <?php echo $singleNews['description']; ?>
                            </p>
                            <p class="categories">
                                <span><?php echo $singleNews['category']; ?> / <?php echo $singleNews['subcategory']; ?></span>
                            </p>
                        </div>
                    </article>
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

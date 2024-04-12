<?php 
//header definsemo pre svega u skripti, znaci ne sme biti nista pre ove funkcije, preko nje mozemo da simliramo rikvest tj mozemo da modifikujemo po potrebi odgovr sa servera, cak ne sme biti ni belina tj razmak

 // header("HTTP/1.0 404 Not Found");
  //header("location: https://cubes.rs");
  //die();

 //var_dump($_GET);
  //echo $_GET['ime'];
?>

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
                //ovde dohvatamo preko funkcije tekst iz fajla...
                //..zatim preko userialize pretvaramo tekst u niz 
                $vesti = unserialize($serijalizovaneVesti);
                //var_dump($vesti);

                //ova funkcija sortira niz po koloni, prosledjujemo globalno definisani niz u funkciju preko &
                //dodajemo jos i kolonnu preko koje cemo sortirari nizm i na koji nacin ce se sortirati
                  function array_sort_by_column(&$arr,$col,$dir=SORT_ASC) {
                    //definisemo privremeni niz koji cemo puniti sa odredjenim vrednostima
                    $sort_col = array();
                    //prolazimo kroz globalni niz i u novi niz popunjavamo vrednostsi...
                    foreach ($arr as $key=> $row) {
                        //posto je originalni niz visedimenzionalan moramo uzeti u obzir i kljuceve i vrednosti...
                        //sada u novi niz na istim pozcijama preko $key upisujemo vrednosti podniza pod kljucem koji posaljemo 
                        //ovde ce se svaki clan niza imati vrenost podniza pod kljucem category
                        $sort_col[$key] = $row[$col];
                    }
                    //sortiramo novi niz po odredjenom redosledu sa vrednostima iz originalnog globalnong niza
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

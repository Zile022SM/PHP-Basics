<!DOCTYPE html>
<html>
    <?php

        $formData = $_POST;

        //var_dump($formData);

        $formErrors = array();

        if(isset($formData['submit']) && $formData['submit'] == "Send" && count($formData) > 0){
           
           
            //NAME

           //if $formData['name'] arrived from POST
           if(isset($formData['name'])){

                $formData['name'] = trim(strip_tags($formData['name']));    

                //empty name
                if(empty($formData['name'])){
                   $formErrors['name'][] = "Name is required";
                }

                //input length
                if(mb_strlen($formData['name']) > 0 && mb_strlen($formData['name']) < 3){
                    $formErrors['name'][] = "Name must be at least 3 characters long";
                }


           }else{
              $formErrors['name'][] = "Name input did not arrive from POST";
           }


           //Year of birth
           if(isset($formData['birthYear'])){
            // 1. filtriranje
            $formData['birthYear'] = trim($formData['birthYear']);
            // 2. filtriranje
            $formData['birthYear'] = strip_tags($formData['birthYear']);
            
            // validacija - da li je prazan podatak
            if(empty($formData['birthYear'])){
                $formErrors['birthYear'][] = "Godina rodjenja polaznika ne sme biti prazna ili 0";
            }
            
            // validacija - da li je dosao broj
            if(!is_numeric($formData['birthYear'])){
                $formErrors['birthYear'][] = "Godina rodjenja polaznika mora biti broj";
            }
            
            // validacija - 18+ do 45 godina
            if($formData['birthYear'] < 1974 || $formData['birthYear'] > 2000){
                $formErrors['birthYear'][] = "Polaznik je prestar/premlad na kurs";
            }
            
            // vaidacija - strlen == 4
            if(strlen($formData['birthYear']) != 4){
                $formErrors['birthYear'][] = "Unesite cetvorocifreni broj";
            }
            
        } else{
            $formErrors['birthYear'][] = "Godina rodjenja polaznika nije poslata kroz request";
        }
        
        //STUDENT DESCRIPTION

        if (isset($formData["description"])) {
            //Filtering 1
            $formData["description"] = trim($formData["description"]);

            $allowedTags = "<p><a><b><i><h1><h2><h3><h4><h5><h6>";
            $formData["description"] = strip_tags($formData["description"], $allowedTags);    
            //Filtering 2
            //Filtering 3
            //Filtering 4
            //...
            
            //Validation - if required
            if ($formData["description"] === "") {
                $formErrors["description"][] = "Polje description ne sme biti prazno";
            }
            
            //Validation 2
            //Validation 3
            //Validation 4
            //...
            
        } else {
            //if required
            $formErrors["description"][] = "Polje fieldName mora biti prosledjeno";
        }

        //CATEGORIES

        if (isset($formData["categories"])) {
            //Filtering 1
            $formData["categories"] = trim($formData["categories"]);
            $formData["categories"] = strip_tags($formData["categories"]);    
            $categoriesPossibleValues = array("react", "php", "mern", "lamp");
            //Filtering 2
            //Filtering 3
            //Filtering 4
            //...
            
            //Validation - if required
            if ($formData["categories"] === "") {
                $formErrors["categories"][] = "Polje catgories ne sme biti prazno";
            }
            
            if( !in_array($formData["categories"], $categoriesPossibleValues) ){
                $formErrors["categories"][] = "Bad category selected";
            }
            //Validation 3
            //Validation 4
            //...
            
        } else {
            //if required
            $formErrors["categories"][] = "Polje categories mora biti prosledjeno";
        }

        //GENDER

        if (isset($formData["gender"])) {

            //Filtering 1
            $formData["gender"] = trim($formData["gender"]);
            $formData["gender"] = strip_tags($formData["gender"]);
            $genderPossibleValues = array("male", "female");

            if(!in_array($formData["gender"], $genderPossibleValues)){
                $formErrors["gender"][] = "Bad gender selected";
            }
        }else{
            //in case it is required
            //ako se radio dugme ne cekira nece stici kroz rikvest
           // $formErrors["categories"][] = "Gender required";
        }

        //CLASS TIME

        if (isset($formData["class"])) {	
    
            $fieldNamePossibleValues = array("morning", "afternoon", "evening");
            
            //Validation - if required
            if (count($formData["class"]) === 0) {
                $formErrors["class"][] = "Morate odabrati jednu od vrednosti polja fieldName";
            }
            
            //Validation - validate selected options
            $invalidValues = array_diff($formData["class"], $fieldNamePossibleValues);
            if (!empty($invalidValues)) {
                $formErrors["class"][] = "Izabrali ste neodgovarajuce vrednosti za polje fieldName";
            }
            
            //Validation 2
            //Validation 3
            //...
        } else {
            //if required
            $formErrors["class"][] = "Polje fieldName mora biti prosledjeno";
        }
        
        
        // ako nema gresaka
        // snimi
        if(count($formErrors) == 0){         
            
            $oldStudents = file_get_contents(__DIR__ . "/data/listaPolaznika.txt");
            $oldStudents = unserialize($oldStudents);
            //var_dump($oldStudents);
            
            
            $newStudent = array(
                'name' => $formData['name'],
                'birthYear' => $formData['birthYear'],
                'description' => $formData['description'],
                'categories' => $formData['categories'],
                'gender' => $formData['gender'],
                'class' => $formData['class']
            );
            
           // var_dump($newStudent);

            $oldStudents[] = $newStudent;
            
            //var_dump($oldStudents);
            
            file_put_contents(__DIR__ . "/data/listaPolaznika.txt", serialize($oldStudents));

        }/*
        else{
            echo "Form is not valid";
        }
        */
        }

        $pageTitle = "Contact form";
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
                
                <h1><?php echo $pageTitle; ?></h1>

                <form method="post" action="">
                    <label for="name">Name and Surname:</label>
                    <input id="name" type="text" name="name" 
                    value="<?php if(isset($formData['name'])&& !empty($formData['name'])) echo htmlspecialchars($formData['name']); ?>">

                    <?php
                        if(isset($formErrors['name'])){
                            foreach ($formErrors['name'] as $error) {
                            ?>
                                <span class="error"><?php echo $error; ?></span>
                            <?php
                            }
                        }
                    ?>

                    <br>
                    
                    <label>Year of birth</label>
                    <input 
                        type="text" 
                        name="birthYear" 
                        value="<?php 
                                if(isset($formData['birthYear']) && !empty($formData['birthYear'])) { 
                                    // XSS - htmlentities ili htmlspecialchars
                                    echo htmlspecialchars($formData['birthYear']); 
                                } 
                            ?>"
                    >
                    <?php
                        if(isset($formErrors['birthYear'])){
                            foreach ($formErrors['birthYear'] as $error) {
                            ?>
                                <span class="error"><?php echo $error; ?></span>
                            <?php
                            }
                        }
                    ?>
                    <br>
                    <br>
   
                     <label for="description">Student description</label>
                     <textarea name="description" id="" cols="30" rows="10"><?php if(isset($formData['description'])&& !empty($formData['description'])) echo htmlspecialchars($formData['description']); ?></textarea>
                     <?php
                        if(isset($formErrors['description'])){
                            foreach ($formErrors['description'] as $error) {
                            ?>
                                <span class="error"><?php echo $error; ?></span>
                            <?php
                            }
                        }
                    ?>
                    <br>

                    <label for="categories">Categories</label>

                    <select name="categories">
                        <option value="">-- Select category--</option>
                        <option value="react"<?php echo isset($formData["categories"]) && $formData["categories"] == "react" ? " selected=\"selected\"" : "";?>>Frontend React</option>
                        <option value="php"<?php echo isset($formData["categories"]) && $formData["categories"] == "php" ? " selected=\"selected\"" : "";?>>Backend PHP</option>
                        <option value="mern"<?php echo isset($formData["categories"]) && $formData["categories"] == "mern" ? " selected=\"selected\"" : "";?>>Full-Stack MERN</option>
                        <option value="lamp"<?php echo isset($formData["categories"]) && $formData["categories"] == "lamp" ? " selected=\"selected\"" : "";?>>LAMP Stack</option>
                    </select>
                    <?php
                        if(isset($formErrors['categories'])){
                            foreach ($formErrors['categories'] as $error) {
                            ?>
                                <span class="error"><?php echo $error; ?></span>
                            <?php
                            }
                        }
                    ?>
                    
                    <br>
                    <label for="radio">Choose gender</label>
                    <input type="radio" name="gender" value="male" <?php echo isset($formData["gender"]) && $formData["gender"] == "male" ? " checked=\"checked\"" : ""; ?>>Male 👨‍🎨 
                    <input type="radio" name="gender" value="female" <?php echo isset($formData["gender"]) && $formData["gender"] == "female" ? " checked=\"checked\"" : ""; ?>> Female 👩‍🎨
                    <?php
                        if(isset($formErrors['gender'])){
                            foreach ($formErrors['gender'] as $error) {
                            ?>
                                <span class="error"><?php echo $error; ?></span>
                            <?php
                            }
                        }
                    ?>
                    <br>

                    <label for="checkbox">Choose class time</label>
                    <input type="checkbox" name="class[]" value="morning"<?php echo isset($formData["class"]) && in_array("morning", $formData["class"]) ? " checked=\"checked\"" : "";?>> From 09:00 to 12:00
                    <br>
                    <input type="checkbox" name="class[]" value="afternoon"<?php echo isset($formData["class"]) && in_array("afternoon", $formData["class"]) ? " checked=\"checked\"" : "";?>> From 13:00 to 16:00
                    <br>
                    <input type="checkbox" name="class[]" value="evening"<?php echo isset($formData["class"]) && in_array("evening", $formData["class"]) ? " checked=\"checked\"" : "";?>> From 18:00 to 21:00

                    <?php
                        if(isset($formErrors['class'])){
                            foreach ($formErrors['class'] as $error) {
                            ?>
                                <span class="error"><?php echo $error; ?></span>
                            <?php
                            }
                        }
                    ?>
                    <br>

                    <input type="submit" name="submit" value="Send">
                </form>
                
            </main>
            <?php
                include_once './footer.php';
            ?>
        </div>
    </body>
</html>

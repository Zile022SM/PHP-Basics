<!-- Tekstualna polja -->

<input type="text" name="fieldName" value="<?php echo isset($formData["fieldName"]) ? htmlspecialchars($formData["fieldName"]) : "";?>">

<textarea name="fieldName"><?php echo isset($formData["fieldName"]) ? htmlspecialchars($formData["fieldName"]) : "";?></textarea>



<!-- Polja sa izborom jedne vrednosti -->

<select name="fieldName">
	<option value="option1"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option1" ? " selected=\"selected\"" : "";?>>Option1 Label</option>
	<option value="option2"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option2" ? " selected=\"selected\"" : "";?>>Option2 Label</option>
	<option value="option3"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option3" ? " selected=\"selected\"" : "";?>>Option3 Label</option>
	<option value="option4"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option4" ? " selected=\"selected\"" : "";?>>Option4 Label</option>
</select>

<label><input type="radio" name="fieldName" value="option1"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option1" ? " checked=\"checked\"" : "";?>> Option1 Label</label>
<label><input type="radio" name="fieldName" value="option2"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option2" ? " checked=\"checked\"" : "";?>> Option2 Label</label>
<label><input type="radio" name="fieldName" value="option3"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option3" ? " checked=\"checked\"" : "";?>> Option3 Label</label>
<label><input type="radio" name="fieldName" value="option4"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == "option4" ? " checked=\"checked\"" : "";?>> Option4 Label</label>




<!-- Polja sa izborom vise vrednosti -->

<label><input type="checkbox" name="fieldName[]" value="option1"<?php echo isset($formData["fieldName"]) && in_array("option1", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>> Option1</label>
<label><input type="checkbox" name="fieldName[]" value="option2"<?php echo isset($formData["fieldName"]) && in_array("option2", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>> Option2</label>
<label><input type="checkbox" name="fieldName[]" value="option3"<?php echo isset($formData["fieldName"]) && in_array("option3", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>> Option3</label>
<label><input type="checkbox" name="fieldName[]" value="option4"<?php echo isset($formData["fieldName"]) && in_array("option4", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>> Option4</label>

<select name="fieldName[]" multiple="multiple">
	<option value="option1"<?php echo isset($formData["fieldName"]) && in_array("option1", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>>Option1 Label</option>
	<option value="option2"<?php echo isset($formData["fieldName"]) && in_array("option2", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>>Option2 Label</option>
	<option value="option3"<?php echo isset($formData["fieldName"]) && in_array("option3", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>>Option3 Label</option>
	<option value="option4"<?php echo isset($formData["fieldName"]) && in_array("option4", $formData["fieldName"]) ? " checked=\"checked\"" : "";?>>Option4 Label</option>
</select>



<!-- Ispisivanje gresaka za jedno polje -->

<?php 
    if (isset($formErrors["fieldName"])) {
        foreach($formErrors["fieldName"] as $errorMessage) {
            ?>
                <span class="error"><?php echo $errorMessage;?></span>
            <?php
        }
    }
?>

<?php


	if (isset($formData["fieldName"])) {
        //Filtering 1
		$formData["fieldName"] = trim($formData["fieldName"]);
		
		
		$fieldNamePossibleValues = array("option1", "option2", "option3");
		
		//Validation - if required
		if ($formData["fieldName"] === "") {
			$formErrors["fieldName"][] = "Morate odabrati jednu od vrednosti polja fieldName";
		}
		
		if (!in_array($formData["fieldName"], $fieldNamePossibleValues)) {
			$formErrors["fieldName"][] = "Izabrali ste neodgovarajucu vrednost za polje fieldName";
		}
		
		//Validation 2
		//Validation 3
		//...
	} else {
        //if required
		$formErrors["fieldName"][] = "Polje fieldName mora biti prosledjeno";
	}

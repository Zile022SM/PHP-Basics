<?php

	if (isset($formData["fieldName"])) {//Filtering 		
		//Filtering 2
		//Filtering 3
		//Filtering 4
		$fieldNamePossibleValues = array("value1", "value2", "value3");
		
		//Validation - if required
		if (count($formData["fieldName"]) === 0) {
			$formErrors["fieldName"][] = "Morate odabrati jednu od vrednosti polja fieldName";
		}
		
		//Validation - validate selected options
		$invalidValues = array_diff($formData["fieldName"], $fieldNamePossibleValues);
		if (!empty($invalidValues)) {
			$formErrors["fieldName"][] = "Izabrali ste neodgovarajuce vrednosti za polje fieldName";
		}
		
		//Validation 2
		//Validation 3
		//...
	} else {
        //if required
		$formErrors["fieldName"][] = "Polje fieldName mora biti prosledjeno";
	}

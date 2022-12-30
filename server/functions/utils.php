<?php

function are_all_fields_defined($arr){
	$missing = [];
	foreach ($arr as $k){
		if (!array_key_exists($k, $_POST)) {
			array_push($missing, $k);
		}
	}
	if (!!count($missing)) {
		return [false, $missing];
	}
	return [true, NULL];
};

function exclude_dot_dirs($array){
	return array_filter($array, function ($a) {
		return !str_starts_with($a, ".");
	});
}

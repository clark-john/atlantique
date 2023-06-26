<?php
require_once "init.php";

use Atlantique\Router;

$url = "http://localhost:5173";
$r = new Router($url);

$r->from_arrays(
	[
		"method" => "GET",
		"handle" => function($res){
			$res->type("application/json");			
			$res->write(["hello" => "world"]);
		},
		"path" => "/"
	],
	$create,
	$update,
	$delete,
	$read,
	$read_all
);

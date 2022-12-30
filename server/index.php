<?php
require_once "init.php";

use Bloggiton\Router;

$r = new Router();

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

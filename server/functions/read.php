<?php

$read = [
	"method" => "GET",
	"path" => "/blog",
	"handle" => function($res){
		global $db;
		$res->type("application/json");
		$url = parse_url(FULL_URL);
 		$id = null;

 		if ((NULL === ($id = $_GET['id']))) {
 			$res->status(400);
 			$res->write(["detail" => "Post id is required"]);
 			die();
		}
 		$blog = $db->find_blog($id);

 		if ($blog) {
 			$res->write($blog);
 		} else {	
 			$res->status(404);
			$res->write(["detail" => "Blog id $id not found"]);
 		}
	}	
];

$read_all = [
	"path" => "/blogs",
	"handle" => function($res){
		global $db;
		$res->type("application/json");
 		$url = parse_url(FULL_URL);
 		$limit_size = null;

 		if (isset($_GET["limit"])) {
 			$limit_size = $_GET["limit"];
 		}

 		$res->write($db->find_blogs(limit: $limit_size));
	},
	"method" => "GET"
];

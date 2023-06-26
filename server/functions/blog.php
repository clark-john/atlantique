<?php
require "read.php";

use Atlantique\Database;

$db = new Database();

$create = [
	"method" => "POST",
	"handle" => function($res){
		global $db;
		$arr = ['title', 'content', 'category'];
		[$are_all_def, $missing] = are_all_fields_defined($arr);
		$res->type("application/json");
		if (!$are_all_def) {
			$res->write(["detail" => "There are missing required fields", "fields" => $missing]);
			$res->status(400);
		} else {
			$db->create_blog(
				$_POST['title'], 
				$_POST['content'], 
				$_POST['category'], 
				$_POST['tags'] ?? ''
			);
			$res->status(204);
		}
	},
	"path" => "/create"
];

$update = [
	"method" => "POST",
	"handle" => function ($res){
		global $db;
		$arr = ['post_id', 'title', 'content', 'category'];
		[$are_all_def, $missing] = are_all_fields_defined($arr);
		$res->type("application/json");
		if (!$are_all_def) {
			$res->write(["detail" => "There are missing required fields", "fields" => $missing]);
			$res->status(400);
		} else {
			$db->update_blog(
				$_POST['post_id'], 
				$_POST['title'], 
				$_POST['content'], 
				$_POST['category'], 
				$_POST['tags']
			);
			$res->status(204);
		}
	},
	"path" => "/update"
];

$delete = [
	"method" => ["DELETE", "OPTIONS"],
	"handle" => function ($res) {
		global $db;
		$res->type("application/json");
		$url = parse_url(FULL_URL);

		if (isset($_GET['id'])) {
			$db->delete_blog($_GET['id']);
			$res->status(204);			
		} else {
			$res->write("Post id is required");
			$res->status(400);				
		}
	},
	"path" => "/delete"
];

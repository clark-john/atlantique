<?php
require "functions/utils.php";

define("SQLITE_URI", "sqlite:app.db");
define("FULL_URL", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

$dir = "Atlantique";
$files = exclude_dot_dirs(scandir($dir));

foreach ($files as $file){
	if (str_ends_with($file, ".php")) {
		include $dir . "/$file";
	} else {
		$subdir = "$dir/" . $file;
		$arr = exclude_dot_dirs(scandir($subdir));
		foreach ($arr as $f) {
			include "$subdir/" . $f;
		}
	}
}

require "functions/blog.php";

\Atlantique\Database::init();

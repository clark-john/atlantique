<?php
namespace Bloggiton;

class Database {
	private \PDO $pdo;
	public function __construct(){
		$this->pdo = new \PDO(SQLITE_URI);
	}

	public static function init(){
		$pdo = new \PDO(SQLITE_URI);
		$pdo->exec("
			CREATE TABLE IF NOT EXISTS blogs (
			 	id integer primary key autoincrement, 
				title varchar(200),
			  content text,
				created_at datetime,
				category text,
				tags text
			)
		");
		unset($pdo);
	}
	public function create_blog($title, $content, $category, $tags){
		$this->pdo->query("
			INSERT INTO blogs (title, content, created_at, category, tags) 
			VALUES ('$title', '$content', DATETIME('now', 'localtime'), '$category', '$tags')
		");
	}
	public function update_blog($id, $title, $content, $category, $tags){
		$this->pdo->query("
			UPDATE blogs 
			SET title = '$title', content = '$content', category = '$category', tags = '$tags' 
			WHERE id = $id;
		");
	}
	public function delete_blog($id){
		$this->pdo->query("DELETE FROM blogs WHERE id = $id");
	}
	public function find_blog($id){
		$arr = $this->pdo->query("SELECT * FROM blogs WHERE id = $id")->fetch();
		if ($arr) {
			$this->remove_number_keys($arr);
			return json_encode($arr);
		} else {
			return false;
		}
	}
	public function find_blogs($limit = NULL){
		$blogs = [];
		$sql = "SELECT * FROM blogs";
		if (!is_null($limit)) {
			$sql .= " LIMIT $limit";			
		}
		$filtered_blogs = $this->pdo->query($sql)->fetchAll();
		foreach ($filtered_blogs as $blog){
			$this->remove_number_keys($blog);
			array_push($blogs, $blog);
		}
		return json_encode($blogs);
	}

	private function remove_number_keys(&$arr){
		foreach (array_keys($arr) as $key) {
			if (is_numeric($key)) {
				unset($arr[$key]);
			}
		}
	}
}

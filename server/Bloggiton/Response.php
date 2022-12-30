<?php
namespace Bloggiton;

class Response {
	public function type($type){
		header("Content-Type: $type");
	}
	public function status($number){
		http_response_code($number);
	}
	public function write(mixed $val){
		if (is_array($val)){
			echo json_encode($val);
		} else {
			echo $val;
		}
	}
	public function setHeader($header, $value){
		header("$header: $value");
	}
}

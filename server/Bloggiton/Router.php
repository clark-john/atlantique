<?php
namespace Bloggiton;

class Router {
	private function process_request($function){
		// header("Access-Control-Allow-Origin: http://localhost:5173");
		header("Access-Control-Allow-Origin: http://127.0.0.1:8080");
		
		header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
		// null response so that every route can modify it
		$res = new Response();
		$function($res);
	}
	public function from_arrays(...$arrs){
		$array = array_filter($arrs, function($item){
			$parsed = parse_url(FULL_URL);
			$method = $_SERVER['REQUEST_METHOD'];
			return $parsed['path'] === $item['path'] && 
				(is_array($item['method']) 
					? in_array($method, $item['method']) 
					: $method === $item['method']);
		});
		$key = key($array);
		// no 405 responses, still 404 (either wrong path or method)
		if (is_null($key)) {
			http_response_code(404);
			echo 'not found';
		} else {
			$this->process_request($arrs[$key]['handle']);			
		}
		// array
	}
}

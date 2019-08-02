<?php 

	/*
		Plugin Name: Buscador github
		Plugin URI: http://www.google.com.ar
		Description: Shortcode utilizado para la busqueda de repositorios en github
		Author: Juan Federico
		Version: 1.0.0
		Author URI: http://www.juanfederico.com.ar
	*/

	function githubFinder($atts){

		if($_SERVER['REQUEST_METHOD'] == "GET"){
			echo "hola mundo";
		}

		$args = shortcode_atts( array(
			'facebook' => 'http://www.facebook.com', //Valores por defecto
			'twitter' => 'http://www.twitter.com', //Valores por defecto
			'instagram' => 'http://www.instagram.com' //Valores por defecto
		), $atts); //Captura los atributos del shortcode y recibe parametros, en forma de arrays

		return "probando";

	}

	add_shortcode("github-finder", "githubFinder");

?>
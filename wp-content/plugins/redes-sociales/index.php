<?php 

	/*
		Plugin Name: Social network shower
		Plugin URI: http://www.google.com.ar
		Description: Utilizado para mostrar las redes sociales del autor y practicar acerca de plugins
		Author: Juan Federico
		Version: 1.0.0
		Author URI: http://www.juanfederico.com.ar
	*/

	function social_networks($atts){

		$args = shortcode_atts( array(
			'facebook' => 'http://www.facebook.com', //Valores por defecto
			'twitter' => 'http://www.twitter.com', //Valores por defecto
			'instagram' => 'http://www.instagram.com' //Valores por defecto
		), $atts); //Captura los atributos del shortcode y recibe parametros, en forma de arrays

		$facebook = "<a href='". $args['facebook'] ."' target='_blank'>Facebook</a>";
		$twitter = "<a href='". $args['twitter'] ."' target='_blank'>Twitter</a>";
		$instagram = "<a href='". $args['instagram'] ."' target='_blank'>Instagram</a>";

		$social = "<b>Facebook: </b> " . $facebook . "<br><b>Twitter: </b> " . $twitter . "<br><b>Instagram: </b>" .  $instagram;

		return $social;
	}

	add_shortcode("social_networks", "social_networks"); //El primer parametro es el nombre del shortcode y el segundo es la funcion (o funciones) que ejecuta/n al llamarlo

?>
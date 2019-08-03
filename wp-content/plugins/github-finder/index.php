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

		$dataSalida = "<br>";
		//Variables que definen el criterio de busqueda de github
		$query = get_field('query');
		$ordenamiento = get_field('ordenamiento')['value']; //Valor del select

		$url = "https://api.github.com/search/repositories?q=".$query."&sort=".$ordenamiento."&order=desc";

    	$result = wp_remote_get( $url );
    	$result = json_decode($result['body'], true);

		foreach (array_slice($result['items'], 0, 5) as $items){ //Primeros 5 elementos
	    	$dataSalida .= "<b>Nombre del repositorio: </b>" . $items["name"] . "<br>";
	    	$dataSalida .= "<b>Cantidad de estrellas: </b>" . $items["stargazers_count"] . "<br>";
	    	$dataSalida .= "<b>Link al repositorio: </b> 
	    		<a href='".$items['html_url']."'>" . $items["html_url"] . "</a><br>";
	    	$dataSalida .= "<br><br>";
	    }

    	return $dataSalida;
	}

	

	add_shortcode("github-finder", "githubFinder");

?>
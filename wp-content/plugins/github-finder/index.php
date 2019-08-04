<?php 

	/*
		Plugin Name: Buscador github
		Plugin URI: http://www.google.com.ar
		Description: Shortcode utilizado para la busqueda de repositorios en github
		Author: Juan Federico
		Version: 1.0.0
		Author URI: http://www.juanfederico.com.ar
	*/

	//Agrego estilos (en este caso de bootstrap y font-awesome) para utilizarlos en los resultados
	add_action('wp_enqueue_scripts','register_my_scripts');

	function register_my_scripts(){
	    wp_enqueue_style( 'bootstrap-css1', plugins_url( '/css/bootstrap.css' , __FILE__ ) );
	    wp_enqueue_style( 'bootstrap-css2', plugins_url( '/css/bootstrap-theme.css' , __FILE__ ) );
	    wp_enqueue_style( 'bootstrap-css3', plugins_url( '/css/bootstrap-glyphicons.css' , __FILE__ ) );
	    wp_enqueue_style( 'bootstrap-css4', plugins_url( '/css/bootstrap-grid.css' , __FILE__ ) );
	    wp_enqueue_style( 'fa', plugins_url( '/css/all.css' , __FILE__ ) );
	    wp_enqueue_style( 'fonts1', plugins_url( '/webfonts/fa-solid-900.woff' , __FILE__ ) );
	    wp_enqueue_style( 'fonts2', plugins_url( '/webfonts/fa-solid-900.woff2' , __FILE__ ) );
	    wp_enqueue_script( 'jquery-min', plugins_url( '/js/jquery.min.js' , __FILE__ ) );
		wp_enqueue_script( 'cb-min', plugins_url( '/dist/clipboard.min.js' , __FILE__ ) );
		wp_enqueue_script( 'funcionalidad', plugins_url( '/js/script.js' , __FILE__ ) );
	    //wp_enqueue_script( 'clipboard', plugins_url( '/js/script.js' , __FILE__ ) );
	}

	function githubFinder($atts){

		$dataSalida = "<br>";
		//Variables que definen el criterio de busqueda de GitHub
		$query = get_field('query'); //Valor del string para la propiedad 'q'
		$ordenamiento = get_field('ordenamiento')['value']; //Valor del select para propiedad 'sort'

		$url = "https://api.github.com/search/repositories?q=".$query."&sort=".$ordenamiento."&order=desc";

		echo '<div class="input-group-lg mb-3">';
  		echo '<input id="linkgit" type="text" class="form-control input-lg">';
  		echo '<div class="input-group-append">';
    	echo '<button class="btn btn-outline-secondary" data-clipboard-target="#linkgit" type="button">Button</button></div></div>';

    	//echo $prueba;

    	$result = wp_remote_get( $url ); //Consumiendo la API mediante GET
    	$result = json_decode($result['body'], true); //Transformando la data a lo que nos interesa

		foreach (array_slice($result['items'], 0, 5) as $items){ //Mostrando primeros 5 elementos
			$dataSalida .= '<div class="panel panel-default">';
	    	$dataSalida .= '<div class="panel-body">';
	    	$dataSalida .= '<ul>';

	    	$dataSalida .= '<li>';
	    	$dataSalida .= "<u>Nombre del repositorio:</u> " . $items["name"] . "<br>";
	    	$dataSalida .= '</li>';

	    	$dataSalida .= '<li>';
	    	$dataSalida .= "<u>Cantidad de estrellas:</u> <i class='fa fa-star'></i>" . $items["stargazers_count"] . "<br>";
	    	$dataSalida .= '</li>';

	    	$dataSalida .= '<li>';
	    	$dataSalida .= "<u>Link al repositorio:</u>  
	    		<a href='".$items['html_url']."'>" . $items["html_url"] . "</a><br>";
	    	$dataSalida .= '</li>';
	    	
	    	$dataSalida .= '</ul>';
	    	$dataSalida .= "</div></div>";
	    }

	    echo "Hay?" . has_action("admin_menu");

    	return $dataSalida;
	}

	add_shortcode("github-finder", "githubFinder");

?>
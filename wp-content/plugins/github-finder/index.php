<?php 
	/*
		Plugin Name: Buscador github
		Plugin URI: http://www.google.com.ar
		Description: Plugin utilizado para la busqueda de repositorios en github, según un tipo de criterio determinado (acceder a wpnombre/criterios para ver todos los links referidos a los criterios)
		Author: Juan Federico
		Version: 1.0.0
		Author URI: https://github.com/Juanfederico
	*/

	//Configurando estructura de los enlaces permanentes para que el plugin use la ruta nombrewp/criterios
	if(strcmp(get_option('permalink_structure'),'/%category%/%post_id%')==0) 
		update_option('permalink_structure', '/%category%/%post_id%');

	//Agrego estilos para utilizarlos en los resultados
	//Incluye Bootstrap, , font-awesome, jQuery, ClipboardJS
	function register_my_scripts(){
	    wp_enqueue_style( 'bootstrap-css1', plugins_url( '/css/bootstrap.css' , __FILE__ ) );
	    wp_enqueue_style( 'bootstrap-css2', plugins_url( '/css/bootstrap-theme.css' , __FILE__ ) );
	    wp_enqueue_style( 'bootstrap-css3', plugins_url( '/css/bootstrap-glyphicons.css' , __FILE__ ) );
	    wp_enqueue_style( 'bootstrap-css4', plugins_url( '/css/bootstrap-grid.css' , __FILE__ ) );
	    wp_enqueue_style( 'fa', plugins_url( '/css/all.css' , __FILE__ ) );
	    wp_enqueue_style( 'fonts1', plugins_url( '/webfonts/fa-solid-900.woff' , __FILE__ ) );
	    wp_enqueue_style( 'fonts2', plugins_url( '/webfonts/fa-solid-900.woff2' , __FILE__ ) );
	    wp_enqueue_script( 'jq', plugins_url( '/js/jquery.min.js' , __FILE__ ) );
		wp_enqueue_script( 'clipboard-js', plugins_url( '/dist/clipboard.min.js' , __FILE__ ) );
		wp_enqueue_script( 'bootstrap-js', plugins_url( '/js/bootstrap.js' , __FILE__ ) );
		wp_enqueue_script( 'funciones', plugins_url( '/js/funciones.js' , __FILE__ ) );
	}
	add_action('wp_enqueue_scripts','register_my_scripts');

	function githubFinder($atts){
		//Inicio del shortcode con los detalles del criterio establecido por el administrador
		$tipo_de_post = get_post_type();
		echo "<br><b>Tipo de post: </b>" . $tipo_de_post ."<br>";
		if($tipo_de_post=='criterio'){
			echo "<b>String de búsqueda: </b>";
			echo get_field('query') . "<br>";
			echo "<b>Criterio de ordenamiento: </b>";
			echo get_field_object('ordenamiento')['value']['label']; //Label del criterio
			echo "<br>";
			echo "<h3>A continuación se listan los 5 primeros repositorios que aparecen según los criterios establecidos:</h3>";
		}

		//Comienza a obtenerse la data especifica de la busqueda mediante HTTP GET. El metodo de obtención que utilizamos es el que nos provee wordpress (wp_remote_get))
		$dataSalida = "";
		//Variables que definen el criterio de busqueda de GitHub
		$query = get_field('query'); //Valor del string para la propiedad 'q'
		$ordenamiento = get_field('ordenamiento')['value']; //Valor del select para propiedad 'sort'

		$url = "https://api.github.com/search/repositories?q=".$query."&sort=".$ordenamiento."&order=desc";
		$urlClipboard = "https://github.com/search?o=desc&q=".$query."&s=".$ordenamiento."&type=Repositories";

		//Input con boton para copiar la url original a la busqueda en github
    	echo '<div class="input-group">';
    	echo '<input id="linkgit" type="text" value="'.$urlClipboard.'" class="form-control" style="font-size: 16px;">';
		echo '<span class="input-group-btn">';
		echo '<button id="copiar" class="btn btn-default" data-clipboard-target="#linkgit" type="button">Copiar</button>';
		echo '</span>';
		echo '</div>';

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

	    if(get_option('estadoghf')==1) return "Disculpe, estamos mejorando el plugin.";
    	else return $dataSalida;
	}
	add_shortcode("github-finder", "githubFinder");

	//Menu para poner al plugin en estado de matenimiento
	function menu_gitHubFinder() {
  	add_menu_page('Github finder', 'Github finder', 'manage_options', 'ghf_mantenimiento', 'output_menu');
	  function output_menu() {
	  echo "<form action=''>";
	  echo "<h1>Activar/Desactivar funcionalidad del GitHub finder</h1>";
	  echo "<p>Esta funcionalidad nos permite desactivar temporalmente el plugin de github.</p>";
	  if(get_option('estadoghf')==0 || get_option('estadoghf')==false){
	  	echo "<input type='hidden' name='mantenimiento' value='1'>";
	  	echo "<input type='checkbox' name='estado' value='1' unchecked onChange='this.form.submit()''>Modo mantenimiento</input>";
	  }
	  else{
	  	echo "<input type='hidden' name='mantenimiento' value='0'>";
	  	echo "<input type='checkbox' name='estado' value='0' checked onChange='this.form.submit()''>Modo mantenimiento</input>";
	  }
	  echo "</form>";
	  }

	  if(isset($_GET['mantenimiento'])){
		  if($_GET['mantenimiento']==1){
			  if(get_option('estadoghf')==0) update_option('estadoghf', 1);
			  if(get_option('estadoghf')==false) add_option('estadoghf', 1); //Si no existe
		  }
		  else{ //Si mantenimiento vale 0, es decir, hay que desactivar el plugin
			  if(get_option('estadoghf')==1) update_option('estadoghf', 0);
			  if(get_option('estadoghf')==false) add_option('estadoghf', 0); //Si no existe
	  	  }

	  	  header('Location: ../wp-admin'); //Redireccion a la vista principal del backoffice
	  }
	}
	add_action("admin_menu", "menu_gitHubFinder");

	/* Criterio de busqueda para github (Custom post type) */

	function criterio_post_type(){
		//definiendo los nombres de las etiquetas de nombre
		$labels = array(
		'name'                  => __( 'Criterios de búsqueda', 'testtheme' ),
		'singular_name'         => __( 'criterios', 'testtheme' ),
		'menu_name'             => __( 'Criterio', 'testtheme' ),
		'name_admin_bar'        => __( 'Criterio', 'testtheme' ),
		'archives'              => __( 'Archivos de criterios', 'testtheme' ),
		'all_items'             => __( 'Todos los criterios', 'testtheme' ),
		'add_new_item'          => __( 'Agregar nuevo criterio', 'testtheme' ),
		'add_new'               => __( 'Agregar criterio', 'testtheme' ),
		'new_item'              => __( 'Nuevo criterio', 'testtheme' ),
		'edit_item'             => __( 'Editar criterio', 'testtheme' ),
		'update_item'           => __( 'Actualizar criterio', 'testtheme' ),
		'view_item'             => __( 'Ver criterio', 'testtheme' ),
		'view_items'            => __( 'Ver criterio', 'testtheme' ),
		'search_items'          => __( 'Buscar criterios', 'testtheme' ),
		'not_found'             => __( 'No encontrado', 'testtheme' ),
		'featured_image'        => __( 'Imagen Destacada', 'testtheme' ),
		'set_featured_image'    => __( 'Colocar imagen destacada', 'testtheme' ),
		'remove_featured_image' => __( 'Quitar imagen destacada', 'testtheme' ),
		'use_featured_image'    => __( 'Usar como imagen destacada', 'testtheme' ),
		'insert_into_item'      => __( 'Insertar en el criterio', 'testtheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'testtheme' ),
		'items_list'            => __( 'Lista de criterios', 'testtheme' )
		);

	$args = array(
		'label'                 => __( 'Criterio', 'juanfederico' ),
		'description'           => __( 'Lista de criterios', 'juanfederico' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor' ),
		'taxonomies'            => array( 'Dominios','Hosting' ),
		'public'                => true,
		'menu_position'         => 5,
		'has_archive'           => 'criterios'
	);
	register_post_type( 'criterio', $args );
	}
	add_action('init', 'criterio_post_type');

?>
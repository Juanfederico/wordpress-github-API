<?php 
	if(isset(get_field('query'))){

		$query = get_field('query');
		$ordenamiento = get_field('ordenamiento');

		$url = "";

		$ch = curl_init();
	    curl_setopt_array($ch, [
	        CURLOPT_URL => "https://api.github.com/search/repositories?q=".$query."&sort=".$ordenamiento,
	        CURLOPT_HTTPHEADER => [
	            "Accept: application/vnd.github.mercy-preview+json",
	            "Content-Type: application/json",
	            "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
	        ],
	        CURLOPT_RETURNTRANSFER => true
	    ]);
	    $response = curl_exec($ch);
	    $response = json_decode($response, true); //A Json
	    echo "<br>";
	    foreach ($response["items"] as $items){
	    	echo "Nombre del repositorio: " . $items["name"] . "<br>";
	    	echo "Cantidad de estrellas: " . $items["stargazers_count"] . "<br>";
	    	echo "Link al repositorio: " . $items["html_url"] . "<br>";
	    	echo "<br><br>";
	    }
	    //var_dump($response);
	    curl_close($ch);
	}
 ?>
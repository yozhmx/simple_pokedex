<?php
// author @yozhmx

$search   = isset($_POST['search']) ? $_POST['search'] : ""; 
$resource = "https://pokeapi.co/api/v2/pokemon/".$search;

//Realizo la busqueda utilizando una fachada 
$response = facade($resource);

try {
    //Si no encontramos un pokemon nos regresaran un 404 
    if($response['httpCode'] != 404){
        http_response_code(202);
        echo  $response['response'];
    }else{
        http_response_code(404); 
    }
} catch (\Throwable $th) {
    http_response_code(503);
}



/**
 * facade
 *
 * @param string $resource
 * @return array
 */
function facade(string $resource): array
{
    //Iniciamos la sesión CURL
    $ch = curl_init();

    //Agregamos opciones
    curl_setopt($ch, CURLOPT_URL, $resource);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    //ejecutamos la consulta
    $response = curl_exec($ch);

    //Colectamos el estado de respuesta
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    //Cerramos la sesión
    curl_close($ch);
    
    //retornamos la respuesta y el http code
    return [
        'response' => pokemon_info($response),
        'httpCode' => $httpCode
    ];
}

/**
 * pokemon_info
 *
 * @param string $response
 * @return void
 */
function pokemon_info(string $response): string 
{
  $pokemon_info = json_decode($response, true);
  return json_encode([
    'id' => $pokemon_info['id'],
    'name' => $pokemon_info['name'],
    'image' => $pokemon_info['sprites']['front_default'],     
  ]);
}
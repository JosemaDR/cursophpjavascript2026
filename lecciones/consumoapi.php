<?php
//header('Content-Type: application/json; charset=utf-8');

$url = 'https://api.chucknorris.io/jokes/random';

$respuesta = json_decode(file_get_contents($url));
var_dump($respuesta);

echo '<img src="' . $respuesta->icon_url . '" alt="Chuck Norris" />';
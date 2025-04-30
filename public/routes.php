<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write( 'Olá' );
    return $response;
});

// $app->get('/students', function (Request $request, Response $response, $args) {
//     return $this->get(StudentAdapter::class)->listStudents( $request, $response, $args );
// });


?>
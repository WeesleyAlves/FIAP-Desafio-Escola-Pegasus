<?php

use DI\Container;

use Slim\Factory\AppFactory;
use Src\Core\Students\Application\Services\CreateStudentService;
use Src\Core\Students\Application\InputPorts\CreateStudentServicePort;

$container = new Container();

// $container->set( StudentsRepositoryPort::class , function( Container $container ) {
//     return new StudentsDBRepository( $container->get('pdo_connection') );

//     // return new StudentsMemRepository();
// });

$container->set( CreateStudentServicePort::class , function( Container $container ) {
    return new CreateStudentService();
});

$container->set( 'pdo_connection', function() {
    try {

        $conn = new PDO('mysql:host=localhost;dbname=fiap_pegasus', 'fiap_pegasus', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;

    } catch(PDOException $e) {
        
        echo 'ERROR: ' . $e->getMessage();
        return null;

    }
});

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

?>
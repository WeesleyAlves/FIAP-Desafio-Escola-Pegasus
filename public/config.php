<?php

use DI\Container;

use Slim\Factory\AppFactory;
use Src\Adapters\Driven\Database\StudentsRepository;
use Src\Core\Students\Application\Services\CreateStudentService;
use Src\Core\Students\Application\Services\DeleteStudentService;
use Src\Core\Students\Application\Services\SearchStudentService;
use Src\Core\Students\Application\Services\UpdateStudentService;
use Src\Core\Students\Domain\OutputPorts\StudentsRepositoryPort;
use Src\Core\Students\Application\InputPorts\CreateStudentServicePort;
use Src\Core\Students\Application\InputPorts\DeleteStudentServicePort;
use Src\Core\Students\Application\InputPorts\SearchStudentServicePort;
use Src\Core\Students\Application\InputPorts\UpdateStudentServicePort;

$container = new Container();

// $container->set( StudentsRepositoryPort::class , function( Container $container ) {
//     return new StudentsDBRepository( $container->get('pdo_connection') );

//     // return new StudentsMemRepository();
// });

$container->set( CreateStudentServicePort::class , function( Container $container ) {
    return new CreateStudentService( $container->get( StudentsRepositoryPort::class ) );
});

$container->set( SearchStudentServicePort::class , function( Container $container ) {
    return new SearchStudentService( $container->get( StudentsRepositoryPort::class ) );
});

$container->set( DeleteStudentServicePort::class , function( Container $container ) {
    return new DeleteStudentService( $container->get( StudentsRepositoryPort::class ) );
});

$container->set( UpdateStudentServicePort::class , function( Container $container ) {
    return new UpdateStudentService( $container->get( StudentsRepositoryPort::class ) );
});

$container->set( StudentsRepositoryPort::class , function( Container $container ) {
    return new StudentsRepository( $container->get( 'pdo_connection' ) );
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
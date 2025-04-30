<?php

use DI\Container;

use Slim\Factory\AppFactory;

use Src\Adapters\Driver\API\CourseAdapter;
use Src\Adapters\Driver\API\StudentAdapter;

use Src\Adapters\Driver\API\StudentsTestAdapter;

use Src\Core\Application\Courses\Services\ListCoursesService;
use Src\Core\Domain\Courses\OutputPorts\CourseRepositoryPort;

use Src\Core\Application\Courses\Services\SearchCoursesService;
use Src\Core\Application\Students\Services\ListStudentsService;
use Src\Adapters\Driven\Database\Repository\CoursesDBRepository;
use Src\Core\Domain\Students\OutputPorts\StudentsRepositoryPort;
use Src\Adapters\Driven\Database\Repository\StudentsDBRepository;
use Src\Core\Application\Students\Services\SearchStudentsService;
use Src\Adapters\Driven\Database\Repository\StudentsMemRepository;


$container = new Container();

$container->set( StudentsRepositoryPort::class , function( Container $container ) {
    return new StudentsDBRepository( $container->get('pdo_connection') );

    // return new StudentsMemRepository();
});

$container->set( ListStudentsService::class , function( Container $container ) {
    return new ListStudentsService( $container->get( StudentsRepositoryPort::class ) );
});

$container->set( SearchStudentsService::class , function( Container $container ) {
    return new SearchStudentsService( $container->get( StudentsRepositoryPort::class ) );
});


$container->set( StudentAdapter::class , function( Container $container ) {
    // return new StudentsTestAdapter();

    return new StudentAdapter( 
        $container->get( ListStudentsService::class ),
        $container->get( SearchStudentsService::class ),
    );
});

$container->set( CourseRepositoryPort::class , function( Container $container ) {
    return new CoursesDBRepository( $container->get('pdo_connection') );
});

$container->set( ListCoursesService::class , function( Container $container ) {
    return new ListCoursesService( $container->get( CourseRepositoryPort::class ) );
});

$container->set( SearchCoursesService::class , function( Container $container ) {
    return new SearchCoursesService( $container->get( CourseRepositoryPort::class ) );
});

$container->set( CourseAdapter::class , function( Container $container ) {
    return new CourseAdapter( 
        $container->get( ListCoursesService::class ) ,
        $container->get( SearchCoursesService::class ) ,
    );
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
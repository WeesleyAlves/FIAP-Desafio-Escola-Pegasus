<?php

use DI\Container;
use Slim\Factory\AppFactory;

use Src\Adapters\Driver\API\StudentAdapter;
use Src\Adapters\Driver\API\StudentsTestAdapter;

use Src\Core\Domain\Students\OutputPorts\StudentsOutputPort;
use Src\Core\Application\Students\Services\ListStudentsService;
use Src\Core\Application\Students\Services\SearchStudentsService;
use Src\Adapters\Driven\Database\Repository\StudentsMemRepository;

$container = new Container();

$container->set( StudentsOutputPort::class , function() {
    return new StudentsMemRepository();
});

$container->set( ListStudentsService::class , function( Container $container ) {
    return new ListStudentsService( $container->get( StudentsOutputPort::class ) );
});

$container->set( SearchStudentsService::class , function( Container $container ) {
    return new SearchStudentsService( $container->get( StudentsOutputPort::class ) );
});


$container->set( StudentAdapter::class , function( Container $container ) {
    // return new StudentsTestAdapter();

    return new StudentAdapter( 
        $container->get( ListStudentsService::class ),
        $container->get( SearchStudentsService::class ),
    );
});

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

?>
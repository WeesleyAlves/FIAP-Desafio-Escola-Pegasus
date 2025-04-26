<?php

namespace Src\Adapters\Driver\API;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Application\Students\Ports\StudentsInput;

use Src\Adapters\Driven\Database\Repository\StudentsRepository;
use Src\Core\Application\Students\Services\ListStudentsService;
use Src\Core\Application\Students\Services\SearchStudentsService;


class StudentAdapter implements StudentsInput{
    public function __construct(
        private readonly ListStudentsService $listService,
        private readonly SearchStudentsService $searchService,
    ){}

    public function listStudents( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->listService->execute();

        $code = count( $result )  > 0  ? 200 : 400 ;

        return $response->withJson($result)
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json');
    }

    public function searchByID( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->searchService->searchByID( $args['id'] );

        $code = count( $result )  > 0  ? 200 : 400 ;

        return $response->withJson($result)
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json');
    }

    public function searchByName( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->searchService->searchByName( $args['name'] );

        $code = count( $result )  > 0  ? 200 : 400 ;

        return $response->withJson($result)
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json');
    }
}

?>
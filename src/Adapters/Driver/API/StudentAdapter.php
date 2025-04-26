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

    /**
     * Lista todos os estudantes da aplicação.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function listStudents( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->listService->execute();
        $statusCode = 400;
        $arrayStudents = [];

        if( count( $result )  > 0 ){
            foreach ($result as $key => $studentEntity) {
                $arrayStudents[] = $studentEntity->toArray();
            }
        }

        return $response->withJson($arrayStudents)
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }

    public function searchByID( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->searchService->searchByID( $args['id'] );
        $statusCode = 400;
        $responseData = ['mensagem' => 'Estudante não encontrado.'];

        if( $result ){
            $responseData = $result->toArray();
            $statusCode = 200;
        }

        return $response->withJson($responseData)
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }

    public function searchByName( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->searchService->searchByName( $args['name'] );
        $statusCode = 400;
        $responseData = ['mensagem' => 'Nenhum estudante encontrado.'];

        if( count( $result )  > 0 ){
            $responseData = [];
            $statusCode = 200;

            foreach ($result as $key => $studentEntity) {
                $responseData[] = $studentEntity->toArray();
            }
        }

        return $response->withJson($responseData)
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }
}

?>
<?php

namespace Src\Adapters\Driver\API;

use Src\Core\Domain\Courses\Entities\CourseEntity;
use Psr\Http\Message\ResponseInterface as Response;

use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Application\Courses\InputPorts\ListCourseServicePort;
use Src\Core\Application\Courses\InputPorts\SearchCourseServicePort;

class CourseAdapter{
    public function __construct(
        private readonly ListCourseServicePort $listService,
        private readonly SearchCourseServicePort $searchService
    ){}

    /**
     * Lista todos os cursos da aplicação.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function listCourses( Request $request, Response $response, array $args=[] ): Response{
        $result = $this->listService->listCourses();
        $statusCode = 400;
        $arrayCourses = [];

        if( count( $result )  > 0 ){
            $statusCode = 200; 
            
            foreach ($result as $key => $courseEntity) {
                $arrayCourses[] = $courseEntity->toArray();
            }
        }

        return $response->withJson($arrayCourses)
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Busca curso por ID
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function searchByID( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->searchService->searchByID( $args['id'] );
        $statusCode = 400;
        $responseData = ['mensagem' => 'Curso não encontrado.'];

        if( $result ){
            $responseData = $result->toArray();
            $statusCode = 200;
        }

        return $response->withJson($responseData)
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Busca estudante por nome
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function searchByName( Request $request, Response $response, array $args=[] ) : Response{
        $result = $this->searchService->searchByName( $args['name'] );
        $statusCode = 400;
        $responseData = ['mensagem' => 'Nenhum curso encontrado.'];

        if( count( $result )  > 0 ){
            $responseData = [];
            $statusCode = 200;

            foreach ($result as $key => $courseEntity) {
                $responseData[] = $courseEntity->toArray();
            }
        }

        return $response->withJson($responseData)
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }
}

?>
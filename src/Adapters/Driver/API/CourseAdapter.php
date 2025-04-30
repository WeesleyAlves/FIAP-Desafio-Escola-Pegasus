<?php

namespace Src\Adapters\Driver\API;

use Src\Core\Domain\Courses\Entities\CourseEntity;
use Psr\Http\Message\ResponseInterface as Response;

use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Application\Courses\InputPorts\ListCourseServicePort;

class CourseAdapter{
    public function __construct(
        private readonly ListCourseServicePort $listCoursesService
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
        $result = $this->listCoursesService->listCourses();
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
}

?>
<?php
namespace Src\Adapters\Driver\API\Students;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Src\Core\Students\Application\InputPorts\SearchStudentServicePort;

class SearchStudentAdapter {
    public function __construct( private readonly SearchStudentServicePort $searchService ) {}

    public function execute(Request $request, Response $response, $args = []): Response {
        $statusCode = 400;
        $message = 'Nenhum estudante encontrado';
        $responseData = array();

        $students = $this->searchService->byName( $args['name'] ?? '' );

        if( count( $students ) > 0 ){
            $message = count( $students ).' estudante(s) encontrado(s)';
            $statusCode = 200;

            foreach ($students as $key => $student) {
                $responseData[] = array(
                    'nome' => $student->getName(),
                    'criadoEm' => $student->getCreatedAt(),
                    'registroAcademico' => $student->getAcademicRegistry(),
                    'id' => $student->getId(),
                );
            }
        }


        return $response->withJson([
            'code' => $statusCode,
            'mensagem' => $message,
            'data' => $responseData,
        ])
        ->withStatus($statusCode)
        ->withHeader('Content-Type', 'application/json');
    }
}
?>
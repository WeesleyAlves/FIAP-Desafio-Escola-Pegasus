<?php

namespace Src\Adapters\Driver\API\Students;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Students\Application\DTOs\CreateStudentDTO;
use Src\Core\Students\Application\InputPorts\CreateStudentServicePort;

class CreateStudentAdapter {
    public function __construct( private readonly CreateStudentServicePort $service ){}

    public function execute(Request $request, Response $response): Response{
        $statusCode = 500;
        $message = 'Falha ao criar estudante.';
        $responseData = array();

        $body = $request->getParsedBody();

        $dto = new CreateStudentDTO(
            $body['name'] ?? '',
            $body['phone'] ?? '',
            $body['email'] ?? '',
            $body['courseId'] ?? '',
        );

        $student = $this->service->execute( $dto );

        if( $student ){
            $message = 'Estudante criado com sucesso!';
            $statusCode = 200;

            $responseData = array(
                'id' => $student->getId(),
                'registroAcademico' => $student->getAcademicRegistry(),
                'nome' => $student->getName(),
                'criadoEm' => $student->getCreatedAt(),
            );
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
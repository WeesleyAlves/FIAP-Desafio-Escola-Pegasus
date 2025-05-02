<?php
namespace Src\Adapters\Driver\API\Students;

use Psr\Http\Message\ResponseInterface as Response;

use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Students\Application\DTOs\CreateStudentDTO;

use Src\Core\Students\Application\DTOs\UpdateStudentDTO;
use Src\Core\Students\Application\InputPorts\CreateStudentServicePort;
use Src\Core\Students\Application\InputPorts\DeleteStudentServicePort;
use Src\Core\Students\Application\InputPorts\SearchStudentServicePort;
use Src\Core\Students\Application\InputPorts\UpdateStudentServicePort;

class StudentAdapter {
    public function __construct(
        private readonly CreateStudentServicePort $createService,
        private readonly SearchStudentServicePort $searchService,
        private readonly DeleteStudentServicePort $deleteService,
        private readonly UpdateStudentServicePort $updateService,
    ) {}

    /**
     * Cria um novo estudante
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function createStudent( Request $request, Response $response ): Response{
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

        $student = $this->createService->execute( $dto );

        if( $student ){
            $message = 'Estudante criado com sucesso!';
            $statusCode = 200;

            $responseData = array(
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

    /**
     * Busca estudantes por nome;
     *
     * @return StudentEntity[]
     */
    public function searchStudentsByName( Request $request, Response $response, $args = [] ): Response{
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

    public function deleteStudent( Request $request, Response $response, $args = [] ): Response{
        $statusCode = 500;
        $message = 'Falha ao excluir estudante.';
        $responseData = array();

        if( $args['registryAcademic'] ){
            $deleted = $this->deleteService->execute( $args['registryAcademic'] );

            if( $deleted ){
                $statusCode = 200;
                $message = 'Estudante '. $args['registryAcademic'] .' excluído com sucesso!';
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

    public function updateStudent( Request $request, Response $response, $args = [] ): Response{
        $statusCode = 500;
        $message = 'Falha ao editar estudante.';
        $responseData = array();

        $body = $request->getParsedBody();

        $dto = new UpdateStudentDTO(
            $args['registryAcademic'] ?? '',
            $body['name'] ?? '',
            $body['phone'] ?? '',
            $body['email'] ?? '',
        );

        $result = $this->updateService->execute( $dto );

        if( $result ){
            $statusCode = 200;
            $message = 'Estudante editado com sucesso.';

            $contact = $result->getContact();

            $responseData = array(
                'nome' => $result->getName(),
                'telefone' => $contact->getPhone(),
                'email' => $contact->getEmail()
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
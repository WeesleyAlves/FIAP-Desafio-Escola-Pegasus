<?php
namespace Src\Core\Students\Application\InputPorts;

interface DeleteStudentServicePort {
    /**
     * Apaga o estudante
     *
     * @return boolean
     */
    public function execute( string $registryAcademic ): bool;
}

?>
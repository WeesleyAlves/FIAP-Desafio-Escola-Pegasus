<?php
namespace Src\Core\Students\Domain\ValueObjects;

class AcademicRegistryOV{
    private string $academicRegistry;

    public static function generate(): string{
        date_default_timezone_set('America/Sao_Paulo');
        $academicRegistry = date('YmdGis');
        return $academicRegistry;
    }
}

?>
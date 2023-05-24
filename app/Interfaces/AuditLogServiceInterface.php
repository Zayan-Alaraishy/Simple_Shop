<?php
namespace App\Interfaces ;

interface AuditLogServiceInterface {
    public function create (array $data);
    public function getById($id);
    public function getAll(array $filters);
}
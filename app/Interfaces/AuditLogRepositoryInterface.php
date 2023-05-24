<?php
namespace App\Interfaces ;

interface AuditLogRepositoryInterface {
    public function create (array $data);
    public function getById($id);
    public function getAll(array $filters);
}
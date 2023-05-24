<?php

namespace App\Services;

use App\Interfaces\AuditLogRepositoryInterface;
use App\Interfaces\AuditLogServiceInterface;
use App\Models\AuditLog;

class AuditLogService implements AuditLogServiceInterface
{
    public function __construct(public AuditLogRepositoryInterface $auditLogRepository)
    {
        
    }
    public function create(array $data)
    {
        return $this->auditLogRepository->create($data);
    }

    public function getById($id)
    {
        return  $this->auditLogRepository->getById($id);
    }

    public function getAll(array $filters)
    {
        return  $this->auditLogRepository->getAll($filters);
    }
}
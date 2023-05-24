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
        $user = isset($filters['user']) && !empty($filters['user'])? $filters['user']: null;
        $model = isset($filters['model']) && !empty($filters['model'])? $filters['model']: null;
        $event = isset($filters['event']) && !empty($filters['event'])? $filters['event']: null;

        return  $this->auditLogRepository->getAll(compact('user', 'model', 'event'));
    }
}
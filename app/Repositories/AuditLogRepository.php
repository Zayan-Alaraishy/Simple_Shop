<?php

namespace App\Repositories;

use App\Interfaces\AuditLogRepositoryInterface;
use App\Models\AuditLog;

class AuditLogRepository implements AuditLogRepositoryInterface
{
    public function create(array $data)
    {
        return AuditLog::create($data);
    }

    public function getById($id)
    {
        return AuditLog::findOrFail($id);
    }

    public function getAll(array $filters)
    {
        $user = isset($filters['user']) && !empty($filters['user'])? $filters['user']: null;
        $model = isset($filters['model']) && !empty($filters['model'])? $filters['model']: null;
        $event = isset($filters['event']) && !empty($filters['event'])? $filters['event']: null;

        return AuditLog::query()
            ->orderBy('created_at', 'desc')
            ->when($user, fn($query) => $query->where('user_id', $user))
            ->when($model, fn($query) => $query->where('model_type', 'App\Models\\'. $model))
            ->when($event, fn($query) => $query->where('event', $event))
            ->with('user')
            ->get();
        }
}
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
        $user = $filters['user'];
        $model = $filters['model'];
        $event = $filters['event'];

        return AuditLog::query()
            ->orderBy('created_at', 'desc')
            ->when($user, fn($query) => $query->where('user_id', $user))
            ->when($model, fn($query) => $query->where('model_type', 'App\Models\\'. $model))
            ->when($event, fn($query) => $query->where('event', $event))
            ->with('user')
            ->get();
    }
}
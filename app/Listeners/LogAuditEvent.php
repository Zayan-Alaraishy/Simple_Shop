<?php

namespace App\Listeners;

use App\Models\AuditLog;
use App\Events\AuditEvent;
use App\Interfaces\AuditLogServiceInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogAuditEvent implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct(public AuditLogServiceInterface $auditLogService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuditEvent $event): void
    {
        $oldValues = $event->original;
        $newValues = $event->model->getAttributes();
        $user = auth()->user();

        $this->auditLogService->create([
            'event' => $event->eventType,
            'model_type' => get_class($event->model),
            'model_id' => $event->model->getKey(),
            'old_values' => $event->eventType == 'update'? $oldValues: null,
            'new_values' => $newValues,
            'user_id' => $user ? $user->id : null,
        ]);
    }
}

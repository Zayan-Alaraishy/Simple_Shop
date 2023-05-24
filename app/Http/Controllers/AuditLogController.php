<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\AuditLogServiceInterface;
use Spatie\ModelInfo\ModelFinder;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public AuditLogServiceInterface $auditLogService) { }
    
    public function index(Request $request)
    {
        $auditLogs = $this->auditLogService->getAll($request->all());
        $users = User::all();
        $models = ModelFinder::all();
        // dd($models); 

        return view('audit_logs', compact('auditLogs', 'users', 'models'));
    }
}

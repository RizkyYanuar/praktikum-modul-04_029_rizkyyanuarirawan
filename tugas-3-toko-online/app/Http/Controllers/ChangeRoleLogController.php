<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChangeRoleLog;
use Illuminate\Http\Request;

class ChangeRoleLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ChangeRoleLog::with(['user', 'targetUser'])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.change-role-logs', compact('logs'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\RoleManagementService;
use App\Http\Requests\ChangeRoleRequest;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.manage-roles', compact('users'));
    }
    
    public function update(
        ChangeRoleRequest $request,
        User $user,
        RoleManagementService $service
    ): RedirectResponse {
        $data = $request->validated();
        $service->changeRole($request->user(), $user, $data['role']);
        return back()->with('status', 'Role diperbarui.');
    }
}

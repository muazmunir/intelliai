<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private $userRepository;

    private $roleRepository;

    public function __construct(UserInterface $userInterface, RoleInterface $roleInterface)
    {
        $this->userRepository = $userInterface;

        $this->roleRepository = $roleInterface;
    }

    public function index(): View
    {
        $pageTitle = 'Users';

        return view('admin.users.index', compact('pageTitle'));
    }

    public function dataTable(): JsonResponse
    {
        return $this->userRepository->getDataTable();
    }

    public function create(): View
    {
        $pageTitle = 'Add user';

        $roles = $this->roleRepository->getRoles();

        $user = null;

        return view('admin.users.form', compact('pageTitle', 'roles', 'user'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->userRepository->saveUser($request);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function edit($id): View
    {
        $pageTitle = 'Add user';

        $user = $this->userRepository->getUser($id);

        $roles = $this->roleRepository->getRoles();

        $userRole = $this->roleRepository->getUserRoles($id);

        return view('admin.users.form', compact('pageTitle', 'user', 'roles', 'userRole'));
    }
}

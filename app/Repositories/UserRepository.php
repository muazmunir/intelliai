<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class UserRepository implements UserInterface
{
    private $user;

    private $datatables;

    private $hash;

    public function __construct()
    {
        $this->user = new User();
        $this->datatables = new Datatables;
        $this->hash = new Hash;
    }

    public function getDataTable()
    {
        if (isSuperAdmin()) {
            $query = $this->user->query();
        } else {
            $query = $this->user->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'Super Admin');
            });
        }

        return $this->datatables->of($query)
            ->addColumn('action', function ($user) {
                $action = '<ul class="action">';
                $action .= '<li class="edit"><a href="'. route('users.edit', $user->id) .'"><i class="icon-pencil-alt"></i></a></li>';
                $action .= '<li class="delete"><a href="#"><i class="icon-trash"></i></a></li>';
                $action .= '</ul>';
                return $action;
            })
            ->addColumn('name', function ($user) {
                return $user->full_name;
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;

                return $i;
            })
            ->rawColumns(['action', 'photo', 'name'])
            ->toJson();
    }

    public function saveUser($request)
    {
        $input = $request->all();
        $input['password'] = $this->hash::make($input['password']);
        $user = $this->user->create($input);
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }
        return $user;
    }

    public function getUser($user_id)
    {
        return $this->user->find($user_id);
    }
}

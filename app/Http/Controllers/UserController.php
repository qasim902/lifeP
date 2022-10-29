<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request,$flash = null)
    {
        $users = User::get();
        if($flash){
            $request->session()->flash('flash.banner', $flash);
        }
        return Inertia::render('Users/List',['users' => $users]);
    }

    public function addOrEditOrder(UserRequest $request)
    {
        if ($request->has('id')) {
            return $this->update($request);
        } else {
            return $this->store($request);
        }
    }

    public function store($request)
    {
        $this->userService->saveUser($request->all());
        return $this->index($request,'Added Successfully');
    }

    public function show($id = null)
    {
        return $this->userService->showForm($id);
    }

    public function update($request)
    {
        $this->userService->updateUser($request->input('id'), $request->all());
        return $this->index($request,'Updated Successfully');
    }

    public function delete(Request $request, $id)
    {
        $this->userService->deleteUser($id);
        return $this->index($request,'Deleted Successfully');

    }

}

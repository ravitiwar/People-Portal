<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    protected $userModel;

    function __construct(User $user)
    {
        $this->userModel = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success($this->userModel->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $employeeRequest)
    {
        return User::create(array_merge($employeeRequest->only([
            'name',
            'email',
            'emp_id',
            'position',
            'team',
            'role_id',
            'phone'
        ]), [
            'password' => Hash::make($employeeRequest->get('password')),
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $employeeRequest, $id)
    {
        try {
            User::findOrFail($id)->update(array_merge($employeeRequest->only([
                'name',
                'email',
                'position',
                'team',
                'phone'
            ]), [
                'role_id' => $employeeRequest->get('roleId'),
                'emp_id' => $employeeRequest->get('empId')
            ]));
            return response()->success([], "Employee Updated");
        } catch (\Exception $e) {
            return response()->fail([], "Employee Could not be updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::findOrFail($id)->destroy($id);
            return response()->success([], "Employee deleted");
        } catch (\Exception $e) {
            return response()->fail([], "Employee Could not be deleted");
        }
    }
}

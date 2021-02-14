<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleModel;

    function __construct(Role $role)
    {
        $this->roleModel = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success($this->roleModel->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        return response()->success(
            $this->roleModel->create([
                'title' => $request->get('title'),
                'capabilities' => json_encode($request->get('capabilities'))
            ])
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            return response()->success(
                $this->roleModel->findOrFail($id)->update([
                    'title' => $request->get('title'),
                    'capabilities' => json_encode($request->get('capabilities'))
                ]),
                "Role updated"
            );
        } catch (\Exception $exception) {
            return response()->fail([], "Role not found");
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
            $this->roleModel->findOrFail($id)->destroy($id);
            return response()->success([], "Role Deleted");
        } catch (\Exception $e) {
            return response()->success([], "Role Does Not found");
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest as EntityRequest;
use App\Repositories\User\UserRepositoryInterface as EntityRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Models\User as Entity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Exception;

class UserController extends BaseController
{
    public function __construct(EntityRepositoryInterface $entityRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->module = 'users';
        $this->repository = $entityRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies($this->module . '_access'), 403);
        try {
            list($results, $summary) = $this->repository->list($request);
            $data =  [
                'results' => $results,
                'summary' => $summary,
                'module'  => $this->module,
            ];
            return view('backend.' . $this->module . '.index', $data);
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function create()
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        return view('backend.' . $this->module . '.create', $this->formData(new Entity()));
    }

    public function store(EntityRequest $request)
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        try {
            $entity = $this->repository->create($this->getDataRequest($request));
            $entity->roles()->sync($request->input('roles', []));
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function edit(Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        return view('backend.' . $this->module . '.edit', $this->formData($entity));
    }

    public function update(EntityRequest $request, Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        try {
            if ($entity->type_user=='admin') {
                return redirect()->back()->with('resp_error', 'Không thể sửa tài khoản Admin');
            }
            $this->repository->update($this->getDataRequest($request, $entity), $entity->id);
            $entity->roles()->sync($request->input('roles', []));
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function changeStatus(Request $request)
    {
        return parent::changeStatus($request);
    }

    public function delete(Request $request)
    {
        $adminUsers = $this->repository->whereIn('id', $request->ids)->where('type_user', 'admin')->pluck('id')->toArray();
        if (!empty($adminUsers)) {
            $status = 'error';
            $msg = 'Không thể xóa tài khoản Admin';
            return response()->json(['status' => $status, 'msg' => $msg]);
        }
        return parent::bulkDelete($request);
    }

    public function changeProfile(){
        $data['result'] = auth()->user();
        $data['module'] = $this->module;
        return view('backend.'.$this->module.'.change_profile', $data);
    }

    public function postChangeProfile(EntityRequest $request){
        try{
            $this->repository->where('id', auth()->user()->id)->update(['name' => $request->name,'desc' => $request->desc]);
        } catch (\Exception $ex) {
             parent::ProcessException($ex);
        } 
        return redirect()->route('admin.changeProfile')->with('resp_success', 'Thực hiện thao tác thành công');
    }

    public function changePassword(){
        $data['module'] = $this->module;
        return view('backend.'.$this->module.'.change_password', $data);
    }

    public function postChangePassword(EntityRequest $request){
        try{
            $userLoginId   = auth()->user()->id;
            $password  = $request->password;
            $this->repository->where('id', $userLoginId)->update(['password' => bcrypt($password)]);
        } catch (\Exception $ex) {
             parent::ProcessException($ex);
        } 
        return redirect()->route('admin.changePassword')->with('resp_success', 'Thực hiện thao tác thành công');
    }

    protected function getDataRequest($request, $entity = null)
    {
        $data = [
            'name'          => $request->name,
            'desc'          => $request->desc,
            'email'         => $request->email,
            'password'      => $request->password,
            'active'        => $request->active ?? false,
            'order'         => $request->order ?? 0
        ];

        if(!$request->password){
            unset($data['password']);
        }
        return $data;
    }

    private function formData(Entity $entity)
    {
        $roles = $this->roleRepository->all();
        return [
            'result'          => $entity,
            'roles'           => $roles,
            'module'          => $this->module
        ];
    }
}
<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\ProcessException;
use App\Traits\FileManager; 
use App\Traits\AuditLog;
class BaseController extends Controller
{
    use FileManager,AuditLog;

    protected $repository;
    protected $module;

    /**
     * Xử lý ngoại lệ.
     */
    protected function processException($ex)
    { 
        throw new ProcessException($ex);
    }

    /**
     * Toggle status (1 ↔ 0) của các bản ghi theo ID.
     */
    public function changeStatus(Request $req)
    {
        try {
            $status = 'deny_permission';
            $msg = 'Không có quyền thực hiện thao tác';

            if (!Gate::denies($this->module . '_show')) {
                $results = $this->repository->whereIn('id', $req->ids)->select('id', 'active')->get();
                if ($results->isNotEmpty()) {
                    foreach ($results as $result) {
                        $new_active = $result->active == 1 ? 0 : 1;
                        $this->repository->update(['active' => $new_active], $result->id);
                    }
                }
                $status = 'success';
                $msg = 'Thực hiện thao tác thành công';
            } else {
                $status = 'warning';
                $msg = 'Không có quyền thực hiện thao tác';
            }
        } catch (\Exception $ex) {
            $status = 'error';
            $msg = 'Thực hiện thao tác không thành công';
            throw new ProcessException($ex);
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    /**
     * Xóa hàng loạt các bản ghi theo ID.
     */
    public function bulkDelete(Request $req)
    {
        try {
            $status = 'deny_permission';
            $msg = 'Không có quyền thực hiện thao tác';

            if (!Gate::denies($this->module . '_delete')) {
                $this->repository->whereIn('id', $req->ids)->delete();
                $status = 'success';
                $msg = 'Thực hiện thao tác thành công';
            } else {
                $status = 'warning';
                $msg = 'Không có quyền thực hiện thao tác';
            }
        } catch (\Exception $ex) {
            $status = 'error';
            $msg = 'Thực hiện thao tác không thành công';
            throw new ProcessException($ex);
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }
}

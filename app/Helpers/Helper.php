<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Setting;
use Hash, Auth, Session, DB, File;
use App\Models\AuditLog;
use App\Traits\FileManager;

class Helper{

    use FileManager;

    # Theo dõi log thay đổi
    public static function auditLog($data){
        if (config('constants.save_log') == true) {
            $data['user_id']    = Auth::user()->id;
            $data['ip']         = request()->ip();
            AuditLog::create($data);
        }
    }

    # Theo dõi lỗi phát sinh
    public static function trackingError($params)
    {
        $module = $params['module'];
        $action = $params['action'];
        $msg_log = $params['msg_log'];

        if($action==null){
            $action = request()->route()->getActionMethod() ?? "undefine";
        }
        config([
            'logging.channels.custom_error' => [
                'driver' => 'daily',
                'path' => storage_path("logs/custom_error/custom_error.log"),
                'level' => 'error',
                'days' => 365
            ]
        ]);

        Log::channel('custom_error')->error($module.'_'.$action.":".$msg_log);
    }

    public static function createSlug($name, $url, $condition = array())
    {
        $slug = Str::slug($url);
        if (empty($slug)) {
            $slug = Str::slug($name);
        }
        return $slug;
    }

    public static function getModules(){
        
        # Init label
        $list_label = 'Danh sách';
        $create_label = 'Thêm';
        $edit_label = 'Chỉnh sửa';
        $delete_label = 'Xóa';
        $change_status_label = 'Thay đổi trạng thái';
        $view_label = 'Xem thông tin';

        # Modules
        $modules['permissions']['name'] = 'Quyền';
        $modules['permissions']['active'] = true;
        $modules['permissions']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['permissions']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['permissions']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['permissions']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['permissions']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['permissions']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['roles']['name'] = 'Vai trò';
        $modules['roles']['active'] = true;
        $modules['roles']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['roles']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['roles']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['roles']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['roles']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['roles']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['users']['name'] = 'Tài khoản';
        $modules['users']['active'] = true;
        $modules['users']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['users']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['users']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['users']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['users']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['users']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['article_categories']['name'] = 'Danh mục';
        $modules['article_categories']['active'] = true;
        $modules['article_categories']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['article_categories']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['article_categories']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['article_categories']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['article_categories']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['article_categories']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['articles']['name'] = 'Bài viết';
        $modules['articles']['active'] = true;
        $modules['articles']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['articles']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['articles']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['articles']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['articles']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['articles']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['banners']['name'] = 'Banner';
        $modules['banners']['active'] = true;
        $modules['banners']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['banners']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['banners']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['banners']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['banners']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['banners']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['menus']['name'] = 'Menu';
        $modules['menus']['active'] = true;
        $modules['menus']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['menus']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['menus']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['menus']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['menus']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['menus']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['documents']['name'] = 'Văn bản';
        $modules['documents']['active'] = true;
        $modules['documents']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['documents']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['documents']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['documents']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['documents']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['documents']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['info_documents']['name'] = 'Thông tin Văn bản';
        $modules['info_documents']['active'] = true;
        $modules['info_documents']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['info_documents']['actions'][] = ['slug' => 'create', 'name' => $create_label];
        $modules['info_documents']['actions'][] = ['slug' => 'edit', 'name' => $edit_label];
        $modules['info_documents']['actions'][] = ['slug' => 'delete', 'name' => $delete_label];
        $modules['info_documents']['actions'][] = ['slug' => 'change_status', 'name' => $change_status_label];
        $modules['info_documents']['actions'][] = ['slug' => 'show', 'name' => $view_label];

        $modules['settings']['name'] = 'Cài đặt';
        $modules['settings']['actions'][] = ['slug' => 'access', 'name' => $list_label];
        $modules['settings']['actions'][] = ['slug' => 'create', 'name' => $create_label];

        return $modules;
    }

    public static function getNameDay($date){
        $name_vi = array(
            'Sunday'    => 'CN',
            'Monday'    => 'T2',
            'Tuesday'   => 'T3',
            'Wednesday' => 'T4',
            'Thursday'  => 'T5',
            'Friday'    => 'T6',
            'Saturday'  => 'T7'
        );
        $name =  Carbon::parse($date)->format('l');
        return $name_vi[$name];
    }

    public static function getSetting($key, $default = null){
        if (is_null($key)) {
            return new Setting();
        }
        
        if (is_array($key)) {
            return Setting::set($key[0], $key[1]);
        }

        $value = Setting::get($key);
        return is_null($value) ? value($default) : $value;
    }

    public static function getStatus(){
        return array(
            'inactive'  => ['name' => 'Không hoạt động', 'color' => 'danger'],
            'active'    => ['name' => 'Đang hoạt động', 'color' => 'success'],
        );
    }

    /**
     * $gallery = YourClass::combineFields(
     *      [$images, $descs, $orders],
     *      ['src', 'desc', 'order']
     * );
     */
    public static function combineFields($fields, $keys)
    {
        $data = [];
        $count = count(reset($fields));
        foreach ($fields as $f) {
            if (count($f) !== $count) {
                throw new \Exception("Các mảng truyền vào không cùng độ dài.");
            }
        }
        for ($i = 0; $i < $count; $i++) {
            foreach ($keys as $key => $fieldName) {
                $data[$i][$fieldName] = $fields[$key][$i] ?? "";
            }
        }
        return $data;
    }
}
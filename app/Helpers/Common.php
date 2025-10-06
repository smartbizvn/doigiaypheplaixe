<?php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Log;
    use App\Helpers\Shortcode;
    use Illuminate\Support\Facades\Response;

    /**
     * Hàm chuyển đổi format date sang định ngày ngày việt nam
     */
    if(!function_exists('formatDate')){
        function formatDate($date){
            $arr_date = explode('/',$date);
            $new_date = $arr_date[1].'/'.$arr_date[0].'/'.$arr_date[2];
            return $new_date;
        }
    }

    /**
     * convert datetime to date string
     */
    if(!function_exists('viewDate')){
        function viewDate($date){
            return date('d/m/Y',strtotime($date));
        }
    }
    
    /**
     * Convert datetime to datetime string
     */
    if(!function_exists('viewDateTime')){
        function viewDateTime($date){
            return date('d/m/Y H:i:s',strtotime($date));
        }
    }
    
    /**
     * Hàm view hình ảnh, nếu không tồn tại ảnh load hình mặc định
     */
    if(!function_exists('viewImage')){
        function viewImage($src){
            $file      = public_path('/').$src;
            $srcImage  = File::exists($file) && !empty($src)? $src: config('constants.thumnail_default');
            return asset($srcImage);
        }
    }

    if (!function_exists('downloadFile')) {
        function downloadFile($src, $downloadName = null)
        {
            $file      = public_path('/').$src;
            $srcImage  = File::exists($file) && !empty($src)? $src: null;
            return asset($srcImage);
        }
    }

    if (!function_exists('getExtFile')) {
        function getExtFile($file_name)
        {
            if($file_name != null){
                $parts = explode('.', $file_name);
                $extension = end($parts);
                return $extension;
            }else{
                return '';
            }

        }
    }

    if(!function_exists('hashName')) {
        function hashName(string $prefix = '')
        {
            return ($prefix ? $prefix . '_' : '') . date('ymd') . "_" . randomNumber(20);
        }
    }

    # Hàm tạo table tạm để sử dụng PostgreSQL CTE
    if (!function_exists('createTempTable')) {
        function createTempTable($data){
            if (count($data) > 0) {
                $key = implode(",", array_keys($data[0]));
                $sql = "WITH temp(" . $key . ") as ( values ";
                foreach ($data as $key => $value) {
                    if (count($value) == 0) continue;
                    $sub = "(";
                    foreach ($value as $key => $col) {
                        if (gettype($col) === "string") {
                            $col = "'" . addslashes($col) . "'";
                        }
                        $sub = $sub . $col . ",";
                    }
                    $sub = trim($sub, ',');
                    $sub = $sub . '),';
                    $sql = $sql . $sub;
                }
                $sql = trim($sql, ',') . "),";
                return $sql;
            }
        }
    }

    # Hàm log câu truy vấn sql
    if(!function_exists('logQuery')){
        function logQuery($query)
        {
            Log::info($query->toSql());
        }
    }

    # Hàm hiển thị câu truy vấn
    if(!function_exists('getQuery')){
        function getQuery($query)
        {
            $addSlashes = str_replace('?', "'?'", $query->toSql());
            return vsprintf(str_replace('?', '%s', $addSlashes), $query->getBindings());
        }
    }
    
    /**
     * Hàm get thông tin cấu hình setting - Models setting
     */
    if (! function_exists('getSetting')) {
        function getSetting($key, $default = null){
            if (is_null($key)) {
                return new App\Models\Setting();
            }
            
            if (is_array($key)) {
                return App\Models\Setting::set($key[0], $key[1]);
            }

            $value = App\Models\Setting::get($key);
            return is_null($value) ? value($default) : $value;
        }
    }

    if (!function_exists('randomCode')) {
        function randomCode($length = 10)
        {
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            return $randomString;
        }
    }

    if (!function_exists('hashFileName')) {
        function hashFileName($fileName)
        {
            $arr_part = explode('.',$fileName);
            $extension = end($arr_part);
            return randomCode().'_'.date('YdHis').'_'.time().'.'.$extension;
        }
    }

    if (!function_exists('deleteFile')) {
        function deleteFile($filePath, $disk = 'public')
        {
            if (Storage::disk($disk)->exists($filePath)) {
                Storage::disk($disk)->delete($filePath);
            }
        }
    }

    if (!function_exists('deleteFolder')) {
        function deleteFolder($folderPath, $disk = 'public')
        {
            if (Storage::disk($disk)->exists($folderPath)) {
                Storage::disk($disk)->deleteDirectory($folderPath);
            }
        }
    }
    
    if (!function_exists('getStartDateEndDate')) {
        function getStartDateEndDate($rangeDate)
        {
            $rangeDate = explode(" - ", $rangeDate);
            $startDate = date("Y-m-d 00:00:00", strtotime($rangeDate[0]));
            $endDate   = date("Y-m-d 23:59:59", strtotime($rangeDate[1]));
            return array($startDate, $endDate);
        }
    }

    if (!function_exists('dateNow')) {
        function dateNow()
        {
            return date('Y-m-d H:i:s');
        }
    }

    if (!function_exists('baseURL')) {
        function baseURL()
        {
            return URL::to('/');
        }
    }

    if (!function_exists('cutText')) {
        function cutText(?string $text, int $limit = 120, string $end = '...'): string
        {
            $text = trim(strip_tags($text ?? ''));
            if (mb_strlen($text) <= $limit) {
                return $text;
            }
            $cut = mb_substr($text, 0, $limit);
            $lastSpace = mb_strrpos($cut, ' ');
            if ($lastSpace !== false) {
                $cut = mb_substr($cut, 0, $lastSpace);
            }
            return $cut . $end;
        }
    }


    if (!function_exists('getAction')) {
        function getAction()
        {
            $routeArray = app('request')->route()->getAction();
            $controllerAction = class_basename($routeArray['controller']);
            list($module, $action) = explode('@', $controllerAction);
            return $module."_".$action;
        }
    }

    # Lấy thông tin chi tiết ngoại lệ trả về
    if (!function_exists('getMessage')) {
        function getMessage($e)
        {
            try {
                $message = PHP_EOL;
                $message .= "Message: ".$e->getMessage() .PHP_EOL;
                $message .= "File: ".$e->getFile() .PHP_EOL;
                $message .= "Line: ".$e->getLine() .PHP_EOL;
                $message .= "Params: ".request()->getQueryString() .PHP_EOL;
                return $message; 
            } catch (\Throwable $e) {
                return null;
            }
        }
    }

    if (!function_exists('parseShortcodes')) {
        function parseShortcodes($content)
        {
            $shortcode = app(Shortcode::class); // Lấy từ Service Container
            // [slider id=5]
            $content = preg_replace_callback('/\[slider\s+id=(\d+)\]/', function ($matches) use ($shortcode) {
                return $shortcode->renderSlider($matches[1]);
            }, $content);

            // [video id=3]
            $content = preg_replace_callback('/\[video\s+id=(\d+)\]/', function ($matches) use ($shortcode) {
                return $shortcode->renderVideo($matches[1]);
            }, $content);

            return $content;
        }
    }

    if (!function_exists('getTitle')) {
        function getTitle($data, $key = 'name')
        {
            $title =  $data->$key;
            if(!empty($data->meta_title)){
                $title =  $data->meta_title;
            }
            return $title;
        }
    }

    if (!function_exists('getDesc')) {
        function getDesc($data, $key = 'desc')
        {
            $desc =  $data->$key;
            if(!empty($data->meta_desc)){
                $meta_desc =  $data->meta_desc;
            }
            return $desc;
        }
    }

    if (!function_exists('datePost')) {
        function datePost($date)
        {
            return Carbon::parse($date)->format('d/m/Y - H:i');
        }
    }

    
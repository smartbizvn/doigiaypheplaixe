<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;

trait FileManager
{
    /* Upload One File */
    public static function uploadFile($file, $dirUpload, $extensionAllow = ['png','jpg','gif','jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', 'txt', 'ppt', 'pptx'], $sizeLimit = 2, $disk = 'public')
    {
        $respData = ['status' => 'error'];
        if ($file !== null) {
            $extFile   = strtolower($file->getClientOriginalExtension());
            $sizeFile  = $file->getSize() / 1024 / 1024; // MB
            $nameOrgin = $file->getClientOriginalName();
            $nameHash  = hashFileName($nameOrgin);
            if (!in_array($extFile, $extensionAllow)) {
                $respData['message'] = 'errorType';
                return $respData;
            }
            if ($sizeFile > $sizeLimit) {
                $respData['message'] = 'errorSize';
                return $respData;
            }

            $baseFolder = 'uploads';
            $monthYear  = sprintf('%02d', date('m')) . '_' . date('Y');
            $dirPath    = trim($baseFolder . '/' . $dirUpload . '/' . $monthYear, '/');

            if (!Storage::disk($disk)->exists($dirPath)) {
                Storage::disk($disk)->makeDirectory($dirPath);
            }

            $path = Storage::disk($disk)->putFileAs($dirPath, $file, $nameHash);

            if ($path) {
                $respData = [
                    'status'    => 'success',
                    'name_orgin' => $nameOrgin, # Tên file gốc  
                    'name_hash'  => $nameHash, # Tên file hash
                    'link_file'  => "/storage/" . ltrim($path, '/'), # Đường dẫn file
                    'size_file'  => round($sizeFile, 2), # Kích thước file
                    'ext_file'   => $extFile # Loại file
                ];
            }
        }
        return $respData;
    }


    /* Upload Multi File */
    public static function uploadMultipleFiles($files, $dirUpload, $extensionAllow = ['png','jpg','gif','jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', 'txt', 'ppt', 'pptx'], $sizeLimit = 2, $disk = 'public')
    {
        $results = [
            'success' => [],
            'error'   => [],
        ];
     
        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $upload = self::uploadFile($file, $dirUpload, $extensionAllow, $sizeLimit, $disk);

                if ($upload['status'] === 'success') {
                    $results['success'][] = $upload;
                } else {
                    $results['error'][] = [
                        'name'    => $file->getClientOriginalName(),
                        'message' => $upload['message'] ?? 'unknown',
                    ];
                }
            } else {
                $results['error'][] = [
                    'name'    => 'unknown',
                    'message' => 'invalid file',
                ];
            }
        }
        return $results;
    }
}
?>
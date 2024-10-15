<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Images;


/**
 *
 */
trait StorageImageTrait
{
    /*
     store image upload and return null || array
     @param
     $request type Request, data input
     $fieldName type string, name of field input file
     $folderName type string; name of folder store
     return array
     [
         "file_name","file_path"
     ]
    */
    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        // dd($request->$fieldName, $request->hasFile($fieldName));
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            return $this->handleFile($file, $folderName);
        } else {
            return null;
        }
    }

    // lấy theo mảng
    // $i là chỉ số mảng file
    public function storageTraitUploadMutipleArray($request, $fieldName, $i, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            if (count($request->$fieldName) >= $i + 1) {
                $file = $request->$fieldName[$i];
                return $this->handleFile($file, $folderName);
            }
        } else {
            return null;
        }
    }

    /*
     store image multiple upload and return null || array
     @param
     $file type Request->file(), data input
     $folderName type string; name of folder store
     return array
     [
         "file_name","file_path"
     ]
    */


    public function storageTraitUploadMutiple($file, $folderName)
    {
        return $this->handleFile($file, $folderName);
    }

    // kieemr tra su ton tai file
    public function checkFile($filePath)
    {
        $isExists = Storage::exists($filePath);
        return $isExists;
    }

    // convert link file to file goc trong storage
    public function makePathOrigin($path)
    {
        $path = Str::after($path, '/storage');
        return 'public' . $path;
    }


    public function handleFile($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNamNotExtension = pathinfo($fileNameOrigin, PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();

        // Tạo hình ảnh từ tệp đã tải lên
        $image = Image::make($file);

        $width = $image->width();
        $height = $image->height();

        $image = $image->resize($width * 100 / 100, $height * 100 / 100);

        // Tạo tên tệp mới với phần mở rộng là .webp
        // $fileNameHash = $fileNamNotExtension . '.webp';
        $fileNameHash = $fileNamNotExtension . '_' . time() . '.webp';

        // Lưu hình ảnh với mức chất lượng hiện tại
        $image->save(storage_path("app/public/{$folderName}/{$fileNameHash}"));

        // Lấy dung lượng của ảnh sau khi đã giảm dung lượng
        $newFileSize = ceil(Storage::size("public/{$folderName}/{$fileNameHash}"));

        // Lấy dung lượng của ảnh trước khi giảm dung lượng
        $originalFileSize = ceil($file->getSize());

        $dataUploadTrait = [
            "file_name" => $fileNamNotExtension,
            "file_path" => Storage::url("public/{$folderName}/{$fileNameHash}"),
            "original_file_size" => $originalFileSize,
            "new_file_size" => $newFileSize,
            // "quality" => $quality, // Chất lượng cuối cùng của ảnh
        ];

        return $dataUploadTrait;
    }

    // public function handleFile($file, $folderName)
    // {
    //     $fileNameOrigin = $file->getClientOriginalName();
    //     $fileNamNotExtension = pathinfo($fileNameOrigin, PATHINFO_FILENAME);
    //     $fileExtension = $file->getClientOriginalExtension();

    //     // Giảm dung lượng ảnh và chuyển đổi sang định dạng WebP
    //     $image = Images::make($file)->encode('webp', 30); // Giảm chất lượng xuống 30%

    //     $fileNameHash = $fileNamNotExtension . '.webp';
    //     $fileSize = ceil($image->filesize()); // Lấy dung lượng của ảnh sau khi đã được giảm dung lượng

    //     $i = 1;
    //     $filePathCheck = "public/" . $folderName . "/" . auth()->id() . "/" . $fileNameOrigin;

    //     while ($this->checkFile($filePathCheck)) {
    //         $fileNameHash = $fileNamNotExtension . "_" . $i . "." . $fileExtension;
    //         $filePathCheck = "public/" . $folderName . "/" . auth()->id() . "/" . $fileNameHash;
    //         $i++;
    //     }

    //     // Lưu ảnh đã được giảm dung lượng và chuyển đổi định dạng
    //     $filePath = $image->save(storage_path('app/public/' . $folderName . '/' . auth()->id() . '/' . $fileNameHash));

    //     $dataUploadTrait = [
    //         "file_name" => $fileNamNotExtension,
    //         "file_path" => Storage::url($filePath),
    //         "file_size" => $fileSize,
    //     ];

    //     return $dataUploadTrait;
    // }
}

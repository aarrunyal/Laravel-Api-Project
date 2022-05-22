<?php
namespace App\Services\Traits;


use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

trait ManageStorage{

      public $uploadPath = "uploads";


      public function uploadFile(UploadedFile $file, $uploadPath){
                  $uploadPath = public_path($uploadPath);
                  if(!is_dir($uploadPath))
                        mkdir($uploadPath, 0777, true);
                  $fileName = Carbon::now()->timestamp.".".$file->getClientOriginalExtension();
                  $file->move($uploadPath, $fileName);

                  return $fileName;
            }


      public function deleteFile($fileName, $uploadPath){
            $filePath = public_path($uploadPath)."/".$fileName;
            if(is_file($filePath)){
             return     unlink($filePath);
            }
            return true;
      }

}

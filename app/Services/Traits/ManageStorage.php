<?php
namespace App\Services\Traits;


use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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


      public function uploadBase64Image($binaryImage, $uploadPath){
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $binaryImage);
            $type = explode('/', $binaryImage)[1];
            $file_type = !empty($title) ? explode(".", $title)[1] : explode(';', $type)[0];
            $uploadPath = public_path($uploadPath);
            if(!is_dir($uploadPath))
                  mkdir($uploadPath, 0777, true);
            $fileName = Carbon::now()->timestamp.".".$file_type;
            $uploadPath = $uploadPath."/".$fileName;
            file_put_contents($uploadPath, base64_decode($img));
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

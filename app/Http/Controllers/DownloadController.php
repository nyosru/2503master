<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{

    public function download($id, $file_name)
    {

        // Получаем из БД путь к файлу и оригинальное имя
        $file = FileUpload::whereFileName($file_name)->where('id', $id)->firstOrFail();

//        dd($file->toArray());

//        $s3Path = $file->path; // путь в бакете, например "uploads/1234567890abcdef"
        $s3Path = $file->s3_path; // путь в бакете, например "uploads/1234567890abcdef"
        $originalName = $file->file_name; // оригинальное имя, например "invoice.pdf"

        // Получаем содержимое файла из S3
        $stream = Storage::disk('s3beget')->readStream($s3Path);

        $mime = Storage::disk('s3beget')->mimeType($s3Path);

//        //    dd($mime);
//        if (strpos($mime, 'image') !== false) {
////dd(__LINE__);
//            // Отдаём файл с нужным именем
//            return response()->streamDownload(function () use ($stream) {
//                fpassthru($stream);
//            }, $originalName, [
//                'Content-Type' => $mime,
////                'Content-Disposition' => 'inline; filename="' . $originalName . '"',
//                'Content-Disposition' => 'inline; filename="' . $originalName . '"',
//            ]);
//
//        } else {

            // Отдаём файл с нужным именем
            return response()->streamDownload(function () use ($stream) {
                fpassthru($stream);
            }, $originalName, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'attachment; filename="' . $originalName . '"',
            ]);

//        }


    }

}

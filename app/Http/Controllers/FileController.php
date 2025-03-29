<?php

namespace App\Http\Controllers;

use App\Models\LeedCommentFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\App;

class FileController extends Controller
{

    public static function secretCreate($model, $id): string
    {
        $s = env('APP_KEY', 'x');
        return md5($model . '+' . $s . '+' . $id);
    }

    public function downloadFile($model, $id, $secret)
    {
        if ($secret != self::secretCreate($model, $id, $secret)) {
            abort(404, 'упс ... не найдено');
        }
        // Проверка существования модели
        elseif (!class_exists($model)) {
            abort(404, 'упс ... не найдено');
        }



        if ($model == '\App\Models\LeedCommentFile') {

            // Получение записи из БД
            $f = $model::findOrFail($id);
            // Проверка наличия файла
            $filePath = storage_path("app/public/{$f->path}");
            if (!file_exists($filePath)) {
                abort(404, 'Файл не найден');
            }

            $file_name = $f->file_name;
        }

        if (!empty($filePath) && !empty($file_name)) {
            // Возвращаем файл для скачивания
            return response()->download($filePath, $file_name);
        } else {
            abort(404, 'Файл не найден');
        }
    }


}

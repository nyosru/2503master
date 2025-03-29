<?php

namespace App\Observers;

use App\Models\LeedCommentFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

//use Intervention\Image\Facades\Image as InterventionImage;
use Intervention\Image\ImageManager;

class LeedCommentFileObserver
{
    /**
     * Handle the LeedCommentFile "created" event.
     */
    public function created(LeedCommentFile $f): void
    {
        // Проверяем, есть ли у модели путь к изображению
        if (!$f->path) {
            return;
        }

        // Загружаем оригинальное изображение
        $originalPath = storage_path('app/public/' . $f->path);
        if (!file_exists($originalPath)) {
            return;
        }

//        dd([
//            $f->path,
//            $originalPath,
//            Storage::mimeType($originalPath)
//        ]);
//
//            Storage::mimeType($originalPath);
////        dd(Storage::mimeType($f->path));
//
        if (
//            str_starts_with(Storage::mimeType($f->path), 'image/jpeg')
            strpos($f->path, '.jpg')
            || strpos($f->path, '.webp')
            || strpos($f->path, '.png')
        ) {}else{
            return;
        }

        // Генерируем путь для миниатюры
        $thumbnailPath = 'leed-comments-thumbnails/' . basename($f->path);

        $trumb_path = storage_path("app/public/leed-comments-thumbnails");
        // Проверяем, существует ли папка, и создаем её, если нет
        if (!File::exists($trumb_path)) {
            File::makeDirectory($trumb_path, 0755, true);
        }

        $thumbnailFullPath = storage_path('app/public/' . $thumbnailPath);

        try {
            $manager = new ImageManager(
                new \Intervention\Image\Drivers\Gd\Driver()
            );

            $image = $manager->read($originalPath);
            $image->resize(100, 100);
            $encoded = $image->toJpg();
            $encoded->save($thumbnailFullPath);


//        // Создаём превью 100x100
//        $img = InterventionImage::make($originalPath)
//            ->fit(100, 100)
//            ->save($thumbnailFullPath);

            // Сохраняем ссылку на превью в БД
            if (file_exists($thumbnailFullPath)) {
                $f->mini = $thumbnailPath;
                $f->saveQuietly(); // Используем saveQuietly(), чтобы не вызывать бесконечный цикл обновления
            }
//            dd(__LINE__.' ok');
        } catch (\Exception $e) {
//            dd(__LINE__, $e->getMessage());
        }
    }

    /**
     * Handle the LeedCommentFile "updated" event.
     */
    public function updated(LeedCommentFile $leedCommentFile): void
    {
        //
    }

    /**
     * Handle the LeedCommentFile "deleted" event.
     */
    public function deleted(LeedCommentFile $leedCommentFile): void
    {
        //
    }

    /**
     * Handle the LeedCommentFile "restored" event.
     */
    public function restored(LeedCommentFile $leedCommentFile): void
    {
        //
    }

    /**
     * Handle the LeedCommentFile "force deleted" event.
     */
    public function forceDeleted(LeedCommentFile $leedCommentFile): void
    {
        //
    }
}

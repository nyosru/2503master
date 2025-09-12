<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CkEditorController extends Controller
{
    public function uploadImage(Request $request)
    {
        try {

            $request->validate([
                'upload' => 'required|image|max:2048'
            ]);

            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $path = $file->store('editor-images', 'public');
                $url = Storage::disk('public')->url($path);

                return response()->json([
                    'url' => $url,
                    'uploaded' => true
                ]);
            }

            return response()->json([
                'uploaded' => false,
                'error' => ['message' => 'Файл не загружен']
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => ['message' => $e->getMessage()]
            ], 500);
        }
    }
}

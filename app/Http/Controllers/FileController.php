<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    /**
     * List all files.
     */
    public function index()
    {
        $files = Storage::disk('public')->files('uploads');

        $files = array_map(function ($item) {
            return str_replace('uploads/', '', $item);
        }, $files);

        return response()->json([
            'message' => 'Files Retrieved successfully!',
            'data' => $files
        ], 200);
    }

    /**
     * Upload a new file.
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), ['file' => 'required|string|regex:/^data:@file\/.+;base64,.*/']);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'You need to submit a valid base64 decoded file.'
            ], 403);
        }

        $base64_encoded_string = $request->file;
        $base64_str = substr($base64_encoded_string, strpos($base64_encoded_string, ",")+1);
        $extension = explode('/', mime_content_type($base64_encoded_string))[1];
        $file = base64_decode($base64_str);
        $name = 'file_'.rand(0, 999) . '.' . $extension;
        Storage::disk('public')->put('uploads/'.$name, $file);
        return response()->json([
            'message' => 'Your file uploaded successfully!'
        ], 200);
    }

    public function download(Request $request)
    {
        $validator = Validator::make($request->all(), ['file' => 'required|string']);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'You need to submit a file name.'
            ], 403);
        }

        $path = 'uploads/'.$request->file;
        
        if (!Storage::disk('public')->exists($path)) {
            return response()->json([
                'message' => 'There is no file with this name.'
            ], 403);
        }

        return Storage::disk('public')->download($path);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), ['file' => 'required|string']);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'You need to submit a file name.'
            ], 403);
        }

        $path = 'uploads/'.$request->file;
        
        if (!Storage::disk('public')->exists($path)) {
            return response()->json([
                'message' => 'There is no file with this name.'
            ], 403);
        }

        Storage::disk('public')->delete($path);

        return response()->json([
            'message' => 'Your file deleted successfully!'
        ], 200);
    }
}

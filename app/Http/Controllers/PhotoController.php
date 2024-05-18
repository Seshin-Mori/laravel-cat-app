<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //アップロード画面を表示
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //アップロードするディレクトリの指定
        $savedFilePath = $request->file('image')->store('photos', 'public');

        $fileName = pathinfo($savedFilePath, PATHINFO_BASENAME);
        Log::debug('ファイルの保存に成功しました。パス：' . $savedFilePath);
        Log::debug('ファイル名：' . $fileName);

        // return to_route('photos.create')->with('success', 'ファイルをアップロードしました。');
        return to_route('photos.show', ['photo' => $fileName])->with('success', 'アップロードしました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $fileName)
    {
        //アップロードした画像を表示
        return view('photos.show', ['fileName' => $fileName]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $fileName)
    {
        //アップロードした画像を削除
        Storage::disk('public')->delete('photos/' . $fileName);
        return redirect()->route('photos.create')->with('success', 'ファイルを削除しました');
    }

    /**
     * Download the specified resource.
     */
    public function download(string $fileName)
    {
        // パスのデバッグログを追加
        $filePath = 'photos/' . $fileName;
        Log::debug('ダウンロードするファイルパス: ' . $filePath);

        // アップロードした画像をダウンロード
        return Storage::disk('public')->download($filePath, 'download.jpg');
    }
}

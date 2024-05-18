<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
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
        //登録画面を表示
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //登録処理（便宜上ログファイルに）
    public function store(Request $request)
    {
        $title = $request->get('title');
        Log::debug('イベント名：' . $title . 'を登録しました。');
        //登録後リダイレクト
        return to_route('events.create')->with('success', $title . 'を登録しました');
        return view('events.create');
    }
}

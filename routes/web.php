<?php

use App\Http\Controllers\UtilityController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RequestSampleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HiLowController;
use App\Http\Controllers\PhotoController;

Route::get('/', fn () => view('index'));
Route::get('/curriculum', fn () => view('curriculum'));

Route::get('/hello-world', fn () => 'Hello World! <br> And welcome to Laravel!');

//HTMLを直接記述することもできるが、明らかに効率が悪いためviewを使用する。
Route::get('/planehtml', fn () => '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML</title>
    </head>
    <body>
        <h1 style="color:red;">Hello World!</h1>
        <p>Welcome to Laravel!</p>
        </body>
        </html>
        ');

//view関数を使用して、resources/viewsディレクトリ内のbladeファイルを表示する。
Route::get(
    '/hello-blade',
    fn () => view(
        'hello2',
        ['name' => '森', 'course' => 'Laravel']
    )
);


/**ロジックをルーティングで実装した例
しかし、これではコードが複雑になるため、コントローラを使用する。*/
// 世界の時間
// Route::get('/world-time', function () {
//     $timeDiff = [
//         '東京' => 0,
//         'シンガポール' => -1,
//         'パリ' => -8,
//         'ロンドン' => -9,
//         'ニューヨーク' => -14,
//         'ロサンゼルス' => -17,
//         'ハワイ' => -19,
//     ];
//     $times = array_map(fn ($diff) => now()->addHours($diff), $timeDiff);
//     return view('world-time', ['times' => $times]);
// });
Route::get('/world-time', [UtilityController::class, 'worldTime']);
// おみくじ
// Route::get('/omikuji', function () {
//     $fortunes = ['大吉', '中吉', '小吉', '吉', '末吉', '凶', '大凶'];
//     $resultIndex = array_rand($fortunes);
//     $result = $fortunes[$resultIndex];
//     return view('omikuji', ['result' => $result]);
// });
Route::get('/omikuji', [GameController::class, 'omikuji']);
// モンティ・ホール問題
// Route::get('/monty-hall', function () {
//     $results = [];
//     for ($i = 0; $i < 1000; $i++) {
//         $options = [true, false, false];
//         shuffle($options);

//         $selectedIndex = array_rand($options);
//         $notSelectedIndexes = array_filter($options, fn ($index) => $index !== $selectedIndex, ARRAY_FILTER_USE_KEY);
//         $removeIndex = array_search(false, $notSelectedIndexes);
//         unset($notSelectedIndexes[$removeIndex]);

//         $changedIndex = key($notSelectedIndexes);
//         $results[] = $options[$changedIndex];
//     }
//     $wonCount = count(array_filter($results, fn ($result) => $result));
//     return view('monty-hall', ['results' => $results, 'wonCount' => $wonCount]);
// });
//GameControllerクラスのmontyHallメソッドを呼び出す
Route::get('/monty-hall', [GameController::class, 'montyHall']);

//リクエスト
Route::get('/form', [RequestSampleController::class, 'form']);
Route::get('/query-strings', [RequestSampleController::class, 'queryStrings']);
//idをルートパラメータとみなす
Route::get('/profile/{id}', [RequestSampleController::class, 'profile'])->name('profile');
Route::get('/products/{category}/{year}', [RequestSampleController::class, 'productsArchive']);

//名前付きルート
Route::get('/route-link', [RequestSampleController::class, 'routeLink']);

//ログインのアクション
Route::get('/login', [RequestSampleController::class, 'loginForm']);
Route::post('/login', [RequestSampleController::class, 'login'])->name('login');

//よくあるルート登録は、Route::resourceメソッドを使用することで簡略化できる
//典型的とされるルートは7つのルートで
//一覧表示、新規登録フォーム表示、新規登録処理、詳細表示、編集フォーム表示、更新処理、削除処理
//アクションについても同じで、典型的なアクションを--resourceオプションで指定することで、一括でルート登録できる
Route::resource('/events', EventController::class)->only(['index', 'create', 'store']);

// ハイローゲーム
Route::get('/hi-low', [HiLowController::class, 'index'])->name('hi-low');
Route::post('/hi-low', [HiLowController::class, 'result']);

//ファイル管理
Route::resource('/photos', PhotoController::class)->only(['create', 'store', 'show', 'destroy']);
//画像用のルーティングがないので、シンボリックリンクを作成する
//ダウンロード用のルートはresourceメソッドで登録できないため、getメソッドで登録する
Route::get('/photos/{photo}}/download', [PhotoController::class, 'download'])->name('photos.download');


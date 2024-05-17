<?php

use App\Http\Controllers\UtilityController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

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

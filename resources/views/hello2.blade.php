<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML</title>
    </head>
    <body>
        <h1 style="color:red;">Hello World!</h1>
        {{-- HTMLで表示されないコメントを書ける --}}
        {{-- Bladeテンプレートは、変数に値を渡すだけでなく、クロスサイトスクリプティング対策等もできる --}}
        <p>ようこそ {{ $name }}さん</p>
        <p>これは{{ $course }}の学習用に作成されたサイトになりますわ。</p>
    </body>
</html>
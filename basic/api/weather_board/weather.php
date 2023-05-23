<h1>天気予報投稿</h1>
<br><br><br>


<h2>api（OpneWeather）テスト</h2>
<?php
// OpenWeatherMap API
$apiKey = "2815ab74bc1a8915867af1cb0fdef685";//サイトからapiキーを発行して入力
$cityName = "tokyo";//都市名を入れる

$url = "http://api.openweathermap.org/data/2.5/weather?q=$cityName&appid=$apiKey";//都市名、apiキーがパラメーターとして入ったリンクを変数に格納

$response = file_get_contents($url);//指定されたURLからデータを取得しています。これにより、OpenWeatherMapのAPIからの応答が取得される
$data = json_decode($response, true);//urlから取得した情報（元からjson形式になっている）をphp用データとして復元し、配列として格納しています。この配列には、天気情報などのさまざまな情報が含まれている。

if ($data && isset($data['weather'][0]['description'])) {//$dataが存在し、かつ$data['weather'][0]['description']が存在するかどうかをチェック（取得した配列データの中から天気の説明を取得するためのキー）。
    //$dataはAPIから取得したデータを格納した配列。['weather']は天気情報を格納しているキー。[0]は最初の要素を指定。['description']は天気の説明を表すキー。他のキーも使える（json_to～参照）
    $weatherDescription = $data['weather'][0]['description'];//$weatherDescription変数に取得した天気の説明を代入
    echo "Current weather: $weatherDescription";
} else {
    echo "Failed to retrieve weather information.";
}

// ここからはapiで取得したデータ（配列等）の検証用（apiの通信が走るたびに下記のファイルも更新される）
//①取得したjsonデータをローカルのjsonファイルに移植し、配列を確認
$target_dir_json = dirname(__FILE__);//今いるディレクトリ
$target_file_json = $target_dir_json . "/json_to_php.json";//今いるディレクトリにjsonファイル追加
$json_data = json_encode($data);//既にphp用にでコードされているデータをjson用にエンコード
file_put_contents($target_file_json, $json_data);//上記の内容をjsonファイルに置く

//②取得したjsonデータ（既にphp用にデコードしてあるもの）をローカルのphpファイルに移植し、配列を確認
$target_dir_php = dirname(__FILE__);
$target_file_php = $target_dir_php . "/json_to_php.php";
// PHPコードとして配列を書き込む
$file_content = "<?php\n";
$file_content .= var_export($data, true) . ";\n?>";//var_export()関数を使用して$data配列をPHPコードの文字列に変換し、$file_contentに追加。※.=のドットは既存の文字列に新しい文字列を追加するために使用（お作法）
file_put_contents($target_file_php, $file_content);

?>

<br><br><br>
※apiキーは発行後すぐには使えず、数時間以内にアクティベートされるっぽい。それまではFailed to retrieve weather information.のエラーが出る
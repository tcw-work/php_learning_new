<?php
$bookTitle = "1週間でPHPの基礎が学べる本";//本のタイトルを明記
$apiUrl = "https://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=title%3D%22" . urlencode($bookTitle) . "%22&recordSchema=dcndl_simple";//v国立国会図書館APIを検索するためのURLを定義
//SRU(Search/Retrieve via URL)検索プロトコルに準拠。operation=searchRetrieve: このパラメータは、APIのどの操作を実行するかを指定。query=はAPIに送るクエリを定義。
//ecordSchema=dcndl_simpleは国立国会図書館で用いられるシンプルなメタデータスキーマ（APIスキーマー＝APIから返されるデータの構造や形式を定義するためのもの）

//今回のAPIはXML形式で帰ってくるので、それを処理していく

$curl = curl_init();//cURLというPHPのライブラリを使ってAPIリクエスト（新しいcURLセッショ）を初期化して開始。この関数は通常、APIリクエストの最初のステップとして呼び出す

//cURLのオプションを設定（下記のオプションを設定することで、APIリクエストの動作を詳細に制御することができ）
curl_setopt_array($curl, array(//cURLライブラリに含まれる関数で、一度に複数のcURLオプションを設定するために使用（設定したいオプションとその値をペアとした連想配列にする）
    CURLOPT_URL => $apiUrl,//リクエストの結果を文字列として表示
    CURLOPT_RETURNTRANSFER => true,//リクエスト結果から得る戻り値を文字列として受け取る。falseの場合は実行結果が文字列としてではなく、元のデータとして表示される
    CURLOPT_TIMEOUT => 30,//30秒以上の通信は行われない（30秒以上かかる場合はcURLはエラーを返す）
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,//通信にHTTPプロトコルが必要ない場合は必要なし（仕様書によるので、必要に応じて更新）
    CURLOPT_CUSTOMREQUEST => "GET",//cURLリクエストでこちらから送るデータをGETにしている。URLのデフォルトのHTTPメソッドはGETなので、記入する必要はないが、今回は明示的に書いてるだけ（POSTでもOKで、案件によって使い分ける）
    CURLOPT_HTTPHEADER => array(//HTTPヘッダー（本体データに関する各種のメタデータが含まれる）を取得するもの
        "cache-control: no-cache"//CURLOPT_HTTPHEADER の中にcache-control: no-cacheを書けば、キャッシュがあっても常にヘッダーとボディの最新情報を取得できる。
        //※ヘッダーには、リクエストやレスポンス、またはその本体に関する情報（メタデータ）が含まれ、ボディには実際のコンテンツ（データ）が含まれる
    ),
));

$response = curl_exec($curl);//実際にAPIリクエストを実行し、レスポンスを受け取る
$err = curl_error($curl);//もしエラーがあればそれも取得

curl_close($curl);//cURLセッションを閉じる（お作法）

if ($err) {//エラーがあればそれを表示して処理を停止
    die("cURL Error: " . $err);
}

if (!$response) {//レスポンスが空の場合、エラーメッセージを表示して処理を停止
    die("Empty response");
}

libxml_use_internal_errors(true);//libxml_use_internal_errors(true)は、libxmlエラーを内部に格納し、ユーザー定義のエラーハンドリングを可能する
$xml = new SimpleXMLElement($response);//レスポンスはXML形式なので、それをパースするためにSimpleXMLElementを使用
if ($xml === false) {//XMLのパースに失敗した場合はエラーメッセージを表示
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
    exit;
}

foreach ($xml->records->record as $record) {//パースしたXMLから、それぞれのレコードの情報（タイトル、著者、出版社、発行日、識別子）を取得し、それらを画面に出力
    $dc = $record->recordData->children('http://ndl.go.jp/dcndl/dcndl_simple/')->dc;
    $title = (string)$dc->children('http://purl.org/dc/elements/1.1/')->title;
    $creator = (string)$dc->children('http://purl.org/dc/elements/1.1/')->creator;
    $publisher= (string)$dc->children('http://purl.org/dc/elements/1.1/')->publisher;
    $issued = (string)$dc->children('http://purl.org/dc/terms/')->issued;
    $identifier = (string)$dc->children('http://purl.org/dc/elements/1.1/')->identifier;
    echo "Title: {$title}<br>";
    echo "Author: {$creator}<br>";
    echo "publisher: {$publisher}<br>";
    echo "issued: {$issued}<br>";
    echo "identifier: {$identifier}<br>";
}




// $apiKey = "ad889080055d9e27bb1d349144e8deb"; // あなたのAPIキーに置き換えてください
// $isbn = "9784834021759"; // 検索する書籍のISBNに置き換えてください
// $apiUrl = "https://api.calil.jp/check?appkey={$apiKey}&isbn={$isbn}&callback=no";

// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL => $apiUrl,
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//         "cache-control: no-cache"
//     ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     $responseArray = json_decode($response, true);

//     // 必要な情報を取得
//     // 以下は一例です、レスポンスに含まれるデータによって異なります
//     $bookTitle = $responseArray['books'][$isbn]['title'];
//     $bookAuthor = $responseArray['books'][$isbn]['author'];

//     echo "Title: {$bookTitle}<br>";
//     echo "Author: {$bookAuthor}<br>";
// }

?>
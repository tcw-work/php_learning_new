<?php
$bookTitle = "1週間でPHPの基礎が学べる本";//本のタイトルを明記
$apiUrl = "https://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=title%3D%22" . urlencode($bookTitle) . "%22&recordSchema=dcndl_simple";//国立国会図書館APIを検索するためのURLを定義
//SRU(Search/Retrieve via URL)検索プロトコルに準拠。operation=searchRetrieve: このパラメータは、APIのどの操作を実行するかを指定。query=はAPIに送るクエリを定義。
//ecordSchema=dcndl_simpleは国立国会図書館で用いられるシンプルなメタデータスキーマ（APIスキーマー＝APIから返されるデータの構造や形式を定義するためのもの）

//今回のAPIはXML形式で帰ってくるので、それを処理していく

$curl = curl_init();//cURLというPHPのライブラリを使ってAPIリクエスト（新しいcURLセッショ）を初期化して開始。この関数は通常、APIリクエストの最初のステップとして呼び出す

//cURLのオプションを設定（下記のオプションを設定することで、APIリクエストの動作を詳細に制御することができる）
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

if (!$response) {//レスポンスが空の場合
    die("Empty response");//エラーメッセージを表示して処理を停止
}

libxml_use_internal_errors(true);//libxmlは、XML関連の処理を行うためのライブラリ。trueを渡すと、libxmlが発生するエラーを内部に蓄えるようになる（すぐにエラーメッセージは出さない。）
$xml = new SimpleXMLElement($response);//SimpleXMLElementとはPHPに予め備えられているクラスであり、XMLに含まれている文字列（本文）をオブジェクトとして格納できる
//特定の形式のデータ（この場合はXML）を読み取り、そのデータをプログラムが扱える形式（上記）のことをパースと呼ぶ
if ($xml === false) {//XMLの本文をオブジェクトにする際にエラーがあったら
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {//new SimpleXMLElement($response); が失敗した場合、libxmlがエラーメッセージを内部に蓄えて、エラーが複数でも全て表示する
        echo "<br>", $error->message;
    }
    exit;
}
//●要約
//①libxml_use_internal_errors(true);でエラーがあった場合に、それを蓄えておく
//②$xml = new SimpleXMLElement($response);　で引数にセットした$responseの戻り値をオブジェクトにする
//③foreach(libxml_get_errors() as $error)で、エラーがあった場合に蓄えていたエラーを出す


foreach ($xml->records->record as $record) {//パースしたXML（$xml）から、それぞれのレコードの情報（タイトル、著者、出版社、発行日、識別子）を取得し、それらを画面に出力
    //上記は連想配列ではなくSimpleXMLElementを使ってXMLのデータを扱う際の形式（オブジェクト操作という認識でオッケー）
    //$xml（パースしたXML全体）からrecords（エレメント）を取得し、その中のrecord（子エレメント）を取得。エレメントはAPI毎に異なるので、取得したXMLデータ（library_check.php）や仕様書を参照
    $sample = $record->recordData->children('http://ndl.go.jp/dcndl/dcndl_simple/')->dc;
    //複数あるrecordDataの中に「http://ndl.go.jp/dcndl/dcndl_simple/」がいくつか入っていると、衝突を起こすので、それを一意のものとして判断することができる（XMLの「xmlns」の部分で名前空間として既に設定されている）
    //→「http://ndl.go.jp/dcndl/dcndl_simple/」は一意であるため、複数ある場合それぞれに処理が走る
    //※名前空間を明示することで、具体的な「コンテキスト」または「カテゴリ」を指定して、同名の要素があっても混乱を避けることができる
    //つまりコンテキストの内容が全く同じでも、この名前空間の値によって、別の要素と判定することができるということ。
    //children()はSimpleXMLElementクラスのメソッドで、指定した上記の名前空間の子エレメントを返す
    $title = (string)$sample->children('http://purl.org/dc/elements/1.1/')->title;
    //上記はhttp://ndl.go.jp/dcndl/dcndl_simple/という名前空間をもつdcエレメントの、さらにhttp://purl.org/dc/elements/1.1/という名前空間をもつtaitleエレメントを指定しているということ
    $creator = (string)$sample->children('http://purl.org/dc/elements/1.1/')->creator;
    $publisher= (string)$sample->children('http://purl.org/dc/elements/1.1/')->publisher;
    $issued = (string)$sample->children('http://purl.org/dc/terms/')->issued;
    //上記は別の名前空間が使われている。dcterms（発行日の直前）とxmlns:dcterms（名前空間の直前）が一致しているか否かで入力する文字列を判断すればオッケー
    $identifier = (string)$sample->children('http://purl.org/dc/elements/1.1/')->identifier;
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
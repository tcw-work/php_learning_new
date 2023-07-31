<?php
include '../common/db.php';

// push.jsでトークン取得し非同期通信で下記テーブル作成
$create_table = <<<_TABLE_
CREATE TABLE IF NOT EXISTS tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(255) NOT NULL UNIQUE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
_TABLE_;

try {
    $db->exec($create_table);
} catch (PDOException $e) {
    http_response_code(422);
    echo json_encode(['error' => "テーブル作成時にエラー発生: " . $e->getMessage()]);
    exit;
}

// ポストされたトークンデータを取得
$token = $_POST['token'];

if(isset($token) && !empty($token)) {

//前後の空白をシリアライズ
$token = trim($token);

// バリデート
if($token === '') {
    http_response_code(400);
    echo json_encode(['error' => 'トークンが空です']);
    exit;
}

// トークンデータがあればDBに保存
$sql = "INSERT INTO `tokens`(`token`) VALUES (:token)";

try {
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();

    http_response_code(201);//成功時に201（Created）のレスポンスコードを返す
    $response = [
        'token' => $token, //配列キー => 値 として呼び出し元（push.js）に$response返す
        'id'    => $db->lastInsertId()//$dbの最後に挿入されたIDとして返す
    ];
    echo json_encode($response);//$response配列をJSON形式にエンコードし、その結果を出力（一般的に、APIのレスポンスはJSON形式で返す）
} catch (PDOException $e) {
    http_response_code(422);//失敗時に422のレスポンスコードを返す（サーバーが理解できる形式のリクエストを受け取ったが、何らかの理由で処理できない場合）
    echo json_encode(['error' => "トークン保存中にエラー発生: " . $e->getMessage()]);
    exit;
}
} else {
    // http_response_code(400);
    // echo json_encode(['error' => 'No token posted']);
    // exit;
}
?>
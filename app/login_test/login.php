<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
try {//{}の中で処理が失敗したら、catch{}の中の処理を執行
    $dsn = 'mysql:host=localhost;dbname=c_app';
    $username = 'root';
    $password = '';
    $db = new PDO($dsn, $username, $password);//接続するDB指定。もし指定されたパスにデータベースファイルが存在しない場合、new PDO()の呼び出し時に自動的にファイルが作成される
} catch (PDOException $e) {//↑が失敗したら実行する処理。tryにnew PDOを使う場合はPDOExceptionを使用しておく（でないとブラウザにPHPのエラーが直接出る）
    //$eは例外オブジェクトをキャッチした際に代入される変数（任意の文字）。PDOExceptionはデータベース接続時に発生する可能性があるいくつかのエラーをキャッチするために使用（エラーの詳細な情報を取得し、適切なエラーハンドリングを行うことができる）
    echo "データベースに接続できません。" . $e->getMessage();//getMessage()は例外のエラーメッセージを取得したり、エラーの特定が容易になるという意味で使用される
    //$eに格納されている例外オブジェクトのgetMessage()メソッドを呼び出して、該当の例外のエラーメッセージを取得する。
    exit;
}

//-----フォームから受け取った情報を処理-----------------------------------------------------------------------------------------------------------------------------------------------------------
$user_pass = htmlspecialchars($_GET["user_pass"]);//この時点ではパスワードはハッシュ化しない
$user_mail = htmlspecialchars($_GET["user_mail"]);
// echo $user_name; echo $user_pass; echo $user_mail;   //表示確認用

if (!empty($user_mail) && !empty($user_pass)) {//メルアドと、名前、パスワードが空でない場合はtrue処理

    //既存ユーザー用処理。もしDBに既にあったら、insertせずにsessionIDだけ持たせる
    $check_infor = "SELECT * FROM users WHERE user_mail = :user_mail";//sql文でメルアドの入ったカラムを指定。 {$user_name}で指定すると、「SQLインジェクション」と呼ばれるセキュリティ上の脆弱性を引き起こす
    $stmt = $db->prepare($check_infor);//上記sql文の実行準備
    $stmt->bindParam(':user_mail', $user_mail);//上記のselectのsql文では、まだ特定のユーザーを指定していないので、ここで:user_mail（プレースホルダ）を$user_mail（特定のユーザー）に指定する
    $stmt->execute();//プレースホルダーにバインドされた値を含むクエリが実際にデータベースに送信。指定されたユーザー名と一致する行を検索し、結果セットを返す。
    if ($stmt->rowCount() > 0) {//rowCount() メソッドはデータベースクエリの結果セットに含まれる行数を取得し、その値が0より大きいかどうかを判定。
        //つまり特定のメルアド（$user_mail）の入ったカラムを検出した$stmtの行をカウント。もし$user_mail（ユニークユーザー）の入った行が１行あるか否かで条件分岐
        $user = $stmt->fetch(PDO::FETCH_ASSOC);//fetch() は結果セット（上記のメールに連なるカラム）から1行ずつデータを取得するために使用される。結果としてほしいカラムを抽出できる
        $hashed_password = $user['user_pass']; // データベースから取得したハッシュ化されたパスワード

        if (hash("sha512", $user_pass) === $hashed_password) {//ユーザーが入力したパスワードをハッシュ化し、DBに保存されているパスワードと一致するか確認
            // パスワードが一致する場合
            include 'session.php';
            sesstion_login($user_id);
            header("location: index.php");// ページをリダイレクトする
            exit;
        } else {
            // パスワードが一致しない場合の処理
            echo "パスワードが一致しません";
        }
    } else {
        // メールアドレスが存在しない場合の処理
        echo "メールアドレスが違います";
    }

//どちらかが空の場合
}  else if (empty($user_pass)) {
    echo "パスワードが一致しません";
} else if (empty($user_mail)) {
    echo "メールアドレスが違います";
}


?>
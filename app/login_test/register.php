<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
require_once 'db.php';

//-----テーブルを作成-----------------------------------------------------------------------------------------------------------------------------------------------------------
// テーブルは作成してもこの時点では実行不可能。IF NOTを加えることでテーブルが存在していない場合の処理ができる（存在している場合はalerdy existと出る）
$create_table = <<<_TABLE_
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY, /* ユーザーID（自動で割り振り） */
    user_name TEXT, /* ユーザー名 */
    user_pass CHAR, /* パスワード */
    user_mail TEXT, /* メールアドレス */
    user_document TEXT /* 文字保存 */
);
_TABLE_;
$result = $db->exec($create_table);//ここでテーブルが作成される

//-----フォームから受け取った情報を処理-----------------------------------------------------------------------------------------------------------------------------------------------------------
$user_name = htmlspecialchars($_GET["user_name"]);//form.phpから値を取得//エスケープ処理
$user_pass = htmlspecialchars($_GET["user_pass"]);//この時点ではパスワードはハッシュ化しない
$user_mail = htmlspecialchars($_GET["user_mail"]);
// エラー時に表示する文言を配列に格納
$error_message = array(
    "error_user_mail_same" => "既に使われているメールアドレスです",
    "error_user_mail" => "メールアドレスを入力してください",
    "error_user_mail_halfSize" => "メールアドレスを半角英数字で入力してください",
    "error_user_name" => "ユーザー名を入力してください",
    "error_user_pass" => "パスワードを入力してください",
);

if (!empty($user_mail) && !empty($user_name) && !empty($user_pass)) {//メルアドと、名前、パスワードが空でない場合はtrue処理

    //既存ユーザー用処理。もしDBに既にあったら、insertせずにIDだけ持たせる
    $check_infor = "SELECT * FROM users WHERE user_mail = :user_mail";//sql文でメルアドの入ったカラムを指定。 {$user_name}で指定すると、「SQLインジェクション」と呼ばれるセキュリティ上の脆弱性を引き起こす
    $stmt = $db->prepare($check_infor);//上記sql文の実行準備
    $stmt->bindParam(':user_mail', $user_mail);//上記のselectのsql文では、まだ特定のユーザーを指定していないので、ここで:user_mail（プレースホルダ）を$user_mail（特定のユーザー）に指定する
    $stmt->execute();//プレースホルダーにバインドされた値を含むクエリが実際にデータベースに送信。指定されたユーザー名と一致する行を検索し、結果セットを返す。
    if ($stmt->rowCount() > 0) {//rowCount() メソッドはデータベースクエリの結果セットに含まれる行数を取得し、その値が0より大きいかどうかを判定。
        //つまり特定のメルアド（$user_mail）の入ったカラムを検出した$stmtの行をカウント。もし$user_mail（ユニークユーザー）の入った行が既に入っていたら
        header("location: register_form.php?error_message=" . urlencode($error_message["error_user_mail_same"]) . "&user_name=" . urlencode($user_name) . "&user_mail=" . urlencode($user_mail));
        ///エラーメッセージを選択。urlencode（）はURLに含めることができない文字列や特殊文字（変数など含む）をエンコードするための関数。それをリダイレクト先に渡す。
        //$user_nameとmailもパラメーターにしているのは、送信エラーでリダイレクトされたときに入力窓の内容を表示するため（register_form.php参照）
        exit;
    } else {//もし既存ユーザーでなければ
        $user_infor = array (
            "user_name"=>$user_name,//サニタイジングした情報を連想配列＋新しい変数に格納
            "user_pass"=>$user_pass = hash("sha512", $user_pass),//パスワードはハッシュ化。第一引＝はハッシュアルゴリズムで第二引数は入力データ
            "user_mail"=>$user_mail,
        );
        // print_r($user_infor);//表示確認用（配列の中身を全表示）
        // echo $user_infor["user_name"];//表示確認用（配列の中身を個別に全表示）

        $query = "INSERT INTO users (user_name, user_pass, user_mail) VALUES ('{$user_infor['user_name']}', '{$user_infor['user_pass']}', '{$user_infor['user_mail']}')";
        //↑クエリ内で配列操作する場合はダブルクォートと中括弧 ({}) で囲むことで正常にsqlが実行される
        $db->exec($query);//DBに対してsql(insert)を実行

        $user_id = $db->lastInsertId();// 直前に実行されたINSERTクエリで自動生成されたユーザーIDを取得（セッションの引数に使用）
        require_once 'session.php';//セッション処理をまとめた関数を格納したファイル
        session_login($user_id);//ログイン時にユニークIDをセッションに保管
        ///メルアドと、名前、パスワードが入っていて、問題ない場合はルートにリダイレクト
        header("location: index.php");// ページをリロードする

        if (!empty($user_mail)) {//メールアドレスを登録しているならメール送信
            require_once 'mail.php';//メール送信に関する関数を格納しているmail.phpを呼びだし
            $mailSender = new MailSender();//mail.phpの内容はクラスで作られているので、そのインスタンスを作成
            $mailSender->subject = "登録メールのテスト（件名）";//公開（public）プロパティに値を渡す（件名代入）
            $mailSender->setContent("メールの本文（テスト）です。");//setContent というメソッドを呼び出し、その引数としてメールの本文を渡す（本文代入）
            $mailSender->send($user_name, $user_mail);//メソッドを呼び出し、引数として値を渡す（引数をセットして関数実行）
            //※()があればメソッド呼び出し、なければプロパティへ値を渡すということ
            exit;
        }
    }
    if (mb_check_encoding($user_mail, 'UTF-8')) {//全角文字がある場合は入力エラーでリダイレクト（DB操作のifより外だと全角でもインサートされてしまうので、同階層で記述）
        header("location: register_form.php?error_message=" . urlencode($error_message["error_user_mail_halfSize"]) . "&user_name=" . urlencode($user_name) . "&user_mail=" . urlencode($user_mail));
        exit;
    }
} else if (empty($user_name)) {
    header("location: register_form.php?error_message=" . urlencode($error_message["error_user_name"]) . "&user_name=" . urlencode($user_name) . "&user_mail=" . urlencode($user_mail));
    exit;
} else if (empty($user_pass)) {
    header("location: register_form.php?error_message=" . urlencode($error_message["error_user_pass"]) . "&user_name=" . urlencode($user_name) . "&user_mail=" . urlencode($user_mail));
    exit;
} else if (empty($user_mail)) {
    header("location: register_form.php?error_message=" . urlencode($error_message["error_user_mail"]) . "&user_name=" . urlencode($user_name) . "&user_mail=" . urlencode($user_mail));
    exit;
}



?>
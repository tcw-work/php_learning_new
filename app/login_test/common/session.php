<?php

// header("Cache-Control:no-cache,no-store,must-revalidate,max-age=0");
// header("Cache-Control:pre-check=0,post-check=0", false);
// header("Pragma:no-cache");

//セッション情報をcookieに保存し、再訪問の際にサーバー側（session）とブラウザ（cookie）のセッションidを照会して自動ログイン
if(session_status() != PHP_SESSION_ACTIVE) {//現在のセッションのステータスを取得し、それがアクティブ出ない場合の条件分岐（つまり、セッションが無効または存在しない場合）
    if (isset($_COOKIE["session_id"])) {// クッキーにセッションIDが保存されているか確認
        session_id($_COOKIE["session_id"]);// セッションIDが存在する場合は、それを使用してセッションを再開。
        //session_id関数はPHPのデフォルト関数で、特定のセッションID（引数）にアクセスしたり、新しいセッションIDを設定したりするために使用（今回はクッキーから代入）
    }
    session_start();// セッションが既に開始していない場合にだけ session_start() を呼び出す
}


function session_login($user_id, $user_name) {
//ログイン情報をセッションに記録
$_SESSION["login"] = array("user_id" => $user_id, "user_name" => $user_name);

    //セッションIDをクッキーに保存（1週間有効）
    setcookie("session_id", session_id(), time() + 604800);//"session_id"はcookieの名前、 session_id()は名前の通り今のセッションのID
    //time関数はクッキーが有効である期間（604800秒＝7日間）をUNIXタイムスタンプ形式で指定。7日以内に再訪問すれば再び7日間有効になる
}

function session_part_01($script) {//リダイレクト先のindex.phpで呼び出し

    class State {//ログイン状態の有無の表示をクラスで管理
        public $state_log;
        function __construct($state_log) {
            $this->state_log = $state_log;
            echo "<p>{$this->state_log}時のインスタンステスト</p>";
        }
    }

    echo '<a href="/coding/local_coding/php_learning/app/login_test/">Suorce Pack</a><br><br>';

    if (isset($_SESSION['login'])) {
        if (isset($_POST['logout'])) {//ログアウト切り替え処理
            unset($_SESSION['login']);
            header("Location: $script"); // ログアウト後にページをリダイレクト（これが無いとリロードすると何も表示されなくなる）
            exit();
        }
        echo 'ユーザー名: ' . $_SESSION["login"]["user_name"] . '様' . '<br>';
        echo 'UserID: ' . $_SESSION["login"]["user_id"] . '<br>'; // セッションIDとユーザーIDがリンクしているかを表示して確認

        $state = new State("ログイン中");//クラスのインスタンス実行
        echo <<<_logout_
        <form action='$script' method="POST">
            <input type="hidden" name="logout"><br>
            <input type="submit" value="ログアウトする"><br>
        </form>
        _logout_;

        $user_id = $_SESSION["login"]["user_id"];
        include dirname(__DIR__).'/common/db.php';

        include dirname(__DIR__).'/function/total_goods.php';//総いいね数を表示
        $counter = new GoodsCounter($db, $user_id);//インスタンス作成
        $counter->displayTotalGoods();//デフォルトのいいね文言

        include dirname(__DIR__).'/function/total_generates.php';//総いいね数を表示
        $counter = new GeneratesCounter($db, $user_id);//インスタンス作成
        $counter->displayTotalGenerates();//デフォルトのいいね文言

        include dirname(__DIR__).'/function/total_level.php';
        total_level($db, $user_id);

        return true;//return 文は特定の条件が満たされた場合や処理を終了したい場合に使用。これがなければログアウトしたときに下記のif文も実行されてしまい、両方とも表示される
    }

    

    // ログアウト状態（セッション変数になにも入っていない場合の表示）＝新規ユーザー向け
    $state = new State("ログインしていない");//クラスのインスタンス実行
    echo 'ゲストユーザー様' . '<br>';
    echo '<a href="register_form.php">新規登録する</a><br>';
    echo '<a href="login_form.php">ログインする</a><br>';
}



$script = $_SERVER["SCRIPT_NAME"]; // このPHPファイルのパス

?>
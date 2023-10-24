<!-- 表示と保存の両方の処理を行う -->

<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include '../common/db.php';
require_once '../common/session.php';//ログインID確認用。本番アップ前にユーザーIDは非表示にする
include 'item_check.php'; // itemの重複チェックファイルをインクルード

$user_id = $_SESSION["login"]["user_id"];

    // ログインされていない場合の処理
    if (isset($_POST['save_button']) && isset($_POST['save_items']) && isset($_SESSION['login'])) {//値の入ったボタン、ラジオボタンの値がセット（クリック）がセットされていたら

            foreach ($_POST['save_items'] as $item) {//foreach(変数, 代入される配列変数)でname="save_items[]に設定した配列の要素を一つずつ順番に取り出す
                //$itemはArray([0] => "item1", [1] => "item3")のように配列変数となっているので、insertに$itemをセットすれば一括保存ができるといった仕組みになっている

                if (isItemSaved($db, $user_id, $item)) {//「もし$db, $user_id, $itemの組み合わせが既にデータベースに存在するなら…（item_check.php）
                    header("location: ../record.php?correct_message=". urlencode("既に{$item}は保存されています。"));
                } else {
                    $count_query = "SELECT COUNT(*) FROM favorites WHERE user_id = '$user_id'";//sessionからuser_idを参照してfavaritesテーブルを選択
                    $count_result = $db->query($count_query)->fetchColumn();//dbからクエ実行。PDOStatementオブジェクトのfetchColumnメソッドは、次の行から単一のカラムをす
                    //fetchColumn()は本来一つの値（結果）しか取得できないが、select文によって特定のuser_idを持つレコードが指定されている。その結果、そのIDを持つ複数のレコード（select部分）を一つの結果（fetchColumn）として返している
    
                    if ($count_result >= 20) {//カラムの合計が20以上の場合
                        header("location: ../record.php?correct_message=". urlencode("アイテムの保存上限に達しています。これ以上は保存できません。"));
                    } else {
                        $insert_query = "INSERT INTO favorites (user_id, item) VALUES ('$user_id', '$item')";// データの挿入クエリ
                        $result = $db->exec($insert_query);// 挿入クエリを実行
    
                        $favorite_id = $_SESSION['favorite_id'][$item]; // repository.phpでセッションに一時保存したfavorite_idの値を取り出す
                        $update_query = "UPDATE favorites SET goods = goods + 1 WHERE favorite_id = '$favorite_id'";//保存処理が走るたびに、そのfavorite_idを持つgoodsをインクリメント
                        $db->exec($update_query); // UPDATEクエリを実行
    
                        header("location: ../record.php?correct_message=". urlencode("{$item}を保存しました"));
    
                    }
                }

            }
    } else {//ログアウト情報がセットされていなければ
            $error_message = 'お気に入り保存を行うにはログインするか新規登録をおこなってください。';
            header("location: ../register_form.php?error_message=" . urlencode($error_message));
            }


?>
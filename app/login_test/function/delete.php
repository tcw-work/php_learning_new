<?php
// 削除ボタンが押された場合の処理
if (isset($_POST['delete_button'])) {//値の入ったボタンがセット（クリック）されていたら
    if (isset($_POST['delete_items'])) {//ラジオボタンの値がセット（クリック）されていたら
        $delete_items = $_POST['delete_items'];//POSTで送られてきたdelete_itemsという値（$row['favorite_id']でアイテムIDが入っている）

        // 選択されたアイテムを削除
        foreach ($delete_items as $favorite_id) {
            $delete_query = "DELETE FROM favorites WHERE favorite_id = '$favorite_id'";
            $db->exec($delete_query);
        }

        $delete_message = "選択したアイテムを削除しました。";
        // header("location:profile.php?delete_message=". urlencode($delete_message));//headerだとそれより先にechoなどで要素を表示したりするとエラーが出る（side.phpごされ）
        echo '<script>window.location.replace("profile.php?delete_message=' . urlencode($delete_message) . '");</script>';//代わりにJSで飛ばす
        exit; // リダイレクト後、スクリプトの実行を停止
    }
}
?>
<h1>抽象クラス・抽象メソッド</h1>

<?php
// リスト生成クラス(抽象クラス)。抽象クラスはインスタンス出来ないので、代わりに子クラスでインスタンス作成を行うことになる
abstract class AbsList { //クラス定義前にabstract修飾子を入れる
    // リストの開始(抽象メソッド)
    abstract function startList();//この空のメソッドの処理（中身）は子クラスで定義（子クラスからは戻り値として返される）

    // リストの終了(抽象メソッド)
    abstract function endList();

    // リスト生成メソッド
    function show($array) {//ここには後にクラス外から引数付きのインスタンスを作成して代入
        $this->startList();//子クラスに継承されたstartListにて、中身が定義されたものが入る
        foreach ($array as $value) {
            echo "<li>" . $value . "</li>\n";
        }
        $this->endList();
    }
}

// リストクラス (ulによるリスト)
class UlList extends AbsList {//抽象クラスAbsListから子クラスUlListへ継承
    // リストの開始 (実装)
    function startList() {
        echo "<ul>\n";//親クラスAbsListを変更することなく、内容を変更できる
    }
    
    // リストの終了(実装)
    function endList() {
        echo "</ul>\n";
    }
}
?>

<body>
    <p>都道府県のリスト</p>
    <?php
        // UlListクラスのインスタンスの生成
        $ls = new UlList();
        // $ls = new AbsList(); 抽象クラスはインスタンスを生成できないので、これだと実行されない
        $data = ["東京都", "大阪府", "愛知県"];
        $ls->show($data);//子クラスのインスタンス経由で親（抽象）クラスのshowメソッドを実行
    ?>
</body>



<br><br>
<h2>メモ</h2>
<ul>
    <li>抽象メソッドを具体的なメソッドでオーバーライドすることにより、異なる動作をさせることができる</li>
</ul>
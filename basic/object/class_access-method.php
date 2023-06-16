<h1>アクセスメソッド</h1>
※クラス内部だけで利用し、外部からアクセス不可なプロパティの場合は使わない<br><br><br>

<?php

class Person {

private $name; //カプセル化で外部からアクセス不可なので、setとgetの引数でアクセス

// $nameのセッター
function setName ($name) {
$this->name = $name;
}

// $nameのゲッター
function getName() {
    return $this->name;
}

}

// インスタンスの生成
$p = new Person();
$p->setName("やまだ");
echo "名前: {$p->getName()}";//getを使って出力をクラス外で行う
?>
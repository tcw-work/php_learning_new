//本の名前が入っていない場合はボタン押せないようにする
var forms = document.getElementsByClassName("myForm"); //myForm クラスを持つすべてのフォームに対してイベントリスナーを追加
for (var i = 0; i < forms.length; i++) { // "myForm" クラスを持つすべてのフォームに対してループ処理を行う
    var nameInput = forms[i].getElementsByClassName("url")[
        0]; //iの中にはforms.length; i++の処理によって、myFormというクラスをもつ要素（フォーム）がコレクションとして格納される
    //ここでの0はforms[i]に格納されたmyFormというクラスをもつ要素の中身にある最初の要素を意味する。なので[1]を使用せずとも一回の処理で各コレクションにアクセス可能。
    var saveButton = forms[i].getElementsByClassName("submit")[0];
    // コレクション＝getElementsByClassName("name") のようにクラス名が "name" である要素の集合を取得し、コレクションとして扱われる。今回の場合はformsがコレクション（集合体）
    nameInput.addEventListener("input", createInputListener(
        nameInput, //createInputListenerはaddEventListenerのコールバック関数として使用する
        saveButton)); // nameInput の値が変化したときに、createInputListener 関数が実行される
}

function createInputListener(input, button) {
    //return function() { ... } の部分は、イベントリスナーとして使用するための関数
    return function() { //ここではreturn文を無名関数に使って結果を呼び出し元に返すことで、イベントリスナーの処理として再利用できている（タイミング的には呼び出しもとで処理が行われる前になる）
        //内部の関数を返すことで、外部のスコープにあるnameInputとsaveButtonの値を保持しつつ、イベントが発生した際に正しくボタンの状態を制御
        button.disabled = !input.value;
        // input の値が空であれば、ボタンを無効化（disabled = true）
        // input の値が入力されていれば、ボタンを有効化（disabled = false）
    };
}


//webサイト全体から参照
function updateComplete1() {
    var auther01 = document.getElementsByClassName("auther01")[0].value;
    var date = document.getElementsByClassName("date")[0].value;
    var name = document.getElementsByClassName("name")[0].value;
    var url = document.getElementsByClassName("url")[0].value;
    var access = document.getElementsByClassName("access")[0].value;
    var complete = document.getElementsByClassName("complete")[0];

    var accessText = access !== '' ? "(" + '閲覧日:' + access + ')' + ' ' : '';// 「閲覧日」の表示を制御する
    var urlText = url !== '' ? url + '' + ' ' : '';// URLの表示を制御する
    var nameText = name !== '' ?  "｢" + name + "｣" + ',' + ' ' : '';// サイト名の表示を制御する
    var dateText = date !== '' ? "(" + date + ')' + '.' + ' ' : '(投稿日不明). ';// 「投稿日」の表示を制御する
    var auther01Text = auther01 !== '' ? auther01 + ' ' : '';// 「投稿者」の表示を制御する

    // 値が全部入っている場合
    complete.value = auther01Text + dateText + nameText + urlText + accessText;
    // 作者名が入っていない場合
    if (auther01 === '') {
        complete.value = nameText + dateText + urlText + accessText;
    }
}

//サイト内の記事から参照
function updateComplete2() {
    var auther01 = document.getElementsByClassName("auther01")[1].value;
    var date = document.getElementsByClassName("date")[1].value;
    var heading = document.getElementsByClassName("heading")[0].value;
    var name = document.getElementsByClassName("name")[1].value;
    var url = document.getElementsByClassName("url")[1].value;
    var access = document.getElementsByClassName("access")[1].value;
    var complete = document.getElementsByClassName("complete")[1];

    var accessText = access !== '' ? "(" + '閲覧日:' + access + ')' + ' ' : '';// 「閲覧日」の表示を制御する
    var urlText = url !== '' ? url + '' + ' ' : '';// URLの表示を制御する
    var headingText = heading !== '' ?  "『" + heading + "』" + ' ' : '';// ページ名の表示を制御する
    var nameText = name !== '' ?  "｢" + name + "｣" + ',' + ' ' : '';// サイト名の表示を制御する
    var dateText = date !== '' ? "(" + date + ')' + '.' + ' ' : '(投稿日不明). ';// 「投稿日」の表示を制御する
    var auther01Text = auther01 !== '' ? auther01 + ' ' : '';// 「投稿者」の表示を制御する

    // 値が全部入っている場合
    complete.value = auther01Text + dateText + headingText + nameText + urlText + accessText;
    // 作者名が入っていない場合
    if (auther01 === '') {
        complete.value = headingText + nameText + dateText + urlText + accessText;
    }
}

//サイト内の記事から参照
function updateComplete3() {
    // var auther01 = document.getElementsByClassName("auther01")[2].value;
    // var auther02 = document.getElementsByClassName("auther02")[2].value;
    // var auther03 = document.getElementsByClassName("auther03")[2].value;
    var authors = [//複数の場合は配列で管理
    document.getElementsByClassName("auther01")[2].value,
    document.getElementsByClassName("auther02")[2].value,
    document.getElementsByClassName("auther03")[2].value,
    ];
    var date = document.getElementsByClassName("date")[2].value;
    var heading = document.getElementsByClassName("heading")[1].value;
    var name = document.getElementsByClassName("name")[2].value;
    var url = document.getElementsByClassName("url")[2].value;
    var access = document.getElementsByClassName("access")[2].value;
    var complete = document.getElementsByClassName("complete")[2];

    var accessText = access !== '' ? "(" + '閲覧日:' + access + ')' + ' ' : '';// 「閲覧日」の表示を制御する
    var urlText = url !== '' ? url + "," + ' ' : '';// URLの表示を制御する
    var headingText = heading !== '' ?  "『" + heading + "』" + ' ' : '';// ページ名の表示を制御する
    var nameText = name !== '' ?  "｢" + name + "｣" + ',' + ' ' : '';// サイト名の表示を制御する
    var dateText = date !== '' ? "(" + date + ')' + '.' + ' ' : '(投稿日不明). ';// 「投稿日」の表示を制御する
    if (accessText === '') {
        var urlText = url !== '' ? url : '';// カンマ削除
    }

    // 作者名の配列が空白だった場合、空白用の新しい配列を作る
    var nonEmptyAuthors = authors.filter(function (author) {
        return author !== "";
    });

    // 作者名を '･' で結合します
    var authorText = nonEmptyAuthors.join('･') + ' ';

    // 値が全部入っている場合
    complete.value = authorText + dateText + headingText + nameText + urlText + accessText;

    // 作者がいない場合（上記で作った配列が空の場合）
    if (nonEmptyAuthors.length === 0) {
        complete.value = headingText + nameText + dateText + urlText + accessText;
    }
}

//オンラインジャーナルから参照
function updateComplete4() {
    var auther01 = document.getElementsByClassName("auther01")[3].value;
    var date = document.getElementsByClassName("date")[3].value;
    var name = document.getElementsByClassName("name")[3].value;
    var url = document.getElementsByClassName("url")[3].value;
    var access = document.getElementsByClassName("access")[3].value;
    var thesis = document.getElementsByClassName("thesis")[0].value;
    var medium = document.getElementsByClassName("medium")[0].value;
    var volum = document.getElementsByClassName("volum")[0].value;
    var number = document.getElementsByClassName("number")[0].value;
    var page = document.getElementsByClassName("page")[0].value;
    var page02 = document.getElementsByClassName("page02")[0].value;
    var complete = document.getElementsByClassName("complete")[3];

    var accessText = access !== '' ? "(" + '閲覧日:' + access + ')' + ' ' : '';// 「閲覧日」の表示を制御する
    var urlText = url !== '' ? url + "," + ' ' : '';// URLの表示を制御する
    // var headingText = heading !== '' ?  "『" + heading + "』" + ' ' : '';// ページ名の表示を制御する
    var nameText = name !== '' ?  "｢" + name + "｣" + ',' + ' ' : '';// サイト名の表示を制御する
    var dateText = date !== '' ? "(" + date + ')' + '.' + ' ' : '(投稿日不明). ';// 「投稿日」の表示を制御する
    var auther01Text = auther01 !== '' ? auther01 + ' ' : '';// 「投稿者」の表示を制御する
    var thesisText = thesis !== '' ? "｢" + thesis + "｣" + '.' + ' ' : '';// 論文の名前
    var mediumText = medium !== '' ? medium + '.' + ' ' : '';// 論文が掲載された書籍名
    var volumText = volum !== '' ? "vol." + volum + "" + '.' + ' ' : '';// 巻数
    var numberText = number !== '' ? "no." + number + "" + '.' + ' ' : '';// 号数
    var pageText = page !== '' ? 'p' + page : ''; // 初めのページ番号
    var pageText02 = page02 !== '' ? '-' + page02 + '.' + ' '  : '';//終わりののページ番号
    if (accessText === '') {//もし閲覧日が空欄だったら
        var urlText = url !== '' ? url : '';// カンマ削除
    }

    // 値が全部入っている場合
    complete.value = auther01Text + dateText + thesisText + mediumText + volumText + numberText + nameText + pageText + pageText02 + urlText + accessText;
    // 作者名が入っていない場合
    if (auther01 === '') {
        complete.value = thesisText + mediumText +  dateText + volumText + numberText + nameText + pageText + pageText02 + urlText + accessText;
    }
    //ページ番号①が入っていない場合
    if (pageText === '') {
        complete.value = auther01Text + dateText + thesisText + mediumText + volumText + numberText + nameText + urlText + accessText;
    }
    if (pageText02 === '') {
        var pageText = page !== '' ? 'p' + page + '.' + ' ' : ''; // 初めのページ番号
        complete.value = auther01Text + dateText + thesisText + mediumText + volumText + numberText + nameText + pageText + urlText + accessText;
    }

}
//本の名前が入っていない場合はボタン押せないようにする
var forms = document.getElementsByClassName("myForm"); //myForm クラスを持つすべてのフォームに対してイベントリスナーを追加
for (var i = 0; i < forms.length; i++) { // "myForm" クラスを持つすべてのフォームに対してループ処理を行う
    var nameInput = forms[i].getElementsByClassName("name")[
        0]; //iの中にはforms.length; i++の処理によって、myFormというクラスをもつ要素（フォーム）が配列として格納される
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


//作者が一人のパターン
function updateComplete1() {
    var auther01 = document.getElementsByClassName("auther01")[0].value;
    var date = document.getElementsByClassName("date")[0].value;
    var name = document.getElementsByClassName("name")[0].value;
    var publisher = document.getElementsByClassName("publisher")[0].value;
    var complete = document.getElementsByClassName("complete")[0];

    // 値が全部入っている場合
    complete.value = auther01 + ' ' + '(' + date + ')' + ' ' + "｢" + name + "｣" + ' ' + publisher;

    // 出版社が入っていない場合
    if (publisher === '') {
        complete.value = auther01 + ' ' + '(' + date + ')' + ' ' + "｢" + name + "｣";
    }
    // 日付が入っていない場合
    if (date === '') {
        date = '発行日不明';
        complete.value = auther01 + ' ' + date + ' ' +  "｢" + name + "｣"  + ' ' + publisher;
    }
    // 作者名が入っていない場合
    if (auther01 === '') {
        complete.value =  "｢" + name + "｣"  + ' ' + '(' + date + ')' + ' ' + publisher;
    }
}

//作者が複数のパターン
function updateComplete2() {
    var authors = [//複数の場合は配列で管理
        document.getElementsByClassName("auther01")[1].value,
        document.getElementsByClassName("auther02")[1].value,
        document.getElementsByClassName("auther03")[1].value,
    ];
    var date = document.getElementsByClassName("date")[1].value;
    var name = document.getElementsByClassName("name")[1].value;
    var publisher = document.getElementsByClassName("publisher")[1].value;
    var complete = document.getElementsByClassName("complete")[1];




    // 日付が空白の場合
    if (date === "") {
        date = "発行日不明";
    }

    // 作者名の配列が空白だった場合、空白用の新しい配列を作る
    var nonEmptyAuthors = authors.filter(function (authors) {//filter()メソッドは、既存の配列から指定された条件に該当する要素を取り出し、新しい配列を作成
        return authors !== "";//author が空文字列ではない要素かどうかを確認し、空文字列の場合はfalseを返し、filter メソッドによって要素は取り除かれる
        //getElementsByClassNameで取得できなかった場合（空白）の処理（この場合空の配列が作られる）
    });

    // 出版社が入っていない場合
    if (publisher === '') {
        complete.value =
        nonEmptyAuthors.join("･") +//filterをかけたauthersという配列に要素があった場合（tureの場合）の処理。配列の要素すべて（作者）が"・"で連結される。（if文の必要がなくなる）
        " " +
        "(" +
        date +
        ")" +
        "." +
        " " +
        "｢" +
        name +
        "｣";
    }

    // 作者がいない場合（上記で作った配列が空の場合）
    if (nonEmptyAuthors.length === 0) {//filterを掛けた要素の中身が0以上の長さを持っている場合
        complete.value =  "｢" + name + "｣"  + ' ' + '(' + date + ')' + ' ' + publisher;
    }
    // 作者がいる場合
    else {
        complete.value =
        nonEmptyAuthors.join("･") +//filterをかけたauthersという配列に要素があった場合（tureの場合）の処理。配列の要素すべて（作者）が"・"で連結される。（if文の必要がなくなる）
        " " +
        "(" +
        date +
        ")" +
        "." +
        " " +
        "｢" +
        name +
        "｣" +
        " " +
        publisher;
    }
    }


//外国人作者・翻訳のパターン
function updateComplete3() {
    var auther01 = document.getElementsByClassName("auther01")[2].value;
    var date = document.getElementsByClassName("date")[2].value;
    var name = document.getElementsByClassName("name")[2].value;
    var translator = document.getElementsByClassName("translator")[0].value;
    var publisher = document.getElementsByClassName("publisher")[2].value;
    var complete = document.getElementsByClassName("complete")[2];

    var publisherText = publisher !== '' ? publisher : '';// 「出版社」の表示を制御する
    var translatorText = translator !== '' ? translator + '訳' + ' ' : '';// 「論文の書かれた書籍」の表示を制御する
    var nameText = name !== '' ?  "｢" + name + "｣" + ' ' : '';// 「本の名前」の表示を制御する
    var dateText = date !== '' ? "(" + date + ')' + ' ' : '';// 「発行日」の表示を制御する
    var auther01Text = auther01 !== '' ? auther01 + ' ' : '';// 「作者名」の表示を制御する

    // 値が全部入っている場合
    complete.value = auther01Text + (dateText || '(発行日不明) ') + nameText + translatorText + publisherText;
    // 作者名が入っていない場合
    if (auther01 === '') {
        complete.value = nameText + (dateText || '(発行日不明) ') + translatorText + publisherText;
    }

}

//論文から出典するパターン
function updateComplete4() {
    var auther01 = document.getElementsByClassName("auther01")[3].value;
    var date = document.getElementsByClassName("date")[3].value;
    var name = document.getElementsByClassName("name")[3].value;
    var thesis = document.getElementsByClassName("thesis")[0].value;
    var page = document.getElementsByClassName("page")[0].value;
    var publisher = document.getElementsByClassName("publisher")[3].value;
    var complete = document.getElementsByClassName("complete")[3];

    var publisherText = publisher !== '' ? publisher : '';// 「出版社」の表示を制御する
    var pageText = page !== '' ? 'p' + page + ' ' : ''; // 「ページ番号」の表示を制御する
    var thesisText = thesis !== '' ? "｢" + thesis + "｣" + ' ' : '';// 「論文の書かれた書籍」の表示を制御する
    var nameText = name !== '' ?  "｢" + name + "｣" + ' ' : '';// 「本の名前」の表示を制御する
    var dateText = date !== '' ? "(" + date + ')' + ' ' : '';// 「発行日」の表示を制御する
    var auther01Text = auther01 !== '' ? auther01 + ' ' : '';// 「作者名」の表示を制御する

    // 値が全部入っている場合
    complete.value = auther01Text + (dateText || '(発行日不明) ') + nameText + thesisText + pageText + publisherText;

    //出版社が入っていない場合
    // if (publisher === '') {
    //     complete.value = auther01 + ' ' + '(' + (date || '発行日不明') + ')' + ' ' + "｢" + name + "｣" + ' ' + thesisText + ' ' + pageText;
    // }
    //論文の書かれた書籍が入っていない場合
    // if (thesis === '') {
    //     complete.value = auther01 + ' ' + '(' + (date || '発行日不明') + ')' + ' ' + "｢" + name + "｣" + ' ' + pageText + ' ' + publisher;
    // }
    // // ページ番号が入っていない場合
    // if (pageText === '') {
    //     complete.value = auther01 + ' ' + '(' + (date || '発行日不明') + ')' + ' ' + "｢" + name + "｣" + ' ' + thesisText + ' ' + publisher;
    // }
    // // 日付が入っていない場合
    // if (date === '') {
    //     date = '発行日不明';
    //     complete.value = auther01 + ' ' + '(' + date + ')' + ' ' + "｢" + name + "｣" + ' ' + thesisText + ' ' + pageText + ' ' + publisher;
    // }
    // // // 作者名が入っていない場合
    if (auther01 === '') {
        complete.value = nameText + thesisText + (dateText || '(発行日不明) ') + pageText + publisherText;
    }
}

//本に掲載された論文から出典するパターン
function updateComplete5() {
    var auther01 = document.getElementsByClassName("auther01")[4].value;
    var editor = document.getElementsByClassName("editor")[0].value;
    var date = document.getElementsByClassName("date")[4].value;
    var thesis = document.getElementsByClassName("thesis")[1].value;
    var name = document.getElementsByClassName("name")[4].value;
    var page = document.getElementsByClassName("page")[1].value;
    var page02 = document.getElementsByClassName("page02")[0].value;
    var publisher = document.getElementsByClassName("publisher")[4].value;
    var complete = document.getElementsByClassName("complete")[4];

    var publisherText = publisher !== '' ? publisher : '';// 「出版社」の表示を制御する
    var pageText = page !== '' ? 'p' + page : ''; // 「ページ番号」の表示を制御する
    var pageText02 = page02 !== '' ? '-' + page02  + ' '  : '';
    var thesisText = thesis !== '' ? "｢" + thesis + "｣" + ' ' : '';// 「論文の書かれた書籍」の表示を制御する
    var nameText = name !== '' ?  "｢" + name + "｣" + ' ' : '';// 「本の名前」の表示を制御する
    var dateText = date !== '' ? "(" + date + ')' + ' ' : '';// 「発行日」の表示を制御する
    var editorText = editor !== '' ? editor + ' ' : '';// 「編者名」の表示を制御する
    var auther01Text = auther01 !== '' ? auther01 + ' ' : '';// 「作者名」の表示を制御する


    // 値が全部入っている場合
    complete.value = auther01Text + (dateText || '(発行日不明) ') + nameText + editorText + thesisText + pageText + pageText02 + publisherText;
    // // // ページ番号①が入っていない場合
    if (pageText === '') {
        complete.value = auther01Text + (dateText || '(発行日不明)') + nameText + editorText + thesisText + publisherText;
    }
    if (pageText02 === '') {
        complete.value = auther01Text + (dateText || '(発行日不明)') + nameText + editorText + thesisText + pageText + ' ' + publisherText;
    }
    // // 作者名が入っていない場合
    if (auther01 === '') {
        complete.value = nameText + editorText + thesisText + (dateText || '(発行日不明) ') + pageText + pageText02 + publisherText;
    }

}


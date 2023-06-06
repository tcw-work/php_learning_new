//作者が一人のパターン
function updateComplete1() {
    var auther01 = document.getElementsByClassName("auther01")[0].value;
    var date = document.getElementsByClassName("date")[0].value;
    var name = document.getElementsByClassName("name")[0].value;
    var publisher = document.getElementsByClassName("publisher")[0].value;
    var complete = document.getElementsByClassName("complete")[0];

    // 値が全部入っている場合
    complete.value = auther01 + ' ' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;

    // 日付が入っていない場合
    if (date === '') {
        date = '(発行日不明)';
        complete.value = auther01 + ' ' + date + '.' + ' ' + name + ' ' + publisher;
    }
    // 作者名が入っていない場合
    if (auther === '') {
        complete.value = name + ' ' + date + '.' + ' ' + publisher;
    }
}


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
        date = "(発行日不明)";
    }

    // 作者名の配列が空白だった場合、空白用の新しい配列を作る
    var nonEmptyAuthors = authors.filter(function (authors) {//filter()メソッドは、既存の配列から指定された条件に該当する要素を取り出し、新しい配列を作成
        return authors !== "";//author が空文字列ではない要素かどうかを確認し、空文字列の場合はfalseを返し、filter メソッドによって要素は取り除かれる
        //getElementsByClassNameで取得できなかった場合（空白）の処理（この場合空の配列が作られる）
    });

    // 作者がいない場合（上記で作った配列が空の場合）
    if (nonEmptyAuthors.length === 0) {//filterを掛けた要素の中身が0以上の長さを持っている場合
        complete.value = "｢" + date + "｣" + "." + " " + name + " " + publisher;
    }
    // 作者がいる場合
    else {
        complete.value =
        nonEmptyAuthors.join("･") +//filterをかけたauthersという配列に要素があった場合（tureの場合）の処理。配列の要素すべて（作者）が"・"で連結される。（if文の必要がなくなる）
        " " +
        "｢" +
        date +
        "｣" +
        "." +
        " " +
        name +
        " " +
        publisher;
    }
    }


//作者が複数のパターン
// function updateComplete2() {
//     var auther1 = document.getElementsByClassName("auther01")[1].value;
//     var auther2 = document.getElementsByClassName("auther02")[1].value;
//     var auther3 = document.getElementsByClassName("auther03")[1].value;
//     var date = document.getElementsByClassName("date")[1].value;
//     var name = document.getElementsByClassName("name")[1].value;
//     var publisher = document.getElementsByClassName("publisher")[1].value;
//     var complete = document.getElementsByClassName("complete")[1];

//     // 日付が空白の場合
//     if (date === '') {
//         date = '(発行日不明)';
//     }
//     // 値が全部入っている場合
//     complete.value = auther1 + '･' + auther2 + '･' + auther3 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;

//     // 作者1がいない場合
//     if (auther1 === '') {
//         // 日付が空白の場合
//         if (date === '') {
//             date = '(発行日不明)';
//         }
//         complete.value = auther2 + '･' + auther3 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;

//     }
//     // 作者2がいない場合
//     else if (auther2 === '') {
//         // 日付が空白の場合
//         if (date === '') {
//             date = '(発行日不明)';
//         }
//         complete.value = auther1 + '･' + auther3 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;
//     }
//     // 作者3がいない場合
//     else if (auther3 === '') {
//         // 日付が空白の場合
//         if (date === '') {
//             date = '(発行日不明)';
//         }
//         complete.value = auther1 + '･' + auther2 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;
//     }
// // 作者1と作者2がいない場合
// if (auther1 === '' && auther2 === '') {
//     // 作者3がいない場合
//     if (auther3 === '') {
//         // 日付が空白の場合
//         if (date === '') {
//             date = '(発行日不明)';
//         }
//         complete.value = '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;
//     }
//     // 作者3がいる場合
//     else {
//         complete.value = auther3 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;
//     }
// }
// // 作者1と作者3がいない場合
// else if (auther1 === '' && auther3 === '') {
//     // 日付が空白の場合
//     if (date === '') {
//         date = '(発行日不明)';
//     }
//     complete.value = auther2 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;
// }
// // 作者2と作者3がいない場合
// else if (auther2 === '' && auther3 === '') {
//     // 日付が空白の場合
//     if (date === '') {
//         date = '(発行日不明)';
//     }
//     complete.value = auther1 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;
// }
// // 作者3と作者1がいない場合
// else if (auther3 === '' && auther1 === '') {
//     // 日付が空白の場合
//     if (date === '') {
//         date = '(発行日不明)';
//     }
//     complete.value = auther2 + '･' + '｢' + date + '｣' + '.' + ' ' + name + ' ' + publisher;
// }
// }
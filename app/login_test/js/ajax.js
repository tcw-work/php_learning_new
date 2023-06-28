    //Ajaxでfunction/save.phpと非同期通信

function ajaxSubmit(formClass, formUrl) {//.myForm、urlの値はそれぞれのファイルで引数として設定したいので、関数にしておく
    $(document).ready(function() { //ページの読み込みが完了するまでコードの実行を待つ
        $(formClass).on('submit', function(event) { //.on()メソッドでsubmitのイベントが発生したときに実行。
            //上記event引数はイベント発生時にイベントハンドラが自動で生成し、引数として渡されれる。そしてそのイベントはsubmit イベントに関連する情報を含んでいるものとして定義されている
            event
        .preventDefault(); // eventオブジェクトのpreventDefault() メソッドを使い、デフォルトの動作（今回はsubmitでのフォーム送信）を停止
            // Ajaxを使用してフォームデータを非同期に送信
            $.ajax({ //非同期通信（Ajax）を行うための関数
                url: formUrl, // リクエストを送るURL
                type: 'GET', // リクエストの種類（'GET'、'POST'など）
                data: $(this)
            .serialize(), //フォームデータをシリアライズ（要素を文字列化してURLエンコード）。フォームデータを簡単にサーバーに送信する
                //↑フォーム内のすべての入力要素（テキストボックス、チェックボックス、ラジオボタン、など）からデータを取得し、それをURLエンコードした文字列として $.ajax() メソッドに渡す
                success: function(response) { //response という引数は、$.ajax() 関数によって自動的に提供される。
                    //success 関数内で response を使うことで、サーバーから返されたデータにアクセスできる。このデータは、通常、サーバーが行った処理の結果や、新たに生成されたデータなどが含まれる
                    console.log(response); // // 成功時の処理。デバッグ用にレスポンスをコンソールに出力
                    alert(response);
                },
                error: function(xhr, status, error) {
                    //xhrは404などのステータスコードやレスポンスを、statusはリクエストタイムアウトや中断などの状態、errorはサーバーから返されるNot Foundなどのエラーを表す
                    //success と errorまたは failのようなコールバック関数はajaxでよく使われる
                    console.log(error); // エラー時の処理。デバッグ用にエラー情報をコンソールに出力
                    alert(response);
                }
            });
        });
    });
}
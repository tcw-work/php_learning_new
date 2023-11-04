// 各見出しの開閉
$(document).ready(function () {
    // 最初に、side_childrensのクラスを持つ要素を非表示にする
    $('.side_parents_common .side_childrens:not(.ttl2-2)').hide();

    // side_childrens ttl2-2 クラスを持つ要素がクリックされた時の動作を定義
    $('.side_childrens.ttl2-2').click(function () {
        // thisを使用して、クリックされた要素の直下のside_childrensクラスを持つ要素を取得し、slideToggleで表示・非表示を切り替える
        $(this).nextAll('.side_childrens').slideToggle();
        $(this).toggleClass('ttl2-2_act');
    });
});


// ジェネレーターページへの遷移設定
$(document).ready(function () {
    function toggleSection(triggerClass, sectionClass, prefix) {
        // 初期状態で01を表示
        $('.' + sectionClass).hide();
        $('#' + prefix + '01').show();

        // triggerのクリックイベントをセット
        $('.' + triggerClass).click(function () {
            // すべてのsectionを非表示にする
            $('.' + sectionClass).hide();

            // クリックされた要素のクラスをチェック
            for (let i = 1; i <= 6; i++) {
                if ($(this).hasClass(prefix + '_trigger0' + i)) {
                    $('#' + prefix + '0' + i).show();

                    // actクラスの追加と削除
                    $('.side_parents_common .' + prefix + '_trigger0' + i + ', .other_box.' + prefix + '_trigger0' + i).addClass('act');
                    $('.side_parents_common .' + prefix + '_trigger:not(.' + prefix + '_trigger0' + i + '), .other_box.' + prefix + '_trigger:not(.' + prefix + '_trigger0' + i + ')').removeClass('act');
                }
            }
        });

        // 他のページからの遷移を考慮してURLのハッシュをチェック
        const hash = window.location.hash;
        if (hash && hash.startsWith('#' + prefix + '0')) {
            $('.' + sectionClass).hide(); // 一旦すべて非表示にする
            $(hash).show(); // ハッシュに対応する要素を表示

            // actクラスの追加と削除
            const num = hash.charAt(hash.length - 1);
            $('.side_parents_common .' + prefix + '_trigger0' + num + ', .other_box.' + prefix + '_trigger0' + num).addClass('act');
            $('.side_parents_common .' + prefix + '_trigger:not(.' + prefix + '_trigger0' + num + '), .other_box.' + prefix + '_trigger:not(.' + prefix + '_trigger0' + num + ')').removeClass('act');
        } else if (!hash || hash === '#') {
            $('.side_parents_common .' + prefix + '_trigger01, .other_box.' + prefix + '_trigger01').addClass('act');
        }
    }

    // 各ページの動作をセット
    toggleSection('index_trigger', 'index_section', 'index');
    toggleSection('web_trigger', 'web_section', 'web');

    // ページのURLに応じて特定の要素を表示/非表示にする

    function updateClassesForPage() {
        const currentPage = window.location.pathname;

        if (currentPage.includes("index.php")) {
            $('.side_parents_index .side_childrens:not(.ttl2-2)').show();
            $('.side_parents_index .side_childrens.ttl2-2').addClass('ttl2-2_act');
            $('.side_parents_web .side_childrens:not(.ttl2-2)').hide();
            $('.side_parents_web .side_childrens.ttl2-2').removeClass('ttl2-2_act');
        } else if (currentPage.includes("web.php")) {
            $('.side_parents_web .side_childrens:not(.ttl2-2)').show();
            $('.side_parents_web .side_childrens.ttl2-2').addClass('ttl2-2_act');
            $('.side_parents_index .side_childrens:not(.ttl2-2)').hide();
            $('.side_parents_index .side_childrens.ttl2-2').removeClass('ttl2-2_act');
        } else {
            $('.side_parents_index .side_childrens:not(.ttl2-2)').hide();
            $('.side_parents_index .side_childrens.ttl2-2').removeClass('ttl2-2_act');
            $('.side_parents_web .side_childrens:not(.ttl2-2)').hide();
            $('.side_parents_web .side_childrens.ttl2-2').removeClass('ttl2-2_act');
        }
    }

    // 初回読み込み時に実行
    updateClassesForPage();

    // ページの遷移時にもクラスの付与・削除を行う
    $(window).on('popstate', function () {
        updateClassesForPage();
    });

});


//〇ここからVueでのUI記述

//〇ジェネレーターの必衰項目入力でブクマ・クリップボードコピー活性化
const instanceMount = Vue.createApp({
    data() {
        return {
            bookName: "",
            ctrFlag: false,
            bookImage: "src/image/cmp01.png",//imgタグに設定した :src="bookImage" の初期値
            copyImage: "src/image/cmp02.png",

        };
    },
    methods: {//必須項目のinputに対してv-model="bookName" @input="checking"で設定した箇所を操作（addEventlisnerと同じ効果）
        //@inputは <input> 要素の入力イベントを監視し、イベントが発生するたびに checking() メソッドが呼び出される
        checking() {
            // 入力値が空でない場合の処理
            if (this.bookName.trim() !== "") {//trim() を使用して、文字列の先頭と末尾の空白を削除し、残った文字列が空でないことを確認
                this.ctrFlag = true;//ctrFlagにより、icon文言にクラス追加
            } else {
                this.bookImage = "src/image/cmp01.png";
                this.copyImage = "src/image/cmp02.png";
                this.ctrAct = false;
            }
        },
        handleHashTagChange() {//サイトのハッシュタグが切り替わった時のリセット処理
            //後にaddEventListenerで処理するために関数としてまとめておく（HTML側には設定しない）
            this.bookImage = "src/image/cmp01.png";//ブックマークアイコンを非活性に戻す
            this.copyImage = "src/image/cmp02.png";
            this.bookName = ""; // inputの中身をリセット
        },
        ctrInp() {//ブックマーククリック処理
            this.bookImage = "src/image/cmp01_blue.png";
        },
        ctrcopy() {//コピークリックを押したときの処理（vueだと不具合出るのでjqueryでコピペ処理うる）
            this.copyImage = "src/image/cmp02_blue.png";//アイコン活性
        }
    },
    mounted() {
        window.addEventListener('hashchange', this.handleHashTagChange);//ハッシュタグの切り替えをリアルタイムで処理
        //jsの元々の機能であるhashchangeイベントでURL のハッシュ部分が変更されたときにイベント開始し、その後のハンドラ（切り替えの関数）を実行

    }
});
instanceMount.mount('#instanceFlag');


// クリップボードにテキストをコピー（不具合出るのでjqueryで切り分け実装）
$(document).ready(function () {
    $('.copy').on('click', function () {
        // this（クリックされた.copy）に基づいて.closestを使用して親要素を見つけ、その子要素の.completeを探しvalueを取得
        var textToCopy = $(this).closest('.cmp_func').prev('.complete').val();
        //navigator オブジェクト（ユーザーのブラウザ環境に関する情報や機能をスクリプトからアクセス）の clipboard プロパティを使用
        navigator.clipboard.writeText(textToCopy).then(function () {
            // コピー成功の処理（vueの方でアイコン活性化）
            // alert(textToCopy + 'をクリップボードにコピーしました');
        })
            .catch(function (error) {
                // コピー失敗の処理
                alert('コピーに失敗しました: ' + error);
            });
    });
});


//下層ページフォーム入力のしてからボタン活性化
const keywordApp = Vue.createApp({// Vue.js 3の場合、new Vue{} の代わりにVue.createAppを使用してインスタンスを作る必要があル
    data() {
        return {
            keyword: "", //キーワードの初期値
            // isCheckboxChecked: false, // チェックボックスの状態
            isCheckboxChecked: [] // 選択されたチェックボックスの値を配列で保持することで、各チェックボックスの状態を個別に識別できるようなる（これをしないと一つチェックを入れただけで、全てにチェックが入ってしまう）
            //一つのチェックボックスの状態が変化する（チェックされる/チェックが外れる）と、その変化がisCheckboxCheckedに反映され、全てのチェックボックス（v-model="isCheckboxChecked"）がその同じ状態を共有することになるので配列に入れて、識別させる
        };
    },
    computed: {// keywordAppでマウントされた要素の中で変更（ここでは入力）があるかどうかを監視する計算プロパティ
        //isSubmitDisabledメソッドはkeywordと依存関係にあるため、keywordに変更があれば、送信ボタンもVueの機能によって双方向にバインドされるため再評価される
        isSubmitDisabled() {//フォーム入力の場合
            return this.keyword.trim() === "";//keywordが空の場合ture（disabled適応）。変更があればcomputedの監視によって自動的にfalseへと再評価
        },
        isDeleteSubmitDisabled() {//チェックボックスの場合
            // return !this.isCheckboxChecked;
            return this.isCheckboxChecked.length === 0; // チェックボックスが選択されていなければ削除ボタンを無効化
            //後半はisCheckboxChecked（チェック）の入った値が1個以上ある場合に、という条件式
        },
        buttonClass() {
            return {
                act: this.keyword.trim() !== "" || this.isCheckboxChecked.length > 0 // 入力値があるか、チェックボックスが選択されていれば「act」クラス追加
            };
        }
    },
    methods: {
    }
});
keywordApp.mount("#keywordApp");//#keywordAppをマウント




//モーダル処理 start（ajaxのHTML領域をインスタンスの中にいれると非同期通信が行われなくなるので注意）
const modal_mount = Vue.createApp({
    data() { //どんなデータがあるのかを定義。
        //プロパティ名:値　で定義した要素をdataとして受けとる
        return {
            hasMessage: false, //:class="{ 'message_active': hasMessage }"はfalseの状態でスタート
        };
    },
    methods: { //methodはイベントやユーザーアクションに対する応答として使用
        //たとえば、methodではボタンがクリックされたときの処理や、データを更新するためのカスタムメソッドを定義することができる
        removeModalActive() { //clickディレクティブが押されたら
            this.hasMessage = false; //falseに変更（下記の条件分岐によりtrueになってない限りは発火しない）
            document.body.classList.remove('overflow_active'); //bodyからスクロール禁止クラス削除
            window.location.replace("/");//closeボタン押したらリダイレクト（これしないとajaxのJSが動かない）
        },
        checkAndAddOverflowClass() {
            // 「<div class="message">」の中にP子要素がある場合、データを変更してVue.jsがDOMを更新
            if ($('.message').children('p').length >
                0) { //:class="{ 'message_active': hasMessage }"がtueの状態でスタート
                this.hasMessage = true; //{ 'message_active': hasMessage }をtrueに変更
                document.body.classList.add('overflow_active'); //bodyからスクロール禁止クラス追加
                $('.modal').addClass('modal_active');//ajaxタグの親子関係の問題でここで処理
            }
        },
    },
    mounted() { // Vue インスタンスが DOM にマウントされた後に実行されるライフサイクルフック（条件分岐のような初期化処理はここで行う）
        //Vueインスタンスの生成→データとテンプレートが結びつ→実際の DOM に挿入された時点で mounted フックが呼ばれる（methodsよりも早い）
        this.checkAndAddOverflowClass();
        //このVue インスタンスが DOM にマウントされた瞬間にこの処理　checkAndAddOverflowClass();　を行うことで、条件分岐によって要素を適切に出し分けている
    },
});

modal_mount.mount('#modal_mount');
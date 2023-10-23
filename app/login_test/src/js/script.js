// 各見出しの開閉
$(document).ready(function() {
    // 最初に、side_childrensのクラスを持つ要素を非表示にする
    $('.side_parents_common .side_childrens:not(.ttl2-2)').hide();

    // side_childrens ttl2-2 クラスを持つ要素がクリックされた時の動作を定義
    $('.side_childrens.ttl2-2').click(function() {
        // thisを使用して、クリックされた要素の直下のside_childrensクラスを持つ要素を取得し、slideToggleで表示・非表示を切り替える
        $(this).nextAll('.side_childrens').slideToggle();
        $(this).toggleClass('ttl2-2_act');
    });
});


// SPメインタイトルクリック時の開閉
$(document).ready(function() {
    // 最初に、side_childrensのクラスを持つ要素を非表示にする
    // $('.side_parents_common .side_childrens:not(.ttl2-2)').hide();

    // side_childrens ttl2-2 クラスを持つ要素がクリックされた時の動作を定義
    $('.side_parents_mainTtl').click(function() {
        // thisを使用して、クリックされた要素の直下のside_childrensクラスを持つ要素を取得し、slideToggleで表示・非表示を切り替える
        $(this).nextAll('.side_parents:not(.side_parents_mainTtl)').slideToggle();
        $(this).toggleClass('act');
        $(".side_wrap").toggleClass('act');
        $("body").toggleClass('act_hidden');
    });
});

// ジェネレーターページへの遷移設定
$(document).ready(function() {
    function toggleSection(triggerClass, sectionClass, prefix) {
        // 初期状態で01を表示
        $('.' + sectionClass).hide();
        $('#' + prefix + '01').show();

        // triggerのクリックイベントをセット
        $('.' + triggerClass).click(function() {
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
$(window).on('popstate', function() {
    updateClassesForPage();
});

});

$(document).ready(function() {
    // ページが読み込まれたときの処理

    // 「<div class="message">」の中に子要素があるか確認
    if ($('.message').children('p').length > 0) {
      // 子要素がある場合、<main>に「modal_active」クラスを追加
      $('.modal').addClass('modal_active');
      $('.message').addClass('message_active');
      $('body').addClass('overflow_active');
    }
  });
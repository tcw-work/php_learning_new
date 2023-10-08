<aside>
    <div class="side">
        <div class="side_wrap">
            <div class="message">
                <?php
			if (isset($_GET['correct_message'])) {//regiter.phpから
				$correct_message = urldecode($_GET['correct_message']);
				echo "<p>" . "登録メールを送りました！" . "</p>";
			}
			if (isset($_GET['activate_message'])) {//acivate.phpから
				$activate_message = urldecode($_GET['activate_message']);
				echo "<p>" . "登録が完了しました！" . "</p>";
			}
			if (isset($_GET['mailTrue_message'])) {//mail.phpから
				$mailTrue_message = urldecode($_GET['mailTrue_message']);
				echo "<p>" . "メールを送信しました！" . "</p>";
			}
			if (isset($_GET['mailFalse_message'])) {//mail.phpから
				$mailFalse_message = urldecode($_GET['mailFalse_message']);
				echo "<p>" . "メール送信に失敗しました..." . "</p>";
			}
			?>
            </div>
            <div class="side_parents side_parents_mainTtl">
                <h1 class="ttl f_24"><a href="/coding/local_coding/php_learning/app/login_test/">Suorce Pack</a>
                    <span class="triangle is_sp"></span>
                </h1>
            </div>

            <div class="side_parents side_parents_session">
                <div class="login">
                    <?php
					include 'common/session.php';//ログイン前後の出し分けを要素を管理
					session_part_01($script);
				?>
                </div>
            </div>
            <div class="side_parents side_parents_common side_parents_func">
                <p class="side_childrens ttl2-2"><img src="src/image/side_func.png" alt="">便利機能
                    <span class="triangle"></span>
                </p>
                <a href="profile.php" class="side_childrens">保存履歴</a>
                <a href="record.php" class="side_childrens">データベースから検索</a>
                <a href="mail/contact.php" class="side_childrens">お問い合わせページ</a>
                <a href="mail/notice_mail.php" class="side_childrens">メール一斉送信実行（管理者用）</a>
                <a href="api/library.php" class="side_childrens">国立国会図書館データベース</a>
            </div>
            <div class="side_parents side_parents_common side_parents_index">
                <p class="side_childrens ttl2-2"><img src="src/image/side_icon01.png" alt="">著書から出典を作る
                    <span class="triangle"></span>
                </p>
                <p class="side_childrens index_trigger index_trigger01"><a href="index.php#index01">作者が一人の場合</a></p>
                <p class="side_childrens index_trigger index_trigger02"><a href="index.php#index02">作者が複数の場合</a></p>
                <p class="side_childrens index_trigger index_trigger03"><a href="index.php#index03">外国人作者・翻訳の場合</a></p>
                <p class="side_childrens index_trigger index_trigger04"><a href="index.php#index04">論文から出典する場合</a></p>
                <p class="side_childrens index_trigger index_trigger05"><a
                        href="index.php#index05">本に掲載された論文から出典する場合</a>
                </p>
            </div>
            <div class="side_parents side_parents_common side_parents_web">
                <p class="side_childrens ttl2-2"><img src="src/image/side_icon01.png" alt="">Web情報から出典を作る
                    <span class="triangle"></span>
                </p>
                <p class="side_childrens web_trigger web_trigger01"><a href="web.php#web01">WEBサイト(全体)から出典する場合</a>
                </p>
                <p class="side_childrens web_trigger web_trigger02"><a href="web.php#web02">サイト内の記事・論文を出典する場合</a></p>
                <p class="side_childrens web_trigger web_trigger03"><a href="web.php#web03">>作者が複数のサイト内の記事・論文を出典する場合</a>
                </p>
                <p class="side_childrens web_trigger web_trigger04"><a href="web.php#web04">オンラインジャーナルから出典する場合</a></p>
            </div>
            <!--
			<div class="side_childrens"><a href="register_form.php">新規登録する</a></div>
			<div class="side_childrens"><p>レベル</p></div>
-->

        </div>
    </div>
</aside>
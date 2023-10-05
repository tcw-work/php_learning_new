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
			<div class="side_parents">
				<h1 class="ttl f_24"><a href="/coding/local_coding/php_learning/app/login_test/">Suorce Pack</a></h1>
			</div>
           
            <div class="side_parents">
                <div class="login">
                    <?php
					include 'common/session.php';//ログイン前後の出し分けを要素を管理
					session_part_01($script);
				?>
                </div>
            </div>
            
			<div class="side_parents side_parents_common side_parents_book">
				<p class="side_childrens ttl2-2"><img src="src/image/side_icon01.png" alt="">著書から出典を作る</p>
				<p class="side_childrens"><a href="book/book01.php">作者が一人の場合</a></p>
				<p class="side_childrens"><a href="book/book02.php">作者が複数の場合</a></p>
				<p class="side_childrens"><a href="book/book03.php">外国人作者・翻訳の場合</a></p>
				<p class="side_childrens"><a href="book/book04.php">論文から出典する場合</a></p>
				<p class="side_childrens"><a href="book/book05.php">本に掲載された論文から出典する場合</a></p>
			</div>
			<div class="side_parents side_parents_common side_parents_web">
				<p class="side_childrens ttl2-2"><img src="src/image/side_icon01.png" alt="">Web情報から出典を作る</p>
				<p class="side_childrens"><a href="book/book01.php">WEBサイト(全体)から出典する場合</a></p>
				<p class="side_childrens"><a href="book/book02.php">サイト内の記事・論文を出典する場合</a></p>
				<p class="side_childrens"><a href="book/book03.php">作者が複数のサイト内の記事・論文を出典する場合</a></p>
				<p class="side_childrens"><a href="book/book04.php">オンラインジャーナルから出典する場合</a></p>
			</div>
            <!--
			<div class="side_childrens"><a href="register_form.php">新規登録する</a></div>
			<div class="side_childrens"><p>レベル</p></div>
-->
			<div class="side_parents side_parents_common side_parents_func">
				<p class="side_childrens ttl2-2"><img src="src/image/side_func.png" alt="">便利機能</p>
				<a href="profile.php" class="side_childrens">プロフィールページ</a>
				<a href="record.php" class="side_childrens">データベースから検索委</a>
				<a href="mail/contact.php" class="side_childrens">お問い合わせページ</a>
				<a href="mail/notice_mail.php" class="side_childrens">メール一斉送信実行（管理者用）</a>
				<a href="api/library.php" class="side_childrens">国立国会図書館データベース</a>
			</div>
			
        </div>
    </div>
</aside>
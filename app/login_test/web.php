<!DOCTYPE html>
<html lang="ja">

	<?php include 'includes/header.php'; ?>

	<body>
		<div class="wrap">
			<?php include 'includes/side.php'; ?>
			<main class="index">
				<div class="decoration">
					<p>Source Pack</p>
				</div>

				<section id="web01" class="web_section">
					<form action="function/save.php" method="GET" class="myForm">
						<h2 class="common_ttl">WEBサイト(全体)から出典する場合</h2>
						<input type="text" name="auther01" class="auther01" placeholder="執筆者/組織名" oninput="updateComplete1()">
						<input type="hidden" name="auther02" class="auther02" placeholder="執筆者/組織名02">
						<input type="hidden" name="auther03" class="auther03" placeholder="執筆者/組織名03">
						<input type="text" name="date" class="date" placeholder="更新日" oninput="updateComplete1()">
						<input type="text" name="name" class="name" placeholder="Webサイトの名前" oninput="updateComplete1()">
						<input type="text" name="url" class="url required" placeholder="URL（必須）" oninput="updateComplete1()">
						<input type="text" name="access" class="access" placeholder="最後にアクセスした日付" oninput="updateComplete1()">
						<div class="cmp_box">
							<div class="cmp_in">
								<p>入力したらこの下の内容が自動で切り替わるよ！</p>
							</div>
							<p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
							<input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
							<div class="cmp_func">
								<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存"
																							 class="submit" disabled></p>
								<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
							</div>
						</div>
					</form>
				</section>

		<section id="web02" class="web_section">
        <form action="function/save.php" method="GET" class="myForm">
			<h2 class="common_ttl">サイト内の記事・論文を出典する場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="執筆者/組織名" oninput="updateComplete2()">
            <input type="hidden" name="auther02" class="auther02" placeholder="執筆者/組織名02">
            <input type="hidden" name="auther03" class="auther03" placeholder="執筆者/組織名03">
            <input type="text" name="date" class="date" placeholder="更新日" oninput="updateComplete2()">
            <input type="text" name="heading" class="heading" placeholder="ページ名 or 資料名" oninput="updateComplete2()">
            <input type="text" name="name" class="name" placeholder="Webサイトの名前" oninput="updateComplete2()">
			<input type="text" name="url" class="url required" placeholder="URL（必須）" oninput="updateComplete2()">
            <input type="text" name="access" class="access" placeholder="最後にアクセスした日付" oninput="updateComplete2()">
			<div class="cmp_box">
				<div class="cmp_in">
					<p>入力したらこの下の内容が自動で切り替わるよ！</p>
				</div>
				<p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
				<input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				<div class="cmp_func">
					<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存"
																				 class="submit" disabled></p>
					<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
				</div>
			</div>
        </form>
		</section>
			<section id="web03" class="web_section">
        <form action="function/save.php" method="GET" class="myForm">
			<h2 class="common_ttl">作者が複数のサイト内の記事・論文を出典する場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="執筆者/組織名" oninput="updateComplete3()">
            <input type="text" name="auther02" class="auther02" placeholder="執筆者/組織名02" oninput="updateComplete3()">
            <input type="text" name="auther03" class="auther03" placeholder="執筆者/組織名03" oninput="updateComplete3()">
            <input type="text" name="date" class="date" placeholder="更新日" oninput="updateComplete3()">
            <input type="text" name="heading" class="heading" placeholder="ページ名 or 資料名" oninput="updateComplete3()">
            <input type="text" name="name" class="name" placeholder="Webサイトの名前" oninput="updateComplete3()">
			<input type="text" name="url" class="url required" placeholder="URL（必須）" oninput="updateComplete3()">
            <input type="text" name="access" class="access" placeholder="最後にアクセスした日付" oninput="updateComplete3()">
			<div class="cmp_box">
				<div class="cmp_in">
					<p>入力したらこの下の内容が自動で切り替わるよ！</p>
				</div>
				<p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
				<input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				<div class="cmp_func">
					<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存"
																				 class="submit" disabled></p>
					<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
				</div>
			</div>
        </form>
		</section>
		
		<section id="web04" class="web_section">
        <form action="function/save.php" method="GET" class="myForm">
			<h2 class="common_ttl">オンラインジャーナルから出典する場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="執筆者/組織名" oninput="updateComplete4()">
            <input type="hidden" name="auther02" class="auther02" placeholder="執筆者/組織名02">
            <input type="hidden" name="auther03" class="auther03" placeholder="執筆者/組織名03">
            <input type="text" name="date" class="date" placeholder="更新日" oninput="updateComplete4()">
            <input type="text" name="thesis" class="thesis" placeholder="論文の名前" oninput="updateComplete4()">
            <input type="text" name="medium" class="medium" placeholder="論文が掲載された書籍名" oninput="updateComplete4()">
            <input type="text" name="name" class="name" placeholder="Webサイトの名前" oninput="updateComplete4()">
            <input type="text" name="volum" class="volum" placeholder="巻数" oninput="updateComplete4()">
            <input type="text" name="number" class="number" placeholder="号数" oninput="updateComplete4()">
            <input type="text" name="page" class="page" placeholder="初めのページ番号" oninput="updateComplete4()">
            <input type="text" name="page02" class="page02" placeholder="終わりのページ番号" oninput="updateComplete4()">
            <!-- <input type="text" name="heading" class="heading" placeholder="ページ名 or 資料名" oninput="updateComplete4()"> -->
			<input type="text" name="url" class="url required" placeholder="URL(必須)" oninput="updateComplete4()">
            <input type="text" name="access" class="access" placeholder="最後にアクセスした日付" oninput="updateComplete4()">
			<div class="cmp_box">
				<div class="cmp_in">
					<p>入力したらこの下の内容が自動で切り替わるよ！</p>
				</div>
				<p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
				<input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				<div class="cmp_func">
					<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存"
																				 class="submit" disabled></p>
					<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
				</div>
			</div>
        </form>
		</section>
			<p class="comlete_disp"></p>
				<section>
					<h2 class="common_ttl">Webの色々なパターンを試す</h2>
					<div class="other_pattern">
						<a href="web.php#web01" class="other_box web_trigger web_trigger01">
							<h2>
								<p class="box_num">①</p>
								<p class="box_ttl">WEBサイト(全体)から出典する場合</p>
							</h2>
						</a>
						<a href="web.php#web02" class="other_box web_trigger web_trigger02">
							<h2>
								<p class="box_num">②</p>
								<p class="box_ttl">サイト内の記事・論文を出典する場合</p>
							</h2>
						</a>
						<a href="web.php#web03" class="other_box web_trigger web_trigger03">
							<h2>
								<p class="box_num">③</p>
								<p class="box_ttl">作者が複数のサイト内の記事・論文を出典する場合</p>
							</h2>
						</a>
						<a href="web.php#web04" class="other_box web_trigger web_trigger04">
							<h2>
								<p class="box_num">④</p>
								<p class="box_ttl">オンラインジャーナルから出典する場合</p>
							</h2>
						</a>
					</div>
				</section>
				
				<section>
					<h2 class="common_ttl">本の色々なパターンを試す</h2>
					<div class="other_pattern">
						<a href="index.php#index01" class="other_box index_trigger index_trigger01">
							<h2>
								<p class="box_num">①</p>
								<p class="box_ttl">作者が一人の場合</p>
							</h2>
						</a>
						<a href="index.php#index02" class="other_box index_trigger index_trigger02">
							<h2>
								<p class="box_num">②</p>
								<p class="box_ttl">作者が複数の場合</p>
							</h2>
						</a>
						<a href="index.php#index03" class="other_box index_trigger index_trigger03">
							<h2>
								<p class="box_num">③</p>
								<p class="box_ttl">外国人作者・翻訳の場合</p>
							</h2>
						</a>
						<a href="index.php#index04" class="other_box index_trigger index_trigger04">
							<h2>
								<p class="box_num">④</p>
								<p class="box_ttl">論文から出典する場合</p>
							</h2>
						</a>
						<a href="index.php#index05" class="other_box index_trigger index_trigger05">
							<h2>
								<p class="box_num">⑤</p>
								<p class="box_ttl">本に掲載された論文から出典する場合</p>
							</h2>
						</a>
					</div>
				</section>

			</main>
		</div>

		<?php include 'includes/footer.php'; ?>
		<script src="src/js/disp02.js"></script>
	</body>

</html>

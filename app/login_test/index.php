<?php include 'includes/header.php'; ?>


<?php include 'includes/side.php'; ?>
<main class="index">
    <div id="modal_mount">
        <!-- modal用Vueインスタンスstart -->
        <!-- プロパティ名:値　で定義 -->
        <div class="message" :class="{ 'message_active': hasMessage }">
            <div class="close" v-on:click="removeModalActive"></div>
            <?php
			// if (isset($_GET['correct_message'])) {//regiter.phpから
			// 	$correct_message = urldecode($_GET['correct_message']);
			// 	echo "<p>" . "登録メールを送りました！" . "</p>";
			// }
			if (isset($_GET['activate_message'])) {//acivate.phpから
				$activate_message = urldecode($_GET['activate_message']);
				echo "<h2>" . "登録が完了しました！" . "</h2>";
                echo "<p>" . "早速参考文献から出典を作って、保存、検索機能などを使ってみましょう！" . "</p>";
			}
			if (isset($_GET['mailTrue_message']) && $_GET['mailTrue_message'] == 'registerSend')  {//mail.phpから（register.php経由）
				echo "<h2>" . "認証メールを送信しました" . "</h2>";
				echo "<p>" . "当サービスを利用するには、登録されたメールアドレス宛に送られた認証フォームをクリックしてください。" . "<br>". "その後、登録ログインが完了となります。" . "</p>";
                echo "<p>" . "※もし認証メールが届かない場合は、メールアドレスに不備がないか、迷惑メールに割り振られていないかをご確認ください" . "</p>";
			}
			if (isset($_GET['mailFalse_message'])) {//mail.phpから
				$mailFalse_message = urldecode($_GET['mailFalse_message']);
				echo "<p>" . "メール送信に失敗しました..." . "</p>";
			}
            if (isset($_GET['mailTrue_message']) && $_GET['mailTrue_message'] == 'contactSend') {//mail.phpから（contact.php経由）
				echo "<h2>" . "お問い合わせメールを送信しました" . "</h2>";
				echo "<p>" . "メールの返信には数日～数週間かかる場合がございますので、ご了承ください" . "<br>". "<br>". "よろしくお願いいたします。" . "</p>";
			}
			?>
        </div>
    </div><!-- modal用Vueインスタンス終了 -->

    <div id="instanceFlag">

        <section id="index01" class="index_section">
            <form action="function/save.php" method="GET" class="myForm">
                <h2 class="common_ttl">作者が一人の場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete1()">
                <input type="hidden" name="auther02" class="auther02" placeholder="作者名02">
                <input type="hidden" name="auther03" class="auther03" placeholder="作者名03">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete1()">
                <input type="text" name="name" class="name required" placeholder="本の名前（必須）" oninput="updateComplete1()"
                    v-model="bookName" @input="checking">
                <!-- @inputは <input> 要素の入力イベントを監視し、イベントが発生するたびに checking() メソッドが呼び出される -->
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete1()">

                <div class="cmp_box">
                    <div class="cmp_in">
                        <p>入力したらこの下の内容が自動で切り替わるよ！</p>
                    </div>

                    <p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
                    <input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
                    <div class="cmp_func">
                        <p><span><img :src=" bookImage" alt=""></span><input type="submit" value="保存" class="submit"
                                v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrInp" disabled></p>
                        <p class="copy" v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrcopy"><span><img
                                    :src=" copyImage" alt="">
                            </span>コピー</p>
                    </div>
                </div>
            </form>
        </section>
        <section id="index02" class="index_section">
            <form action="function/save.php" method="GET" class="myForm">
                <h2 class="common_ttl">作者が複数の場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名01" oninput="updateComplete2()">
                <input type="text" name="auther02" class="auther02" placeholder="作者名02" oninput="updateComplete2()">
                <input type="text" name="auther03" class="auther03" placeholder="作者名03" oninput="updateComplete2()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete2()">
                <input type="text" name="name" class="name required" placeholder="本の名前（必須）" oninput="updateComplete2()"
                    v-model="bookName" @input="checking">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete2()">
                <div class="cmp_box">
                    <div class="cmp_in">
                        <p>入力したらこの下の内容が自動で切り替わるよ！</p>
                    </div>
                    <p class="complete_disp" ref="completeText">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
                    <input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
                    <div class="cmp_func">
                        <p><span><img :src=" bookImage" alt=""></span><input type="submit" value="保存" class="submit"
                                v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrInp" disabled></p>
                        <p class="copy" v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrcopy"><span><img
                                    :src=" copyImage" alt="">
                            </span>コピー</p>
                    </div>
                </div>
            </form>
        </section>

        <section id="index03" class="index_section">
            <form action="function/save.php" method="GET" class="myForm">
                <h2 class="common_ttl">外国人作者・翻訳の場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete3()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete3()">
                <input type="text" name="name" class="name required" placeholder="本の名前（必須）" oninput="updateComplete3()"
                    v-model="bookName" @input="checking">
                <input type="text" name="translator" class="translator" placeholder="翻訳者の名前"
                    oninput="updateComplete3()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete3()">
                <div class="cmp_box">
                    <div class="cmp_in">
                        <p>入力したらこの下の内容が自動で切り替わるよ！</p>
                    </div>
                    <p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
                    <input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
                    <div class="cmp_func">
                        <p><span><img :src=" bookImage" alt=""></span><input type="submit" value="保存" class="submit"
                                v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrInp" disabled></p>
                        <p class="copy" v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrcopy"><span><img
                                    :src=" copyImage" alt="">
                            </span>コピー</p>
                    </div>
                </div>
            </form>
        </section>

        <section id="index04" class="index_section">
            <form action="function/save.php" method="GET" class="myForm">
                <h2 class="common_ttl">論文から出典する場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete4()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete4()">
                <input type="text" name="name" class="name required" placeholder="論文の名前（必須）" oninput="updateComplete4()"
                    v-model="bookName" @input="checking">
                <input type="text" name="thesis" class="thesis" placeholder="論文がかかれた書籍名" oninput="updateComplete4()">
                <input type="text" name="page" class="page" placeholder="ページ番号(数字のみ)" oninput="updateComplete4()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete4()">
                <div class="cmp_box">
                    <div class="cmp_in">
                        <p>入力したらこの下の内容が自動で切り替わるよ！</p>
                    </div>
                    <p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
                    <input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
                    <div class="cmp_func">
                        <p><span><img :src=" bookImage" alt=""></span><input type="submit" value="保存" class="submit"
                                v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrInp" disabled></p>
                        <p class="copy" v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrcopy"><span><img
                                    :src=" copyImage" alt="">
                            </span>コピー</p>
                    </div>
                </div>
            </form>
        </section>

        <section id="index05" class="index_section">
            <form action="function/save.php" method="GET" class="myForm">
                <h2 class="common_ttl">本に掲載された論文から出典する場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete5()">
                <input type="text" name="editor" class="editor" placeholder="編者名" oninput="updateComplete5()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete5()">
                <input type="text" name="thesis" class="thesis" placeholder="論文がかかれた書籍名" oninput="updateComplete5()">
                <input type="text" name="name" class="name required" placeholder="論文の名前（必須）" oninput="updateComplete5()"
                    v-model="bookName" @input="checking">
                <input type="text" name="page" class="page" placeholder="ページ番号①(数字のみ)" oninput="updateComplete5()">
                <input type="text" name="page02" class="page02" placeholder="ページ番号②(数字のみ)" oninput="updateComplete5()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete5()">
                <div class="cmp_box">
                    <div class="cmp_in">
                        <p>入力したらこの下の内容が自動で切り替わるよ！</p>
                    </div>
                    <p class="complete_disp">例：作者名 (発行日) ｢本の名前｣ 出版社</p>
                    <input type="hidden" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
                    <div class="cmp_func">
                        <p><span><img :src=" bookImage" alt=""></span><input type="submit" value="保存" class="submit"
                                v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrInp" disabled></p>
                        <p class="copy" v-bind:class="{ 'ctrAct': ctrFlag }" @click="ctrcopy"><span><img
                                    :src=" copyImage" alt="">
                            </span>コピー</p>
                    </div>
                </div>
            </form>
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
        <section>
            <h2 class="common_ttl">Webからの出典を作る</h2>
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
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<script src="src/js/disp01.js"></script>
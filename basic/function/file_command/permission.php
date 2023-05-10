<h2>権限に関するコマンド（windows）</h2>
<br><br>

<h3>読み書き許可を与えるパーミッションコマンド　（↓ユーザーとグループに読み取りと書き込み許可を与える）</h3>
<br>
icacls text03.txt /grant:r "OWNER:(RX,W)" "GROUP:(RX,W)"<br><br>
↓テキストファイルの情報を表示する<br>
dir /q text03.txt<br>
<br>

<h3>全ての権限を削除する（すべてのユーザーに対して、読み書き実行許可を削除する）</h3>
icacls text03.txt /inheritance:r /remove *.*<br>
↓テキストファイルの情報を表示する<br>
dir /q text03.txt<br>
<br>

<h3>ユーザーとグループに読み込み許可を与える</h3>
icacls text03.txt /grant:r "USER:(r)"
icacls text03.txt /grant:r "GROUP:(r)"
↓テキストファイルの情報を表示する<br>
dir /q text03.txt<br>

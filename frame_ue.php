<html>
<head><title>Headframe</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript" src="is_login.php"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.tooltipster.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link rel="stylesheet" href="css/zaichu.css" />
<script src="js/zaichu.js"></script>
<style type="text/css">
.css_btn_class {
  
  font-size:10px;
  font-family:Arial;
  font-weight:normal;
  -moz-border-radius:6px;
  -webkit-border-radius:6px;
  border-radius:6px;
  border:1px solid #ededed;
  padding:7px 12px;
  text-decoration:none;
  background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
  background:-ms-linear-gradient( top, #dfdfdf 5%, #ededed 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
  background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #dfdfdf), color-stop(100%, #ededed) );
  background-color:#ededed;
  color:#777777;
  display:inline-block;
  margin-top: 8px;
}.css_btn_class:hover {
    background:-moz-linear-gradient( center top, #ededed 5%, #ededed 100% );
      background:-ms-linear-gradient( top, #ededed 5%, #ededed 100% );
      filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ededed');
        background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #ededed), color-stop(100%, #ededed) );
        background-color:#ededed;
        }.css_btn_class:active {
  position:relative;
  top:1px;
}
/* This css button was generated by css-button-generator.com */
</style>
<script type="text/javascript">
$(document).ready(function(){
AtoZCount=0;
    $('#UNAME').autocomplete({
        source: function(request, response){
            $.ajax({
                url: "http://completion.amazon.co.jp/search/complete",
                data: {mkt:'6', method:'completion', 'search-alias':'aps', q: request.term},
                dataType: "jsonp",
                type: "GET",
                success :function(data) {
                    response(data[1]);
                }
            });
        },
        delay: 300
    });
});

function key_srch( str ){
	document.usend.NAME.value=str;
	document.usend.submit();
}

function put_his(){
	str=document.usend.NAME.value;
	strs="<span class='keys'><a href='#'  onclick=key_srch('"+str+"')>" + str + "</a></span>  ";
	$("div.shistory").prepend(strs);
}

</script>

</head>

<body style="background-color:#ccc;">

<form  method="get" action="frame_shita.php" target="shita" accept-charset="utf-8" name=usend id=usend>
<span  class="tooltip" title="入力したキーワードでAmazon予測検索を表示しています。全て見るにはスクロールするか、このフレームを広げて下さい。">
 <input type="text" name="NAME" value="" ID="UNAME" size="40">
</span>
<select name="search-alias" class="tooltip" title="通常はすべてのカテゴリーで検索してください">
<option selected="selected" value="aps">すべてのカテゴリー</option>
<option value="digital-text">Kindleストア </option>
<option value="instant-video">Amazon インスタント・ビデオ</option>
<option value="digital-music">デジタルミュージック</option>
<option value="mobile-apps">Androidアプリ</option>
<option value="stripbooks">本</option>
<option value="english-books">洋書</option>
<option value="popular">ミュージック</option>
<option value="classical">クラシック</option>
<option value="dvd">DVD</option>
<option value="videogames">TVゲーム</option>
<option value="software">PCソフト</option>
<option value="computers">パソコン・周辺機器</option>
<option value="electronics">家電&amp;カメラ</option>
<option value="office-products">文房具・オフィス用品</option>
<option value="kitchen">ホーム&キッチン</option>
<option value="pets">ペット用品</option>
<option value="hpc">ヘルス&ビューティー</option>
<option value="beauty">コスメ</option>
<option value="food-beverage">食品&飲料</option>
<option value="baby">ベビー&マタニティ</option>
<option value="apparel">服＆ファッション小物</option>
<option value="shoes">シューズ＆バッグ</option>
<option value="watch">腕時計</option>
<option value="jewelry">ジュエリー</option>
<option value="toys">おもちゃ</option>
<option value="hobby">ホビー</option>
<option value="mi">楽器</option>
<option value="sporting">スポーツ&アウトドア</option>
<option value="automotive">カー・バイク用品</option>
<option value="diy">DIY・工具</option>
<option value="appliances">大型家電</option>
<option value="financial">クレジットカード</option>
<option value="gift-cards">ギフト券</option>

	</select>
        <span>
	<input type="submit" class="css_btn_class"value="submit" onclick="put_his()">
	<input type="reset" value="クリアー" class="css_btn_class" >
	
	&nbsp&nbsp
	<input type="checkbox" name="AutoSend" id="AutoSend" value="AutoSend" class="css_btn_class">自動追加
	&nbsp&nbsp
        </span>


        <span style="border:1px solid #aaaaaa;">
	<button type="button" onClick="Start_AtoZ();"  title="AtoZスタート" class="css_btn_class">AtoZスタート</button>
	<input type="checkbox" name="AtoZ" id="AtoZ" value="AtoZ">開始/停止

            	<input type="text" name="AtoZst" id="AtoZst" value="" size=1 disabled>/
	<input type="text" name="AtoZst2" id="AtoZst2" value="" size=1 disabled>
	<input type="text" name="BaseKeyword" id="BaseKeyword" value="" size=1 disabled>
<a href="login.php?actioin=logout" target="_top">ログアウト</a>|
<?php 
			 session_start();
			 if($_SESSION['is_admin'] == 1){
?>
<a href="user_list.php" target="_blank" >ユーザーリスト</a>
<?php
			 }
?>
        </span>

</form>

検索履歴<br>
<div class="shistory" id="shistory">
</div>

<br><br><br><br><br><br>
<a href="change_password.php" target="_blank" >パスワード修正</a>

</body>
</html>
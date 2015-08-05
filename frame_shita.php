
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php// error_reporting(~E_ALL & ~E_NOTICE);?>
<?php include('common.php'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>Amazon Suggetion</title>
<meta name="robots" content="noindex,nofollow">
<noscript>javascriptを有効にしてください</noscript>
<script type="text/javascript" src="is_login.php"></script>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>

<script src="js/jquery.tooltipster.min.js"></script>
<script src="js/zaichu.js"></script>

<link rel="stylesheet" href="css/zaichu.css" />
<link rel="stylesheet" href="css/tree.css" />
<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<?php
$name = isset($_GET["NAME"]) ? htmlspecialchars($_GET["NAME"]) : null; 
$search_alias = isset($_GET["search-alias"]) ? htmlspecialchars($_GET["search-alias"]) : null; 

?>

<?php if ($name && $search_alias){ ?>
<script language="javascript">
<!--

  //ページ読み込み完了時に実行される
  $(function(){
    $('.tooltip').tooltipster(); 


    if(parent.ue.document.usend.AutoSend.checked){
      myclick("matomete");
    }

    if(parent.ue.document.usend.AtoZ.checked){
      Cont_AtoZ();
    }

  });
-->
  </script>

                          </head>
                          <body style="background-color:#ccc;">

                          <H3>検索キーワード→『<?php echo $name ?>』　　　　　　
                          </H3><form name="send" method="get" action="frame_shita.php" target="shita" accept-charset="utf-8">
                          <input type="hidden" name="NAME" value="#">
                          <input type="hidden" name="search-alias" value="<?php echo $search_alias; ?>">
                          <input type="hidden" name="keyword" value="><?php echo $name; ?>">
                          </form>
<?php 
$domain = "http://completion.amazon.co.jp";
$url = $domain."/search/complete?callback=jQuery21109252729036379606_1438666319334&mkt=6&method=completion&search-alias=".urlencode($search_alias)."&q=".urlencode($name)."&_=1438666319335";
$html = file_get_contents($url);
preg_match('/\((.+?)\)/',$html,$m);
$res =  $m[1];
preg_match("/\[.+?\[(.+?)\]/",$res,$r);
preg_match_all("/\"(.+?)\"/",$r[1],$re);
preg_match_all('/\"alias\":\"(.+?)\"/',$res,$out);
echo count($out[1]);
// var_dump($out);
//$json = json_decode($res);
// var_dump($json["test"]);
?>

  <div class="Cates"><b>検索結果</b>・・・カテゴリ　→　<?php echo category_case($search_alias); ?><br><br>
  <span class='tooltip' title='クリックすると『<?php echo $name;  ?>』をテキストエリアに追加'>
  <span class="keys"><a href="#a" onClick="PutB('<?php echo $name;?>')"><?php echo $name; ?> </a></span>
  </span>&nbsp
<?php
// echo "<ul class='tree'>";
// echo "<li id='tree1'>". $name ."</li>";
// echo "</ul>";
echo "<br><br>";
foreach ($re[1] as &$value){
  echo "<span class='tooltip' title='クリックすると『".$value."』をテキストエリアに追加'>";
  echo '<span class="keys"> <a href="#a" onClick="PutB(';
  echo "'";
  echo $value;
  echo "'";
  echo ')";>';
  echo $value;
  echo  '</a> </span>';
  echo "</span>&nbsp";

}
echo "<span class='tooltip' title='全てのまとめてキーワードがテキストエリアに追加'>";
echo '<a href="#" class="orange_bt" onClick="PutB(';
echo "'";
$all = array();
foreach ($re[1] as &$value){
  echo $value;
  $all[] = $value;
  echo "\x20";
}
echo "'";
echo ');">全て追加</a></span><br><br>';
echo '</div>';
foreach ($out[1] as $v) {
 echo '<div class="Cates">';
 echo "<span class='tooltip' title='クリックするとこのカテゴリで絞り込みます'>";
 echo '<span class="Cate">';
 echo '<a href="#" onClick="SetUe(';
 echo "'";
 echo $name;
 echo "'";
 echo ");SetAlias('popular');GoUe();";
 echo '">"'; 
 echo category_case($v);
 echo "</a>";
 echo "</span>";
 echo "</span>";
 echo "<br><br>";
  $url = $domain."/search/complete?callback=jQuery21109252729036379606_1438666319334&mkt=6&method=completion&search-alias=".urlencode($v)."&q=".urlencode($name)."&_=1438666319335";
  $html = file_get_contents($url);
  preg_match('/\((.+?)\)/',$html,$m);
  $res =  $m[1];
  preg_match("/\[.+?\[(.+?)\]/",$res,$r);
  preg_match_all("/\"(.+?)\"/",$r[1],$re);
  echo '<div class="Cates"><b>検索結果</b>・・・カテゴリ　→　'.category_case($v).'<br><br>';
  echo "<span class='tooltip' title='クリックすると『".$name."』をテキストエリアに追加'>";
  echo '<span class="keys"><a href="#a" onClick="PutB('.$name.')"><?php echo $name; ?> </a></span>';
  echo '</span>&nbsp';
  echo "<br><br>";
  foreach ($re[1] as &$value){
    echo "<span class='tooltip' title='クリックすると『".$value."』をテキストエリアに追加'>";
    echo '<span class="keys"> <a href="#a" onClick="PutB(';
    echo "'";
    echo $value;
    echo "'";
    echo ')";>';
    echo $value;
    echo  '</a> </span>';
    echo "</span>&nbsp";
    $all[] = $value;
  }
  echo "<span class='tooltip' title='全てのまとめてキーワードがテキストエリアに追加'>";
  echo '<a href="#" class="orange_bt" onClick="PutB(';
  echo "'";
  foreach ($re[1] as &$value){
    echo $value;
    echo "\x20";
  }
  echo "'";
  echo ');">全て追加</a></span><br><br>';
  echo "</div>";
// echo "<span class='tooltip' title='全てのまとめてキーワードがテキストエリアに追加'>";
  echo '</div>';
}
?>
<div class="Cates2"><span class="tooltip" title="キーワードをクリックすると、下のテキストエリアの『最後尾』へキーワードが追加。" >
<span class="matomete">まとめてキーワード</span></span>
<?php
  echo "<br><br>";
  foreach ($all as &$value){
    echo "<span class='tooltip' title='クリックすると『".$value."』をテキストエリアに追加'>";
    echo '<span class="keys"> <a href="#a" onClick="PutB(';
    echo "'";
    echo $value;
    echo "'";
    echo ')";>';
    echo $value;
    echo  '</a> </span>';
    echo "</span>&nbsp";
  }
  echo "<span class='tooltip' title='全てのまとめてキーワードがテキストエリアに追加'>";
  echo '<a href="#" class="orange_bt" onClick="PutB(';
  echo "'";
  foreach ($re[1] as &$value){
    echo $value;
    echo "\x20";
  }
  echo "'";
  echo ');">全て追加</a></span><br><br>';
?>
<br><br></div>
<BR>



<BR>
<div class="Cates">
  <a name='imo'></a>
  <span class='tooltip' title='リンクをクリックするとクリックしたキーワードで検索をします'>
  <span class="matomete">芋ずるリンク</span>
  </span>
<?php
  echo "<br><br>";
  foreach ($all as &$value){
    echo "<a class='tooltip' title='『";
    echo $value;
    echo "』で検索する'";
    echo 'href="#" onClick="document.send.NAME.value=';
    echo "'";  
    echo $value;
    echo "'";  
    echo ";SetUe(";
    echo "'";  
    echo $value;
    echo "'";  
    echo ');document.send.submit();">';
    echo $value;
    echo '</a>&nbsp&nbsp';
    echo "<br>";
  }
 ?>
<?php }else{ ?>
                          </head>
                          <body style="background-color:#ccc;">
<div>
<?php } ?>

</div>
</body>
</html>

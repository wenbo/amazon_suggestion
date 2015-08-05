<?php
function pwd_hash($a) {
	 $salt="Random_KUGBJVY";  //定义一个salt值，程序员规定下来的随机字符串
	 $b=$a.$salt;  //把密码和salt连接
	 $b=md5($b);  //执行MD5散列
	 return $b;  //返回散列    
}
function category_case($str)
{
  switch ($str) {
  case "abs":
    return "すべてのカテゴリー";
    break;
  case "digital-text":
    return "Kindleストア";
    break;
  case "instant-video":
    return "Amazon インスタント・ビデオ";
    break;
  case "instant-video":
    return "デジタルミュージック";
    break;
  case "mobile-apps":
    return "Androidアプリ";
    break;
  case "stripbooks":
    return "本";
    break;
  case "english-books":
    return "洋書";
      break;
  case "popular":
    return "ミュージック";
    break;
  case "classical":
    return "クラシック";
    break;
  case "dvd":
    return "DVD";
    break;
  case "videogames":
    return "TVゲーム";
    break;
  case "software":
    return "PCソフト";
    break;
  case "computers":
    return "パソコン・周辺機器";
    break;
  case "electronics":
    return "家電&amp;カメラ";
    break;
  case "office-products":
    return "文房具・オフィス用品";
    break;
  case "kitchen":
    return "ホーム&キッチン";
    break;
  case "pets":
    return "ペット用品";
    break;
  case "hpc":
    return "ヘルス&ビューティー";
    break;
  case "beauty":
    return "コスメ";
    break;
  case "food-beverage":
    return "食品&飲料";
    break;
  case "baby":
    return "ベビー&マタニティ";
    break;
  case "apparel":
    return "服＆ファッション小物";
    break;
  case "shoes":
    return "シューズ＆バッグ";
    break;
  case "watch": 
    return "腕時計";
    break;
  case "jewelry":
    return "ジュエリー";
    break;
  case "toys":
    return "おもちゃ";
    break;
  case "hobby":
    return "ホビー";
    break;
  case "mi":
    return "楽器";
    break;
  case "sporting":
    return "スポーツ&アウトドア";
    break;
  case "automotive":
    return "カー・バイク用品";
    break;
  case "diy":
    return "DIY・工具";
    break;
  case "appliances":
    return "大型家電";
    break;
  case "financial":
    return "クレジットカード";
  case "gift-cards":
    return"ギhフト券";
    break;
  case "tradein-aps":
    return "買取サービス";
    break;
  }
}
?>

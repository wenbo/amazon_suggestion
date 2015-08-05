var savename, savedata, savedate, selected;

function DEL_Keyword(str) {
    var txt;
    txt = document.getElementById("t_box").value;
    //str=str.replace(/\t|　/g, " ");

    var SearchString = str;
    var RegularExp = new RegExp(SearchString, "g");
    var ResString = txt.replace(RegularExp, "");

    document.getElementById("t_box").value = ResString;

}

function KeySort( ) {
    var MAX = $('#maxrow').val();

    if (MAX === "50b"|| MAX==="2000b") {
           _KeySort2(MAX);

    }
    else  {
        if ((MAX < 2) || (MAX > 5)) MAX = 5;
        _KeySort1(MAX);        
    }
    ShowLength(document.getElementById('t_box').value);
}

function _KeySort2(MAX) {
    var maxlen;
    if( MAX==="2000b"){
        maxlen=2000;
    }else{
        maxlen=50;
    }
    var str = $("#t_box").val();
    $("#t_box").val("");

    str = str.replace(/\r\n|\r|\n/, " ");
    str = str.replace(/\t|　/g, " ");
    str = str.replace(/ +/g, ' ');
    str = str.replace(/(^\s+)|(\s+$)/g, "");

    var arr = str.split(/\s/);

      
    var buf=""; 
      
    for (var i = 0; i < arr.length; i++) {
          
          var strlen=GetLength(arr[i]); 
          var buflen=GetLength(buf); 
          if (buflen>0) {
              var temp;
              temp=buf+" "+arr[i];
              buflen = GetLength(temp);
              
          }else{
              buflen=strlen;
          }
          
          if (strlen>=maxlen & GetLength(buf)===0){
              //１単語でバイトオーバー&空行
              
             var temp=$("#t_box").val();
             $("#t_box").val(temp+arr[i]+"\n"); //バッファからテキストボックスへ吐き出す
              
          }else if(buflen>=maxlen){
              //50バイトオーバー
              var temp=$("#t_box").val();
              $("#t_box").val(temp+buf+"\n"); //バッファからテキストボックスへ吐き出す
              buf=arr[i];
              
          }else if( buflen<maxlen ){//50バイト未満
              
              if(GetLength(buf)===0){
                  buf = arr[i];
              }else{
                  buf+=" "+arr[i];
              }
              
          }
          
          //カウンタが最後の処理
          if( i===arr.length-1 ){
              var temp=$("#t_box").val();
              $("#t_box").val(temp+buf); //バッファからテキストボックスへ吐き出す
              
              
          }
          
    }

}
function _KeySort1(MAX) {
    str = document.getElementById("t_box").value;
    document.getElementById("t_box").value = "";

    str = str.replace(/\r\n|\r|\n/, " ");
    str = str.replace(/\t|　/g, " ");
    str = str.replace(/ +/g, ' ');
    str = str.replace(/(^\s+)|(\s+$)/g, "");

    arr = str.split(/\s/);

    arr.sort(//ソート処理　大>小
            function (a, b) {
                var al = GetLength(a);
                var bl = GetLength(b);

                if (al > bl)
                    return -1;
                if (al < bl)
                    return 1;
                return 0;

            }

    );

    //var keys = ["","","","",""];
    var keys = new Array(5);


    //初期値セット
    for (i = 0; (i < MAX) && (i < arr.length); i++) {

        keys[i] = arr[i];
    }

    b = 0; //行数用カウンタ   		
    for (i = MAX; i < arr.length; i++) {
        keys[b] = keys[b] + " " + arr[i];

        //	console.log( "KEY->[" + arr[i] + "] : bytes=[" + GetLength(arr[i]) + "]" );
        //	document.getElementById("t_box").value=document.getElementById("t_box").value+" "+arr[i];

        b++;
        if (b > MAX - 1) {

            keys.sort(//ソート処理　小>大
                    function (a, b) {
                        var al = GetLength(a);
                        var bl = GetLength(b);

                        if (al < bl)
                            return -1;
                        if (al > bl)
                            return 1;
                        return 0;

                    }

            );

            b = 0; //５行リセット
        }

    }

    for (i = 0; (i < MAX) && (i < arr.length); i++) {
        document.getElementById("t_box").value = document.getElementById("t_box").value + keys[i] + "\n";
    }
}
function GetLength(str) {
    return encodeURI(str).replace(/%[0-9A-F]{2}/g, '*').length;

}



function ShowLength(str) {

    for (i = 0; i < 5; i++) {
        document.getElementById("inputlength" + i).innerHTML = "";
    }
    var buf; buf="";

    var arr = str.split(/\r\n|\r|\n/);
    document.getElementById("maxrows").innerHTML = "全"+arr.length + "行";
    for (i = 0; i < arr.length; i++) {
        count = encodeURI(arr[i]).replace(/%[0-9A-F]{2}/g, '*').length;

        if (i < 5)
        {
            document.getElementById("inputlength" + i).innerHTML = count + "bytes";

            if (count > 50) {
                document.getElementById("inputlength" + i).innerHTML = "<span style='color:red;'>" + count + "bytes</span>";
            }
        }else if( i>=5 ){
            buf+=arr[i];
        }
    }
    
    count = encodeURI(buf).replace(/%[0-9A-F]{2}/g, '*').length;
    document.getElementById("inputlength5").innerHTML = "以降 :"+ count + "bytes";   
}

function ShowLength_old_notuse(str)
{

    count = encodeURI(str).replace(/%[0-9A-F]{2}/g, '*').length;

    document.getElementById("inputlength").innerHTML = count + "bytes";

    if (count > 50) {
        document.getElementById("inputlength").innerHTML = "<span style='color:red;'>" + count + "bytes</span>";
    }

    //str.length + "文字";
}


function DelSP() {
    var str;
    str = document.getElementById("t_box").value;
    document.getElementById("t_box").value = "";

    arr = str.split(/\r\n|\r|\n/);
    retstr = "";

    for (i = 0; i < arr.length; i++) {

        buf = arr[i].replace(/\t|　/g, " ");
        buf = buf.replace(/ +/g, ' ');
        buf = buf.replace(/(^\s+)|(\s+$)/g, "");

        document.getElementById("t_box").value = document.getElementById("t_box").value + buf;

        if (i == arr.length - 1) {
            retstr = retstr + buf;
        } else {
            retstr = retstr + buf + "\r\n";
        }




    }

    document.getElementById("t_box").value = retstr;
}

function DelKey() {
    val = document.getElementById("t_box").value;
    document.getElementById("i_hidden").value = val;
    document.delkey.submit();

}

function CVT_KANA() {
    str = document.getElementById("t_box").value;
    document.getElementById("t_box").value = "";

    str = str.replace(/\r\n|\r|\n/, " ");
    str = str.replace(/\t|　/g, " ");
    str = str.replace(/ +/g, ' ');
    str = str.replace(/(^\s+)|(\s+$)/g, "");

    arr = str.split(/\s/);
    for (i = 0; i < arr.length; i++) {
        if (arr[i].match(/^[\u3040-\u309F|\u30FC]+$/))
        { //ひらがなのみ
            arr[i] = arr[i].replace(/[\u3040-\u309F]/g, function (s)
            {
                return String.fromCharCode(s.charCodeAt(0) + 0x60);
            });


        }
        arr[i] = toHankaku(arr[i]);
        document.getElementById("t_box").value += arr[i] + " ";
    }


}


function tozenkaku(str) {
    //配列を用意する
    hankaku = new Array("ｶﾞ", "ｷﾞ", "ｸﾞ", "ｹﾞ", "ｺﾞ", "ｻﾞ", "ｼﾞ", "ｽﾞ", "ｾﾞ", "ｿﾞ", "ﾀﾞ", "ﾁﾞ", "ﾂﾞ", "ﾃﾞ", "ﾄﾞ", "ﾊﾞ", "ﾊﾟ", "ﾋﾞ", "ﾋﾟ", "ﾌﾞ", "ﾌﾟ", "ﾍﾞ", "ﾍﾟ", "ﾎﾞ", "ﾎﾟ", "ｳﾞ", "ｧ", "ｱ", "ｨ", "ｲ", "ｩ", "ｳ", "ｪ", "ｴ", "ｫ", "ｵ", "ｶ", "ｷ", "ｸ", "ｹ", "ｺ", "ｻ", "ｼ", "ｽ", "ｾ", "ｿ", "ﾀ", "ﾁ", "ｯ", "ﾂ", "ﾃ", "ﾄ", "ﾅ", "ﾆ", "ﾇ", "ﾈ", "ﾉ", "ﾊ", "ﾋ", "ﾌ", "ﾍ", "ﾎ", "ﾏ", "ﾐ", "ﾑ", "ﾒ", "ﾓ", "ｬ", "ﾔ", "ｭ", "ﾕ", "ｮ", "ﾖ", "ﾗ", "ﾘ", "ﾙ", "ﾚ", "ﾛ", "ﾜ", "ｦ", "ﾝ", "｡", "｢", "｣", "､", "･", "ｰ", "ﾞ", "ﾟ");
    zenkaku = new Array("ガ", "ギ", "グ", "ゲ", "ゴ", "ザ", "ジ", "ズ", "ゼ", "ゾ", "ダ", "ヂ", "ヅ", "デ", "ド", "バ", "パ", "ビ", "ピ", "ブ", "プ", "ベ", "ペ", "ボ", "ポ", "ヴ", "ァ", "ア", "ィ", "イ", "ゥ", "ウ", "ェ", "エ", "ォ", "オ", "カ", "キ", "ク", "ケ", "コ", "サ", "シ", "ス", "セ", "ソ", "タ", "チ", "ッ", "ツ", "テ", "ト", "ナ", "ニ", "ヌ", "ネ", "ノ", "ハ", "ヒ", "フ", "ヘ", "ホ", "マ", "ミ", "ム", "メ", "モ", "ャ", "ヤ", "ュ", "ユ", "ョ", "ヨ", "ラ", "リ", "ル", "レ", "ロ", "ワ", "ヲ", "ン", "。", "「", "」", "、", "・", "ー", "゛", "゜");
    //変換開始
    for (i = 0; i <= 88; i++) { //89文字あるのでその分だけ繰り返す
        while (str.indexOf(hankaku[i]) >= 0) { //該当する半角カナがなくなるまで繰り返す
            str = str.replace(hankaku[i], zenkaku[i]); //半角カナに対応する全角カナに置換する
        }
    }
    return str;
}

function toHankaku(str) {
    str = str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
    return str;
}

function DEL_BANLIST() {
    document.getElementById("cmd_delbanlist").disabled = true;
    var input_text = document.getElementById('banlist').value;
    var BANLIST = input_text.split(/\r\n|\r|\n/);
    BANLIST.sort(//ソート処理　大>小
            function (a, b) {
                var al = GetLength(a);
                var bl = GetLength(b);

                if (al > bl)
                    return -1;
                if (al < bl)
                    return 1;
                return 0;
            });

    var txt = " " + document.getElementById("t_box").value + " ";
    txt = txt.replace(/\r\n|\r|\n/g, " ");
    for (var i = 0; i < BANLIST.length; i++) {

        var SearchString = " " + BANLIST[i].replace(/\r\n|\r|\n/, "") + " ";

        txt = txt.split(SearchString).join(" ");
    }
    txt = txt.replace(/(^\s+)|(\s+$)/g, "");
    document.getElementById("t_box").value = txt;
    document.getElementById("cmd_delbanlist").disabled = false;
}
// 全ての文字列expressionの s1 を s2 に置き換える
function replaceAll(expression, org, dest) {
        return expression.split(org).join(dest);
}


//指定テキストエリアのrow行目を選択状態にする。
function Select_Txtarea(ele, row)
{
    var str = ele.value;
    var start, end, max;
    var now = 0; //文字位置用
    var CountEnt = 0; //改行カウンター


    max = str.split(/\r\n|\r|\n/).length; //改行の個数カウント


    if (row < 1) {
        row = 1;
    }
    if (row > max) {
        row = max;
    }


    for (var i = 0; i < str.length; i++) {

        if (str[i] == "\n") {
            old = now;
            now = i;
            CountEnt++;
        }
        if (row == CountEnt) {
            if (row == 1) {
                start = 0;
            } else {
                start = old + 1;
            }
            end = now;
            break;
        }
        if (i == str.length - 1) {
            end = i;
        } //最後の文字なので終点セット
    }

    if ('selectionStart' in ele) {


        ele.selectionStart = start;
        ele.selectionEnd = end;
    }




}


String.prototype.countS = function (str) {
    return this.split(str).length - 1;
}

function init_save_keyword() {
    if (!store.enabled) {
        alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.');
        return
    }
    var save_data = store.get('save_data');

    if (save_data == null) {
        save_data = INIT_SAVE_DATA;
    }

    var save_date = store.get('save_date');

    if (save_date == null) {
        save_date = INIT_SAVE_DATE;
    }


    var save_name = store.get('save_name');

    if (save_name == null) {
        save_name = INIT_SAVE_NAME;
    }
    console.log(save_name);
}

function init_banlist() {
    if (!store.enabled) {
        alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.');
        return;
    }

    var BANLIST = store.get('banlist');

    if (BANLIST == null) {
        BANLIST = iniBANLIST;
    }

    for (i = 0; i < BANLIST.length; i++) {

        document.getElementById('banlist').value += BANLIST[i] + "\r\n";
    }

}

function ini_banlist() {
    if (!store.enabled) {
//			alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.');
        return
    }
    document.getElementById('banlist').value = "";
    BANLIST = iniBANLIST;
    for (i = 0; i < BANLIST.length; i++) {

        document.getElementById('banlist').value += BANLIST[i] + "\r\n";
    }

}

function save_banlist() {
    if (!store.enabled) {
//			alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.');
        return
    }
    input_text = document.getElementById('banlist').value;
    arr = input_text.split(/\r\n|\r|\n/);


    store.set('banlist', arr);
}

function clear_banlist() {
    document.getElementById('banlist').value = "";
}

function init_savetext() {
    var sel_val = $('#select_savename').val();

    if (sel_val == null) {
        sel_val = 0;
    }

    if (!store.enabled) {
        alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.');
        return
    }

    savename = store.get('savename');

    if (savename == null) {
        savename = INIT_SAVE_NAME;
    }


    savedate = store.get('savedate');

    if (savedate == null) {
        savedate = INIT_SAVE_DATE;
    }


    savedata = store.get('savedata');

    if (savedata == null) {
        savedata = INIT_SAVE_DATA;
    }
    selected = store.get('selected');
    if (selected == null) {
        selected = 0;
    }

    for (i = 0; i < savename.length; i++) {
        $("#select_savename").append($("<option>").val(savename[i]).text(savename[i] + savedate[i]));
    }

    $('#select_savename').children().remove();

    for (i = 0; i < 10; i++) {


        $('#select_savename').append($('<option>').attr({value: i}).text(savename[i] + " " + savedate[i]));

    }

    $('#select_savename').prop('selectedIndex', sel_val);
    $('#text_save').val(savename[sel_val]);
}

function select_savename_change() {

    var select_val = $('#select_savename').val();
    $('#text_save').val(savename[select_val]);
    //init_savetext();

}
function lord_Txtarea() {
    var select_val = $('#select_savename').val();

    savedata = store.get('savedata');

    if (savedata == null) {
        savedata = INIT_SAVE_DATA;
    }
    document.getElementById("t_box").value = savedata[select_val];
    document.getElementById("text_save").value = savename[select_val];
    ShowLength(document.getElementById('t_box').value);    
}

function save_Txtarea() {
    var select_val = $('#select_savename').val();
    if (select_val < 0 & select_val > 9) {
        select_val = 0;
    }

    var str = document.getElementById("t_box").value;
    var sname = document.getElementById("text_save").value;
    savedata[select_val] = str;
    savedate[select_val] = getDate();
    savename[select_val] = sname;

    savedata = store.set('savedata', savedata);
    savedate = store.set('savedate', savedate);
    savename = store.set('savename', savename);

    init_savetext();
}
function getDate() {
    var myTbl = new Array("日", "月", "火", "水", "木", "金", "土");
    var myD = new Date();

    var myYear = myD.getFullYear();
    var myMonth = myD.getMonth() + 1;
    var myDate = myD.getDate();
    var myDay = myD.getDay();
    var myHours = myD.getHours();
    var myMinutes = myD.getMinutes();
    var mySeconds = myD.getSeconds();

    var myMess1 = myYear + "/" + myMonth + "/" + myDate;
    var myMess3 = myHours + ":" + myMinutes;
    var myMess = myMess1 + " " + myMess3;

    return myMess;

}

var iniBANLIST = [
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "L", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
    "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
    "あ", "い", "う", "え", "お", "か", "き", "く", "け", "こ", "さ", "し", "す", "せ", "そ", "た", "ち", "つ", "て", "と", "な", "に", "ぬ", "ね", "の", "は", "ひ", "ふ", "へ", "ほ", "ま", "み", "む", "め", "も",
    "や", "ゆ", "よ","ら","り","る","れ","ろ", "わ", "を", "ん", "きゃ", "きゅ", "きょ", "しゃ", "しゅ", "しょ", "ちゃ", "ちゅ", "ちょ", "にゃ", "にゅ", "にょ", "ひゃ", "ひゅ", "ひょ", "みゃ", "みゅ", "みょ", "りゃ", "りゅ", "りょ",
    "ぎゃ", "ぎゅ", "ぎょ", "じゃ", "じゅ", "じょ", "びゃ", "びゅ", "びょ", "ぴゃ", "ぴゅ", "ぴょ",
    "ア", "イ", "ウ", "エ", "オ", "カ", "キ", "ク", "ケ", "コ", "サ", "シ", "ス", "セ", "ソ", "タ", "チ", "ツ", "テ", "ト", "ナ", "ニ", "ヌ", "ネ", "ノ", "ハ", "ヒ", "フ", "ヘ", "ホ", "マ", "ミ", "ム", "メ", "モ",
    "ヤ", "ユ", "ヨ","ラ","リ","ル","レ","ロ", "ワ", "ヲ", "ン", "ガ", "ギ", "グ", "ゲ", "ゴ", "ザ", "ジ", "ズ", "ゼ", "ゾ", "ダ", "ヂ", "ヅ", "デ", "ド", "バ", "ビ", "ブ", "ベ", "ボ", "パ", "ピ", "プ", "ペ", "ポ", "キャ", "キュ", "キョ",
    "シャ", "シュ", "ショ", "チャ", "チュ", "チョ", "ニャ", "ニュ", "ニョ", "ヒャ", "ヒュ", "ヒョ", "ミャ", "ミュ", "ミョ", "リャ", "リュ", "リョ", "ギャ", "ギュ", "ギョ", "ジャ", "ジュ", "ジョ", "ビャ", "ビュ",
    "ビョ", "ピャ", "ピュ", "ピョ", "ファ", "フィ", "フェ", "フォ", "フュ", "ウィ", "ウェ", "ウォ", "ヴァ", "ヴィ", "ヴェ", "ヴォ", "ツァ", "ツィ", "ツェ", "ツォ", "チェ", "シェ", "ジェ", "ティ", "ディ", "デュ", "トゥ",
    "あすつく", "あす楽", "メール便", "送料0円", "送料無料", "即納", "年保証付品質保証", "BARGEN", "お得な", "クリアランス", "バーゲン", "割引", "激安", "最安値", "特価", "特売", "特別価格", "半額以下", "お買い得",
    "オススメ", "お勧め", "ヒット商品", "王道", "希少", "業界初", "芸能人愛用", "決定版", "効果絶大", "今なら", "再入荷", "最新", "残りわずか", "残り僅か", "秋冬物", "春夏物", "賞与", "新作", "新入荷", "人気の",
    "人気商品", "人気沸騰中", "全色", "早い者勝ち", "他の追随を許さない", "他社", "体験談", "大人気", "大定番", "注文殺到", "超人気", "定番", "日に出荷", "認め", "年末商戦", "売れてます", "比類", "豊富な", "本物",
    "枚限り", "訳あり", "流行の", "永久", "完全", "最上級", "優位性", "世界一", "日本一", "先着順", "破格",
    "burberry", "celine", "chanel", "BURBERRY", "バーバリー", "CELINE", "セリーヌ", "CHANEL", "シャネル", "chloe", "クロエ", "christian dior", "クリスチャン ディオール", "FENDI",
    "フェンディ", "GIVENCHY", "ジバンシィ", "GOYARD", "ゴヤール", "GUCCI", "グッチ", "HERMES", "エルメス", "Jimmy", "Choo", "ジミーチュウ", "Louis Vuitton", "ルイヴィトン", "MiuMiu",
    "ミュウミュウ", "MONCLER", "モンクレール", "PRADA", "プラダ", "Saint Laurent", "サンローラン", "Salvatore", "Ferragamo", "サルヴァトーレ", "フェラガモ", "Tiffany & Co", "ティファニー", "VALENTINO", "ヴァレンティノ",
    "Cath Kidston", "キャスキッドソン", "ZARA", "ザラ", "Abercrombie & Fitch", "アバクロ", "UGG", "アグ", "Chan Luu", "チャン ルー", "GIVENCHY", "ジバンシィ", "Ray Ban", "レイバン", "Saint Laurent", "サンローラン",
    "Tory Burch", "トリーバーチ", "alexander mcqueen", "アレキサンダー マックイーン", "adidas ", "アディダス", "ANNA SUI", "アナスイ", "BEAMS", "ビームス", "Bvlgari", "ブルガリ", "Calvin Klein", "カルバンクライン",
    "Cartier", "カルティエ", "CHROME HEARTS", "クロムハーツ", "Coach", "コーチ", "CONVERSE", "コンバース", "CROCS", "クロックス", "Dunhill", "ダンヒル", "EMPORIO ARMANI", "エンポリオ アルマーニ", "FILA", "フィラ", "GaGa MILANO",
    "ガガ ミラノ", "GAP", "ギャップ", "GIVENCHY", "ジバンシィ", "H&M", "エイチアンドエム", "Hamilton", "ハミルトン", "J Crew", "ジェイクルー", "LOEWE", "ロエベ", "Marc by Marc Jacobs ", "マーク バイ マークジェイコブス",
    "New Balance", "ニューバランス", "New Era", "ニューエラ", "OAKLEY", "オークリー", "オニール", "oneill"
];

var INIT_SAVE_NAME = [
    "保存名1", "保存名2", "保存名3", "保存名4", "保存名5", "保存名6", "保存名7", "保存名8", "保存名9", "保存名10"
];

var INIT_SAVE_DATE = [
    "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"
]

var INIT_SAVE_DATA = [
    "", "", "", "", "", "", "", "", "", ""
]
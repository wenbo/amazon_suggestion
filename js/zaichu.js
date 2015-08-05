function PutB(str) {

    str = str.replace(/[\n\r]/g, "");
    str = str.replace(/　/g, " ");
    str = str.replace(/ +/g, ' ');
    str = str.replace(/(^\s+)|(\s+$)/g, "");

    top.bottom.document.fm.t_box.value = top.bottom.document.fm.t_box.value + " " + str + " ";
    parent.bottom.DelSP();
    parent.bottom.ShowLength(top.bottom.document.fm.t_box.value);

//top.ue.document.getElementById('UNAME').Value=ustr;
}

function GoUe() {
    parent.ue.document.usend.submit();
}

function SetUe(ustr) {
    //top.ue.document.getElementById('UNAME').Value=ustr;
    parent.ue.document.usend.NAME.value = ustr;
    parent.ue.put_his();
    return;
}

function GetUe() {
    //top.ue.document.getElementById('UNAME').Value=ustr;
    return parent.ue.document.usend.NAME.value;
       
}

function SetAlias(ustr) {
    var f = parent.ue.document.getElementById("usend");
    checkSelect(f.elements["search-alias"], ustr);

    //parent.ue.document.usend.search-alias.selected=ustr;
    return;
}
function checkSelect(obj, val)
{
    for (var i = 0; i < obj.length; i++)
    {
        if (obj[i].value == val)
        {
            obj[i].selected = true;
            break;
        }
    }
}

function myclick(id) {

    // 強制的にイベントを呼び出す
    var elm = document.getElementById(id);

    if (!elm) {
        return false;
    } //見つからなかった様子
    // for Firefox, Chrome, Safari
    var evt = document.createEvent("MouseEvents");
    //evt.initEvent("click", false, true);
    evt.initEvent("click", false, true);
    elm.dispatchEvent(evt);
}
function amazuru() {
    console.log("amazuru start!");
    var COUNTER = {}; //参照渡し用にオブジェクトを作成
    COUNTER.count=1;
    
    var parent = 1;
    var level = 1;

    var cate = $('input[name=search-alias]').val();
    //var keyword = $('input[name=keyword]').val();
    var keyword= GetUe();
    //var keyword= $('NAME',parent.ue).val();
    console.log( "キーワード:"+keyword+"  カテゴリー:"+cate);

    _get_data(parent,keyword, cate, level,COUNTER);
    console.log("amazuru end!");
}

// parent=int 親ID
// keyword=str 検索キーワード
// cate=str Amazonカテゴリ文字列
// level=int 階層レベル
// COUNTER=カウンターオブジェクト　COUNTER.countのみメンバー
function _get_data(parent, keyword, cate, level,COUNTER) {
    //console.log( "parent="+parent+" keyword="+keyword+" cate="+cate+" level="+level+"COUNTER"+COUNTER.count);
    
    var base_url = "http://completion.amazon.co.jp/search/complete?method=completion&search-alias=" + cate + "&mkt=6&q=" + keyword;
    var url = encodeURIComponent(base_url);
    var MaxLevel=6;
    var MaxCount=1000;
    
    url="req.php?search-alias="+cate+"&NAME=" + encodeURIComponent(keyword);
    $.ajax({
        type: "GET",
        scriptCharset: 'utf-8',
        //url: "req.php?url=" + url,
        url: url,
        //url: url,
        dataType: "text",
        cache: false
    }).done(function (res) {
        
        //console.log(res);
        var obj = $.parseJSON(res);

        COUNTER.count+=1;
        
        $("#tree" + parent).append("<ul id='tree" + COUNTER.count + "'></ul>");
        parent = COUNTER.count;

        //$.each(obj[1], function () {
        for (var i=0; i<obj[1].length; i++){
            var thisw=obj[1][i];
            //var thisw=this;
            
            
            
            if ( keyword === thisw ) {
                continue;
                //return true;  // continue の代わり
            }
            if (level > MaxLevel || COUNTER.count>MaxCount) {
                return false;
            }

            console.log("parent:" + keyword + " key:" + thisw + " level:" + level + "COUNTER="+COUNTER.count);
            COUNTER.count+=1;
            //var addstr="<li id='tree" + COUNTER.count + "'><span class='tooltip' title='クリックすると『"+thisw+"』をテキストエリアに追加します'><span class='keys'><a href='#a' onClick='PutB(\"" + thisw + "\");'>" + thisw +" </a></span></span></li>&nbsp"; 
            var regobj=new RegExp(keyword+" ","g");
            var thisw2=thisw.replace(regobj, "");
            delete regobj;
            var regobj=new RegExp(keyword+" ","g");
            var thisw2=thisw.replace(regobj, "");          
            var PrintWords="<span CLASS='dark'>"+keyword+ "</span>&nbsp&nbsp"
             PrintWords+="<span class='tooltip' title='クリックすると『"+thisw2+"』をテキストエリアに追加します'> <span class=\"keys\"><a href=\"#a\" onClick=\"PutB(' "+thisw2+"');\">"+thisw2+"</a></span></span>"
            var addstr="<li id='tree" + COUNTER.count + "'>" + PrintWords + "</li>\n";    
            //var addstr="<li id='tree" + COUNTER.count + "'>" + thisw2 + "</li>\n";
            	//下フレームへの自動送信チェック

            PutB(thisw);

         

        
        
            $("#tree" + parent).append(addstr);
            
            var retflag=_get_data(COUNTER.count, thisw, cate, level + 1,COUNTER) ;
            //console.log(retflag);    
            if (!retflag ) {
                
                return false;
                
            }

        }    
        //});
    }).fail(function (data) {
        console.log("\najax error");
        //console.log(this);
        return false;

    });
    return true;
}

function Start_AtoZ() {
    AtoZCount = 0;
    document.usend.BaseKeyword.value = document.usend.UNAME.value; //ベースキーワードを退避

    //初回呼び出し 初期化処理
    parent.ue.document.usend.AutoSend.checked = true;
    parent.ue.document.usend.AtoZ.checked = true;

    parent.ue.document.usend.AtoZst.value = "0";
    parent.ue.document.usend.AtoZst2.value = AtoZ.length;

    _callAtoZ(0);

}


function Cont_AtoZ() {
    //AtoZ動作中処理
    //この処理はframe_shita.phpより呼び出される。
    var count;
    count = parent.ue.document.usend.AtoZst.value;
    count++;
    parent.ue.document.usend.AtoZst.value = count;



    if (count < AtoZ.length) {
        //継続
        _callAtoZ(count);

    } else {
        //終了
        parent.ue.document.usend.AtoZ.checked = false;

    }

}

function _callAtoZ(count) {
//count=現在のカウンタ＝AtoZの配列で何個目か？

    var atz, baseKey;

    baseKey = parent.ue.document.usend.BaseKeyword.value;
    atz = AtoZ[ count ];
    parent.ue.document.usend.NAME.value = baseKey + " " + atz;
    parent.ue.document.usend.AtoZst.value = count;
    parent.ue.document.usend.submit();

}



var AtoZ = [
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "L", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
    "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
    "あ", "い", "う", "え", "お", "か", "き", "く", "け", "こ", "さ", "し", "す", "せ", "そ", "た", "ち", "つ", "て", "と", "な", "に", "ぬ", "ね", "の", "は", "ひ", "ふ", "へ", "ほ", "ま", "み", "む", "め", "も",
    "や", "ゆ", "よ", "ら", "り", "る", "れ", "ろ", "わ", "を", "ん", "きゃ", "きゅ", "きょ", "しゃ", "しゅ", "しょ", "ちゃ", "ちゅ", "ちょ", "にゃ", "にゅ", "にょ", "ひゃ", "ひゅ", "ひょ", "みゃ", "みゅ", "みょ", "りゃ", "りゅ", "りょ",
    "ぎゃ", "ぎゅ", "ぎょ", "じゃ", "じゅ", "じょ", "びゃ", "びゅ", "びょ", "ぴゃ", "ぴゅ", "ぴょ",
    "ア", "イ", "ウ", "エ", "オ", "カ", "キ", "ク", "ケ", "コ", "サ", "シ", "ス", "セ", "ソ", "タ", "チ", "ツ", "テ", "ト", "ナ", "ニ", "ヌ", "ネ", "ノ", "ハ", "ヒ", "フ", "ヘ", "ホ", "マ", "ミ", "ム", "メ", "モ",
    "ヤ", "ユ", "ヨ", "ラ", "リ", "ル", "レ", "ロ", "ワ", "ヲ", "ン", "ガ", "ギ", "グ", "ゲ", "ゴ", "ザ", "ジ", "ズ", "ゼ", "ゾ", "ダ", "ヂ", "ヅ", "デ", "ド", "バ", "ビ", "ブ", "ベ", "ボ", "パ", "ピ", "プ", "ペ", "ポ", "キャ", "キュ", "キョ",
    "シャ", "シュ", "ショ", "チャ", "チュ", "チョ", "ニャ", "ニュ", "ニョ", "ヒャ", "ヒュ", "ヒョ", "ミャ", "ミュ", "ミョ", "リャ", "リュ", "リョ", "ギャ", "ギュ", "ギョ", "ジャ", "ジュ", "ジョ", "ビャ", "ビュ",
    "ビョ", "ピャ", "ピュ", "ピョ", "ファ", "フィ", "フェ", "フォ", "フュ", "ウィ", "ウェ", "ウォ", "ヴァ", "ヴィ", "ヴェ", "ヴォ", "ツァ", "ツィ", "ツェ", "ツォ", "チェ", "シェ", "ジェ", "ティ", "ディ", "デュ", "トゥ"
];


<?php
echo("begin");
function writeMsg() {
    echo "Hello world!";
}

writeMsg(); 
function pwd_hash($a) {
	 $salt="Random_KUGBJVY";  //定义一个salt值，程序员规定下来的随机字符串
	 $b=$a;  //把密码和salt连接
	 $b=md5($b);  //执行MD5散列
	 return $b;  //返回散列    
}
echo(pwd_hash("asdf"));
?>

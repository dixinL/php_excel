<?php
/**
 * Created by PhpStorm.
 * User: Dixin
 * Date: 2018/6/26/026
 * Time: 14:30
 */
header('Content-Type: text/html;charset=utf-8');
$dbh = @mysql_connect("localhost","root","1234");
/* 定义变量dbh , mysql_connect()函数的意思是连接mysql数据库, "@"的意思是屏蔽报错 */
if(!$dbh){die("");}
/* die()函数的意思是将括号里的字串送到浏览器并中断PHP程式 (Script)。括号里的参数为欲送出的字串。 */
@mysql_select_db("dixin", $dbh);
/* 选择mysql服务器里的一个数据库,这里选的数据库名为 ok */
mysql_query("set names 'utf8'");
$q = "SELECT * FROM php_excel GROUP BY address";
/* 定义变量q, "SELECT * FROM abc"是一个SQL语句,意思是读取表abc中的数据 */
$rs = mysql_query($q, $dbh);
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */
if(!$rs){die("");}
echo "<option value=\"\" disabled selected class=\"active\">请选择城市</option>";
while($row = mysql_fetch_row($rs)) echo "<option value='$row[1]'>$row[1]</option>";
/* 定义量变(数组)row,并利用while循环,把数据一一写出来.
函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.
$row[0] 和 $row[1] 的位置可以换*/
@mysql_close($dbh);
/* 关闭到mysql数据库的连接 */
?>
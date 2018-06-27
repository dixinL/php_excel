
<?php
header('Content-Type: text/html;charset=utf-8');

$host="localhost";
$username="root";
$password="1234";

$connection= mysql_connect ($host, $username, $password);

if (!$connection) {
    die ("数据库连接失败");
}

$result=mysql_select_db ("dixin");

if (! $result) {
    die ("数据读取失败");
}
mysql_query("set character set 'utf8'");//读库
mysql_query("set names 'utf8'");//写库
//这个是你要插入的数组
//删除
//$exec="delete from dixin.leagueoflegends where id IN ($i)";
//写入
$retime =$_GET['retime'];
$exec="select * from dixin.pet_table where times like '$retime%';";
$result= mysql_query($exec);
if (!$result){
    echo '数据读取失败';
}
else{
    while($row = mysql_fetch_row($result)){
            $pet_num=$row[6]/1+$row[7]/1;
            $sum_pet=$pet_num*1000;
            $sum_money=$pet_num*7;
            echo "<tr><td>$row[5]</td><td>$row[4]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[6]</td><td>$row[7]</td><td>$sum_pet</td><td>$sum_money</td><td>$row[8]</td><td class='dd'><a href='javascript:void(0);' class='delBtn'>删除</a></td><td class='active'>$row[0]</td></tr>";
        }
   }
//这里是插入数据库的语句
mysql_close($connection);
?>

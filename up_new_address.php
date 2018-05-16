
<?php
header('Content-Type: text/html;charset=utf-8');
if ($_GET['new_address']==""){
    echo "";
}else{
    $host="localhost";
    $username="root";
    $password="1234";

    $connection= mysql_connect ($host, $username, $password);

    if (!$connection) {
        die ("mysql连接失败");
    }

    $result=mysql_select_db ("dixin");

    if (! $result) {
        die ("没有选择任何数据库");
    }
    echo "";
    mysql_query("set character set 'utf8'");//读库
    mysql_query("set names 'utf8'");//写库
//这个是你要插入的数组
    //删除
    //$exec="delete from dixin.leagueoflegends where id IN ($i)";
    //写入

    $exec="insert into dixin.php_excel VALUES ('','".$_GET['new_address']."','','')";
    $result= mysql_query($exec);
    if (!$result){
        echo '新地址：'.$_GET["new_address"].'  添加失败';
    }
    else{
        echo '新地址：'.$_GET["new_address"].'  添加成功';
    }
    //这里是插入数据库的语句
    mysql_close($connection);
}
?>


<?php
header('Content-Type: text/html;charset=utf-8');
if ($_GET['new_address']==""){
    echo "添加失败或重复添加，请刷新重试";
}else{
    $host="localhost";
    $username="root";
    $password="1234";

    $connection= mysql_connect ($host, $username, $password);

    if (!$connection) {
        die ("数据库连接失败");
    }

    $result=mysql_select_db ("dixin");

    if (! $result) {
        die ("添加失败，请重试");
    }
    echo "";
    mysql_query("set character set 'utf8'");//读库
    mysql_query("set names 'utf8'");//写库
//这个是你要插入的数组
    //删除
    //$exec="delete from dixin.leagueoflegends where id IN ($i)";
    //写入

    $exec="insert into dixin.php_excel VALUES ('','".$_GET['new_address']."','".$_GET['new_flight']."','".$_GET['new_destination']."')";
    $result= mysql_query($exec);
    if (!$result){
        echo '新航班：'.$_GET["new_flight"].'  从：'.$_GET['new_address'].'  至：'.$_GET['new_destination'].'  添加失败';
    }
    else{
        echo '新航班：'.$_GET["new_flight"].'  从：'.$_GET['new_address'].'  至：'.$_GET['new_destination'].'  添加成功';
    }
    //这里是插入数据库的语句
    mysql_close($connection);
}
?>
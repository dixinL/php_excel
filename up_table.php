
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
        die ("保存失败，请重试");
    }
    mysql_query("set character set 'utf8'");//读库
    mysql_query("set names 'utf8'");//写库
//这个是你要插入的数组
    //删除
    //$exec="delete from dixin.leagueoflegends where id IN ($i)";
    //写入
        $ti1=$_POST['time'];
        $exec1="delete from dixin.pet_table where times = '$ti1'";
        $ds=mysql_query($exec1);
        $exec="insert into dixin.pet_table VALUES ('','".$_POST['time']."','".$_POST['address']."','".$_POST['destination']."','".$_POST['flight']."','".$_POST['order']."','".$_POST['cat']."','".$_POST['dog']."','".$_POST['ps']."')";
        $result= mysql_query($exec);
        if (!$result){
            echo '保存失败';
        }
        else{
            echo '保存成功';
        }
    //这里是插入数据库的语句
    mysql_close($connection);
?>

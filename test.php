<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/table.js"></script>
    <script src="js/js_excel_ffgo.js"></script>
    <link rel="stylesheet" href="style/test.css">
    <script src="js/ajax_php.js"></script>

</head>
<body onload="flight()">
<div class="center">
    <div class="incenter">
        <div class="left">
            <div class="cen marg">
                <form>
                    <select id="address" name="address" onchange="flight()" class="sele">
                        <option value="" disabled selected class="active">请选择城市</option>
                        <?
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

                        while($row = mysql_fetch_row($rs)) echo "<option value='$row[1]'>$row[1]</option>";
                        /* 定义量变(数组)row,并利用while循环,把数据一一写出来.
                        函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.
                        $row[0] 和 $row[1] 的位置可以换*/
                        @mysql_close($dbh);
                        /* 关闭到mysql数据库的连接 */
                        ?>
                    </select>
                </form>
            </div>
            <div id="destination_select" class="cen marg">

            </div>
            <div id="flight_select" class="cen marg">

            </div>
            <div>
                <button onclick="new_flight()">增加新航班</button>
            </div>
            <div class="marg">
                <form>
                    运单号：<br/>
                    <input type="text" id="order" class="inputwid">
                    <br/>
                    猫数量：<br/>
                    <input type="number" id="cat" class="inputwid">
                    <br/>
                    狗数量：<br/>
                    <input type="number" id="dog" class="inputwid">
                    <div style="width: 150px" class="cen marg">
                        <a href="###" onclick="" id="add_table">添加数据</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="right">
            <div class="padd">
                <table id="targetTable" cellpadding="0" cellspacing="0" border="1" class="cen">
                    <tr>
                        <td colspan="10" class="thh">天安财险股份有限公司</td>
                    </tr>
                    <tr>
                        <td colspan="10" class="thh">TIANAN PROPERTY INSURANCE COMPANY</td></tr><br>
                    <tr>
                        <td colspan="10" class="thh">货物起运申报单</td></tr><br>
                    <tr>
                        <td colspan="10" class="thh">Cargo Declaration Form</td></tr><br>
                    <tr>
                        <td>投保人(Applicant)</td>
                        <td colspan="3"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>填报日期（date）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>航空运单号</th>
                        <th>航班号</th>
                        <th>起运日期</th>
                        <th>起运地</th>
                        <th>目的地</th>
                        <th>宠物猫（只）</th>
                        <th>宠物狗（只）</th>
                        <th>宠物价值(CNY)</th>
                        <th>保险金额（CNY）</th>
                        <th>备注</th>
                        <th class="dd">操作</th>
                    </tr>

                    <tr class="append-row">
                    </tr>
                </table>

                <input id="Button1" type="button" value="导出EXCEL" onclick="table2excel('targetTable')"/>
                <!--<input id="save" type="button" value="保存" onclick="save()"/>-->
            </div>
        </div>
    </div>
</div>
<div id="new_adf" class="onit active">
    <form>
        添加新地址：
        <input type="text" id="new_address" class="inputwid">
        <br/>
        添加新航班：
        <input type="text" id="new_flight" class="inputwid">
        <br/>
        添加目的地：
        <input type="text" id="new_destination" class="inputwid">
        <br/>
        <div class="cen marg">
            <a href="###" onclick="up_flight()">添加新航班</a>
            <a href="###" onclick="pass_up()">取消</a>
        </div>
    </form>
</div>
</body>
<!--<script>
    function save() {
        var rows = $("#targetTable tr").length;
        for(var i=7;i<=rows;i++){
            alert(i);
            for(var j=0;j<8;j++){
            }
        }
    }
</script>-->
</html>
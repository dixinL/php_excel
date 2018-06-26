<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>货物起运申报单</title>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/table.js"></script>
    <script src="js/js_excel_ffgo.js"></script>
    <link rel="stylesheet" href="style/test.css">
    <script src="js/ajax_php.js"></script>
    <link rel='icon' href='image/18.1.19dixin图标-3.ico'/>
</head>
<body onload="body()">
<div class="center">
    <div class="incenter">
        <div class="left">
            <div class="cen marg">
                <form>
                    <select id="address" name="address" onchange="flight()" class="sele">

                    </select>
                </form>
            </div>
            <div id="destination_select" class="cen marg">
                <select id="destination" name="destination" class="sele" onchange="destination()">
                    <option value="" disabled selected class="active">请选择目的地</option>
                </select>
            </div>
            <div id="flight_select" class="cen marg">
                <select id="flight" name="flight" class="sele">
                    <option value="" disabled selected class="active">请选择航班</option>
                </select>
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
                        <td>
                            合计
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td id="catN">
                        </td>
                        <td id="dogN">
                        </td>
                        <td id="petN">
                        </td>
                        <td id="monN">
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
                <script type="text/javascript">
                    var calcTotal=function(table,column){//合计，表格对象，对哪一列进行合计，第一列从0开始
                        var trs=document.getElementsByTagName('tr');
                        var start=8,//忽略第一行的表头
                            end=trs.length-1;//忽略最后合计的一行
                        var total=0;
                        for(var
                                i=start;i<end;i++){
                            var td=trs[i].getElementsByTagName('td')[column];
                            var t=parseFloat(td.innerHTML);
                            if(t)total+=t;
                        }
                        trs[end].getElementsByTagName('td')[column].innerHTML=total;
                    };
                    calcTotal(document.getElementById('table'),2);
                </script>
                <input id="Button1" type="button" value="导出EXCEL" onclick="table2excel('targetTable')"/>
                <input id="save" type="button" value="保存" onclick="save()"/>
                <input id="recover1" type="button" value="恢复信息" onclick="recover1()"/>
                <div id="act"></div>
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
<div id="reco" class="onit active">
    <form name="reg_testdate">
            <select id="yyyy" name="YYYY" onchange="YYYYDD(this.value)">
                <option value="">请选择 年</option>
            </select>
            <select id="mm" name="MM" onchange="MMDD(this.value)">
                <option value="">选择 月</option>
            </select>
            <select id="dd" name="DD">
                <option value="">选择 日</option>
            </select>
        <select id="apm" name="APM">
            <option value="上午">上午</option>
            <option value="下午">下午</option>
        </select>
        <div class="cen marg">
            <a href="###" onclick="recoverr()">查找记录</a>
            <a href="###" onclick="passit()">取消</a>
        </div>
    </form>
</div>
</body>
<script>


</script>
</html>
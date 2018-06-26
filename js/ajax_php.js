/**
 * Created by Dixin on 2018/5/14/014.
 */
$("input[type='submit']").click(function(){
    $("form").submit();
});
$("input[name='submit']").click(function(){
    $("form").submit();
});
//弹出增加窗口
function new_flight() {
    $("#new_adf").removeClass("active");
}
function recover1() {
    $("#reco").removeClass("active");
}
function passit() {
    $("#reco").addClass("active");
}
//添加新航班
function up_flight() {
    var xhr = new XMLHttpRequest();
    xhr.open('get','up_new_flight.php?new_address='+document.getElementById("new_address").value+'&new_flight='+document.getElementById("new_flight").value+'&new_destination='+document.getElementById("new_destination").value);
    xhr.onload = function () {
        alert (xhr.responseText);
        $("#new_adf").addClass("active");
        city();
    }
    xhr.send(null);
}
//更新城市菜单
function city() {
    var xhr = new XMLHttpRequest();
    xhr.open('get','city.php');
    xhr.onload = function () {
        document.getElementById('address').innerHTML = xhr.responseText;
    }
    xhr.send(null);
}
//更新航班菜单
function flight() {
    var xhr = new XMLHttpRequest();
    xhr.open('get','cover_destination.php?address='+document.getElementById("address").value);
    xhr.onload = function () {
        document.getElementById('destination').innerHTML = xhr.responseText;
        $("#up_flight").removeClass("active");
    }
    xhr.send(null);
}
//更新目的地菜单
function destination() {
    del();
    var xhr = new XMLHttpRequest();
    xhr.open('get','cover_flight.php?address='+document.getElementById("address").value+'&destination='+document.getElementById("destination").value);
    xhr.onload = function () {
        document.getElementById('flight').innerHTML = xhr.responseText;
        //document.getElementById('address1').innerText = document.getElementById("address").value;
    }
    xhr.send(null);
}
function pass_up() {
    $("#new_adf").addClass("active");
}
function del() {
    document.getElementById('order').value='';
    document.getElementById('cat').value='';
    document.getElementById('dog').value='';
}
function del1() {
    document.getElementById('destination').value='';
    document.getElementById('flight').value='';
}
//保存数据
function save() {
    var rowsa = $("#targetTable tr").length;
    console.log(rowsa);
    for(var i=7;i<rowsa;i++){
        var tabs= new Array();
        for(var j=0;j<10;j++){
            tabs[j]= document.getElementById('targetTable').rows[i].cells[j].innerHTML;
        }
        var jso = JSON.stringify(tabs);
        console.log(jso);
        var xhr = new XMLHttpRequest();
        xhr.open('post','up_table.php');
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if(xhr.readyState==4&&xhr.status==200){
                document.getElementById('act').innerHTML = xhr.responseText;
            }
        }
        xhr.send('order='+tabs[0]+'&flight='+tabs[1]+'&address='+tabs[3]+'&destination='+tabs[4]+'&cat='+tabs[5]+'&dog='+tabs[6]+'&ps='+tabs[9]+'&time='+tabs[2]);
    }
}
//时间
function YYYYMMDDstart()
{
    MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    //先给年下拉框赋内容
    var y  = new Date().getFullYear();
    for (var i = (y-1); i < (y+30); i++) //以今年为准，前1年，后30年
        document.reg_testdate.YYYY.options.add(new Option(" "+ i , i));

    //赋月份的下拉框
    for (var i = 1; i < 13; i++)
        document.reg_testdate.MM.options.add(new Option(" " + i , i));

    document.reg_testdate.YYYY.value = y;
    document.reg_testdate.MM.value = new Date().getMonth() + 1;
    var n = MonHead[new Date().getMonth()];
    if (new Date().getMonth() ==1 && IsPinYear(YYYYvalue)) n++;
    writeDay(n); //赋日期下拉框Author:meizz
    document.reg_testdate.DD.value = new Date().getDate();
}
if(document.attachEvent)
    window.attachEvent("onload", YYYYMMDDstart);
else
    window.addEventListener('load', YYYYMMDDstart, false);
function YYYYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)
{
    var MMvalue = document.reg_testdate.MM.options[document.reg_testdate.MM.selectedIndex].value;
    if (MMvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}
    var n = MonHead[MMvalue - 1];
    if (MMvalue ==2 && IsPinYear(str)) n++;
    writeDay(n)
}
function MMDD(str)   //月发生变化时日期联动
{
    var YYYYvalue = document.reg_testdate.YYYY.options[document.reg_testdate.YYYY.selectedIndex].value;
    if (YYYYvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}
    var n = MonHead[str - 1];
    if (str ==2 && IsPinYear(YYYYvalue)) n++;
    writeDay(n)
}
function writeDay(n)   //据条件写日期的下拉框
{
    var e = document.reg_testdate.DD; optionsClear(e);
    for (var i=1; i<(n+1); i++)
        e.options.add(new Option(" "+ i , i));
}
function IsPinYear(year)//判断是否闰平年
{     return(0 == year%4 && (year%100 !=0 || year%400 == 0));}
function optionsClear(e)
{
    e.options.length = 1;
}

//读取数据至表格
function recoverr() {
    var year = document.getElementById('yyyy').value;
    var month = document.getElementById('mm').value;
    var day = document.getElementById('dd').value;
    var ap = document.getElementById('apm').value;
    var redata = year+'/'+month+'/'+day+' '+ap;
    var xhr = new XMLHttpRequest();
    xhr.open('get','recover_table.php?retime='+redata);
    xhr.onload = function () {
        $(xhr.responseText).insertBefore(".append-row");
        trEdit();
        delTr();
        var xx = xhr.responseText;
        if(xx.substring(3,2)=="<"){
            alert ('读取成功');
        }else{
            alert ('读取失败');
        }
        $("#reco").addClass("active");
    }
    xhr.send(null);

}
function body() {
    city();
    flight();
}
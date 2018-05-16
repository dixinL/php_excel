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
//添加新航班
function up_flight() {
    var xhr = new XMLHttpRequest();
    xhr.open('get','up_new_flight.php?new_address='+document.getElementById("new_address").value+'&new_flight='+document.getElementById("new_flight").value+'&new_destination='+document.getElementById("new_destination").value);
    xhr.onload = function () {
        alert (xhr.responseText);
        $("#new_adf").addClass("active");
    }
    xhr.send(null);
}
//更新目的地菜单
function flight() {
    var xhr = new XMLHttpRequest();
    xhr.open('get','cover_destination.php?address='+document.getElementById("address").value);
    xhr.onload = function () {
        document.getElementById('destination_select').innerHTML = xhr.responseText;
        $("#up_flight").removeClass("active");
        document.getElementById('address1').innerText = document.getElementById("address").value;
    }
    xhr.send(null);
}
//数据传入数据库并显示在table内
function up_table() {
    var myDate = new Date();//获取系统当前时间
    var times = myDate.toLocaleString( );
    var xhr = new XMLHttpRequest();
    address1=document.getElementById("address").value;
    flight1=document.getElementById("flight").value;
    order1=document.getElementById("order").value;
    cat1=document.getElementById("cat").value;
    dog1=document.getElementById("dog").value;
    pet_num=cat1/1+dog1/1;
    sum_pet=pet_num*7;
    sum_money=pet_num*1000;
    xhr.open('get','up_table.php?time='+times+'&address='+address1+'&flight='+flight1+'&order='+order1+'&cat='+cat1+'&dog='+dog1+'&sum_pet='+sum_pet+'&sum_money='+sum_money);
    xhr.onload = function () {
        console.log(xhr.responseText);
    }
    xhr.send(null);
}
//更新航班菜单
function destination() {
    var xhr = new XMLHttpRequest();
    xhr.open('get','cover_flight.php?address='+document.getElementById("address").value+'&destination='+document.getElementById("destination").value);
    xhr.onload = function () {
        document.getElementById('flight_select').innerHTML = xhr.responseText;
    }
    xhr.send(null);
}
function pass_up() {
    $("#new_adf").addClass("active");
}
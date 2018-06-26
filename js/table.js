/**
 * Created by Dixin on 2018/5/14/014.
 */

//需要首先通过Jq来解决内容部分奇偶行的背景色不同
//$(document).ready(function(){
//找到表格的内容区域中所有的奇数行
//使用even是为了把通过tbody tr返回的所有tr元素中，
//在数组里面下标是偶数的元素返回，因为这些元素，
//实际上才是我们期望的tbody里面的奇数行
//$("tbody tr:odd").css("background-color","#EEEEEE");
trEdit();//td的点击事件封装成一个函数
//});

/*下面兩段开始添加删除行**/
$(document).ready(function() {
    $("#add_table").bind("click", function(){
        var myDate = new Date();//获取系统当前时间
        var times1 = myDate.toLocaleString();
        var times = times1.substring(0,12);
        var address1=document.getElementById("address").value;
        var flight1=document.getElementById("flight").value;
        var order1=document.getElementById("order").value;
        var destination1=document.getElementById("destination").value;
        var cat1=document.getElementById("cat").value/1;
        var dog1=document.getElementById("dog").value/1;
        var pet_num=cat1/1+dog1/1;
        var sum_pet=pet_num*1000;
        var sum_money=pet_num*7;
            $("<tr><td>"+order1+"</td><td>"+flight1+"</td><td>"+times+"</td><td>"+address1+"</td><td>"+destination1+"</td><td>"+cat1+"</td><td>"+dog1+"</td><td>"+sum_pet+"</td><td>"+sum_money+"</td><td></td><td class='dd'><a href='javascript:void(0);' class='delBtn'>删除</a></td></tr>").insertBefore(".append-row");

        del();
        del1();
        trEdit();
        delTr();
        countRowTotal1();
        //$("tbody tr:odd").css("background-color","#EEEEEE");
    });
    delTr();
});

//删除
function delTr(){
    $(".delBtn").click(function(){
        $(this).parent().parent().remove();
    });
}
/*
 function even(){
 $("tbody tr:even").css("background-color","#ECE9D8");
 }*/


//需要找到所有的单元格
function trEdit(){
    var numTd = $("tbody td").not(".del-col");
    //给这些单元格注册鼠标点击的事件
    numTd.click(function() {
        //找到当前鼠标点击的td,this对应的就是响应了click的那个td
        var tdObj = $(this);
        if (tdObj.children("input").length > 0) {
            //当前td中input，不执行click处理
            return false;
        }
        var text = tdObj.html();
        //清空td中的内容
        tdObj.html("");
        var tdWid=tdObj.width()-2;
        var tdHei=tdObj.height()-2;
        //创建一个文本框
        //去掉文本框的边框
        //设置文本框中的文字字体大小是16px
        //使文本框的宽度和td的宽度相同
        //设置文本框的背景色
        //需要将当前td中的内容放到文本框中
        //将文本框插入到td中
        var inputObj = $("<input type='text'>").css({"border":"0","font-family":"Microsoft YaHei","width":"100%","height":"40px","font-size":"16px","text-align":"center"})
            .width(tdWid)
            .height(tdHei)
            .css("background-color","#FFFF80")
            .val(text).appendTo(tdObj);
        //是文本框插入之后就被选中
        inputObj.trigger("focus").trigger("select");
        inputObj.click(function() {
            return false;
        });
        //处理文本框上回车和esc按键的操作
        inputObj.keyup(function(event){
            //获取当前按下键盘的键值
            var keycode = event.which;
            //处理回车的情况
            if (keycode == 13) {
                //获取当当前文本框中的内容
                var inputtext = $(this).val();
                //将td的内容修改成文本框中的内容
                tdObj.html(inputtext);
                var catt = tdObj.parent().children().slice(5,6).text();
                var dogg = tdObj.parent().children().slice(6,7).text();
                var pet0 = catt/1+dogg/1;
                var pett = pet0*1000;
                var monn = pet0*7;
                tdObj.parent().children().slice(7,8).html(pett);
                tdObj.parent().children().slice(8,9).html(monn);
                countRowTotal1();
            }
            //处理esc的情况
            if (keycode == 27) {
                //将td中的内容还原成text
                tdObj.html(text);
            }
        });
    });
}
function countRowTotal1() {
    var table = document.getElementById("targetTable");
    var rows = table.rows.length-1;
    var cat = 0;
    for (var i=7;i<rows;i++){
        var mytable = document.getElementById("targetTable").rows[i].cells[5].innerHTML;
        cat = cat/1+mytable/1;
    }
    document.getElementById('catN').innerText =cat;
    var dog = 0;
    for (var i=7;i<rows;i++){
        var mytable = document.getElementById("targetTable").rows[i].cells[6].innerHTML;
        dog = dog/1+mytable/1;
    }
    document.getElementById('dogN').innerText =dog;
    var pet = 0;
    for (var i=7;i<rows;i++){
        var mytable = document.getElementById("targetTable").rows[i].cells[7].innerHTML;
        pet = pet/1+mytable/1;
    }
    document.getElementById('petN').innerText =pet;
    var mon = 0;
    for (var i=7;i<rows;i++){
        var mytable = document.getElementById("targetTable").rows[i].cells[8].innerHTML;
        mon = mon/1+mytable/1;
    }
    document.getElementById('monN').innerText =mon;
}
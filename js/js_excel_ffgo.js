/**
 * Created by Dixin on 2018/5/14/014.
 */
var idTmr;
function getExplorer()
{
    var explorer = window.navigator.userAgent;
    //ie
    if (explorer.indexOf("MSIE") >= 0)
    {
        return 'ie';
    }
    //firefox
    else if (explorer.indexOf("Firefox") >= 0)
    {
        return 'Firefox';
    }
    //Chrome
    else if (explorer.indexOf("Chrome") >= 0)
    {
        return 'Chrome';
    }
    //Opera
    else if (explorer.indexOf("Opera") >= 0)
    {
        return 'Opera';
    }
    //Safari
    else if (explorer.indexOf("Safari") >= 0)
    {
        return 'Safari';
    }
}
function table2excel(tableid)
{ //整个表格拷贝到EXCEL中

    $(".dd").remove();

    if (getExplorer() == 'ie')
    {
        var curTbl = document.getElementById(tableid);
        var oXL = new ActiveXObject("Excel.Application");

        //创建AX对象excel
        var oWB = oXL.Workbooks.Add();
        //获取workbook对象
        var xlsheet = oWB.Worksheets(1);
        //激活当前sheet
        var sel = document.body.createTextRange();
        sel.moveToElementText(curTbl);
        //把表格中的内容移到TextRange中
        sel.select();
        //全选TextRange中内容
        sel.execCommand("Copy");
        //复制TextRange中内容
        xlsheet.Paste();
        //粘贴到活动的EXCEL中
        oXL.Visible = true;
        //设置excel可见属性

        try
        {
            var fname = oXL.Application.GetSaveAsFilename("Excel.xls", "Excel Spreadsheets (*.xls), *.xls");
        }
        catch (e)
        {
            print("Nested catch caught " + e);
        }
        finally
        {
            oWB.SaveAs(fname);
            oWB.Close(savechanges = false);
            //xls.visible = false;
            oXL.Quit();
            oXL = null;
            //结束excel进程，退出完成
            //window.setInterval("Cleanup();",1);
            idTmr = window.setInterval("Cleanup();", 1);

        }

    }
    else
    {
        tableToExcel(tableid)
    }
}
function Cleanup()
{
    window.clearInterval(idTmr);
    CollectGarbage();
}
var tableToExcel = (function ()
    {
        var uri = 'data:text/xls;charset=utf-8,\ufeff,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64 = function (s)
            {
                return window.btoa(encodeURIComponent(s))
            },
            format = function (s, c)
            {
                return s.replace(/{(\w+)}/g,
                    function (m, p)
                    {
                        return c[p];
                    }
                )
            }
        return function (table, name)
        {
            if (!table.nodeType)
                table = document.getElementById(table)
            var ctx =
                {
                    worksheet : name || 'Worksheet',
                    table : table.innerHTML
                }
            //window.location.href = uri + base64(format(template, ctx))
            var downloadLink = document.createElement("a");
            downloadLink.href = uri + format(template, ctx);
            var myDate = new Date();//获取系统当前时间
            var mon = myDate.getMonth();       //获取当前月份(0-11,0代表1月)
            mon = mon+1;
            var day = myDate.getDate();
            var hou = myDate.getHours();
            if(hou<12){
                var apm = '上午';
            }else if (hou>=12){
                var apm = '下午';
            }
            downloadLink.download = '货物起运前申报单'+mon+'-'+day+apm+'.xls';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    }
)()
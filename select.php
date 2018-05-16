<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#editlink").click(function() {
                $("#selectlink").append("<option value=\"1\">"+"天津"+"</option>");
                i++;
            });
        });
    </script>
</head>
<body>
    <input type="button" id="editlink" value="Add options">
    <div id="editlinkdiv">
        <select id="selectlink" name="selectlink">
            <option value="1">北京</option>
            <option>哈尔滨</option>
        </select>
    </div>

</body>
</html>

<!DOCTYPE html>
<html>
<body>

<title>#3 Test Web Page</title>

<script>
var names=new Array("France","Italy","Germany", "England", "Spain","Sweden","Finland","Ireleand", "Bosnia", "Austria", "Netherlands", "Greece", "Poland", "Denmark", "Switzerland", "Hungary", "Latvia", "Slovakia");
var backColor = "#40FF00";

function changeToNewColorBG(row)
{
    backColor = row.style.background;
    row.style.background ='#40FF00';
}

function changeToOldColorBG(row)
{
    row.style.background = backColor;
}

document.write("<table border='2' align='center' >");
document.write("<tr style='background:"+backColor+"'><th width='50'>ID</th><th width='120'>Name</th><th width='200'>E-mail</th></tr>");
for (id = 0; id < names.length; id++)
{
    backColor = (id % 2 == 0) ? "#A9F5F2" : "#F3F781";
    document.write("<tr style='background:"+backColor+"' onmouseover='changeToNewColorBG(this)' onmouseout='changeToOldColorBG(this)' >");
    document.write("    <td align='center' >"+(id+1)+"</td>");
    document.write("    <td align='left'  style='padding-left:  30px;'>"+names[id]+"</td>")
    document.write("    <td align='right' style='padding-right: 20px;'><a href='mailto:"+names[id]+"@europe.gov'>"+names[id]+"@europe.gov</a></td></tr>");
}
document.write("</table>");
</script>

</body>
</html> 

function setTable(e)
{
    let inp = e.value;
    document.getElementById("column-content").innerHTML = "loading...";
    if(inp != '0') {
        let xmlHttp;
        if (window.XMLHttpRequest) xmlHttp = new XMLHttpRequest();
        else xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4) {
                document.getElementById("column-content").innerHTML = xmlHttp.responseText;
                return false;
            }
        }
        xmlHttp.open("POST", "column.php", true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send("table=" + inp);
    } document.getElementById("column-content").innerHTML = "Please select a table!";
}
function importData()
{
    let continueToSave = 1;
    let extensions = /(\.csv)$/i;
    let tableName = document.getElementsByName("db_table")[0];
    let colName = document.getElementsByName("db_column");
    let tableCols = [];
    for(let columns of colName) {
        if(columns.checked) tableCols.push(columns.value);
    }
    let excelFile = document.getElementsByName("db-excel")[0];
    let imSure = document.getElementsByName("db-sure")[0];
    if(imSure.checked) imSure.value = 1;
    else imSure.value = 0;
    let fd = new FormData();
    fd.append("table",tableName.value);
    fd.append("cols",tableCols);
    fd.append("excel",excelFile.files[0]);
    fd.append("sure",imSure.value);
    document.getElementById("response").innerHTML = "";
    document.getElementById("response").style.display = "";
    if(tableName.value == '0') {
        continueToSave = 0;
        document.getElementById("response").innerHTML += "Please select a table!<br>";
    }
    if(tableCols.length == 0) {
        continueToSave = 0;
        document.getElementById("response").innerHTML += "Please check at least one column!<br>";
    }
    if(excelFile.files.length == '0') {
        continueToSave = 0;
        document.getElementById("response").innerHTML += "Please choose a file!<br>";
    } else {
        if (!extensions.exec(excelFile.value)) {
            continueToSave = 0;
            document.getElementById("response").innerHTML += "Please choose an csv file!<br>";
        }
    }
    if(imSure.value == 0) {
        continueToSave = 0;
        document.getElementById("response").innerHTML += "Please check I'm sure to import!<br>";
    }
    if(continueToSave == 1)
    {
        document.getElementById("response").innerHTML = "";
        document.getElementById("response").classList.remove("alert-danger");
        document.getElementById("response").classList.add("alert-info");
        document.getElementById("response").innerHTML = "waiting...";
        let xmlhttp;
        if (window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
        else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                document.getElementById("response").classList.remove("alert-info");
                document.getElementById("response").classList.add("alert-success");
                document.getElementById("response").innerHTML = xmlhttp.responseText.trim();
                return false;
            }
        }
        xmlhttp.open("POST", "import.php", true);
        xmlhttp.send(fd);
    }
}
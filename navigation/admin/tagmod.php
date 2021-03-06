<?php
    session_start();
?>

<html>
<head>
<meta charset="utf-8">
<META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
<META HTTP-EQUIV="expires" CONTENT="0">

<title>Update</title>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link rel = "stylesheet" href = "main.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

<style type="text/css">
    table.table input{ /*可输入区域样式*/
width:100%;
height: 100%;
border:none; /* 输入框不要边框 */
font-family:Arial;
}
</style>
</head>
    
<body>
<div id="container">
<header>
<button class = "button" onclick="window.location.href = 'insert.php'">News Management</button>
<button class = "button" onclick="window.location.href = 'tagmod.php'">Index Management</button>
<button class = "button" onclick="window.location.href = 'update.php'">News Update</button>
</header>
<section class="main">
<br>
<center><h3>Index Update</h3></center>
<?php
    $servername = "127.0.0.1";      //change the ip address to the server's
    $databasename = "news_content";
    $username = "root";
    $password = "";
    $tag_arr = array();
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$databasename",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->query("SET NAMES utf8");
        $sql = $conn->prepare('SELECT * FROM `navigation`');
        $sql->execute();
        while($result=$sql->fetch(PDO::FETCH_ASSOC)){
            array_push($tag_arr, $result['category']);
        }
        $tag_arr = array_unique($tag_arr);
    }
    catch(PDOException $e) {     
            echo $sql . "<br>" . $e->getMessage();
    }
    
    echo "<select class = 'shortselect' onchange = 'func()' id = 'selection'>";
    foreach($tag_arr as $x=>$x_value){
        echo "<option value = $x_value >$x_value</option>";
    }
    echo "</select>";
    
?>
    
<?php
    $servername = "127.0.0.1";      //change the ip address to the server's
    $databasename = "news_content";
    $username = "root";
    $password = "";
    $type_arr = array();
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$databasename",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->query("SET NAMES utf8");
        $sql = $conn->prepare('SELECT * FROM `navigation`');
        $sql->execute();
        $type_arr = array();
        while($result=$sql->fetch(PDO::FETCH_ASSOC)){
            array_push($type_arr, $result);
        }
        
    }
    catch(PDOException $e) {     
        echo $sql . "<br>" . $e->getMessage();
    }
    
?>

    <table class="table" border="1" align="center">
    <thead>
    <tr>
        
        <th>category</th>
        <th>category_type</th>
        <th>category_weight</th>
        <th>content</th>
        <th>content_weight</th>
        <th>content_link</th>
        <th>operation</th>
    </tr>
    </thead>
    <tbody>
    <form method = 'POST' action = 'operate.php'>
    <tr>
        
        <td> <input name = "input_category" placeholder="category" id = "input_0_0"/></td>
        <td> <input name = "input_type" placeholder="cat_type" id = "input_0_1"/></td>
        <td> <input name = "input_rank" placeholder="cat_weight" id = "input_0_2" /></td>
        <td> <input name = "input_content" placeholder="content" id = "input_0_3"/></td>
        <td> <input name = "input_weight" placeholder="con_weight" id = "input_0_4"/></td>
        <td> <input name = "input_link" placeholder="con_link" id = "input_0_5"/></td>
        
        
        
        <td> <input name = "submit" class = "button-small" type = "submit" value = "up_tag">
             <input name = "submit" class = "button-secsmall" type = "submit" value = "del_tag"></td>
    </tr>
    <tr>
        <input name = "hidden_category" type = "hidden" id = "hidden_0_0"/>
        <input name = "hidden_type" type = "hidden" id = "hidden_0_1"/>
        <input name = "hidden_rank" type = "hidden" id = "hidden_0_2"/>
        <input name = "hidden_content" type = "hidden" id = "hidden_0_3"/>
        <input name = "hidden_weight" type = "hidden" id = "hidden_0_4"/>
        <input name = "hidden_link" type = "hidden" id = "hidden_0_5"/>
    </tr>
    </form>
        
    <form method = 'POST' action = 'operate.php'>
    <tr>
        
        <td> <input name = "input_category" placeholder="category" id = "input_1_0"/></td>
        <td> <input name = "input_type" placeholder="cat_type" id = "input_1_1"/></td>
        <td> <input name = "input_rank" placeholder="cat_weight" id = "input_1_2" /></td>
        <td> <input name = "input_content" placeholder="content" id = "input_1_3" /></td>
        <td> <input name = "input_weight" placeholder="con_weight" id = "input_1_4"/></td>
        <td> <input name = "input_link" placeholder="con_link" id = "input_1_5" /></td>
        
        
        <td> <input name = "submit" class = "button-small" type = "submit" value = "up_tag">
             <input name = "submit" class = "button-secsmall" type = "submit" value = "del_tag"></td>
    </tr>
    <tr>
        <input name = "hidden_category" type = "hidden" id = "hidden_1_0"/>
        <input name = "hidden_type" type = "hidden" id = "hidden_1_1"/>
        <input name = "hidden_rank" type = "hidden" id = "hidden_1_2"/>
        <input name = "hidden_content" type = "hidden" id = "hidden_1_3"/>
        <input name = "hidden_weight" type = "hidden" id = "hidden_1_4"/>
        <input name = "hidden_link" type = "hidden" id = "hidden_1_5"/>
    </tr>    
    </form>
        
    <form method = 'POST' action = 'operate.php'>
    <tr>
        
        <td> <input name = "input_category" placeholder="category" id = "input_2_0"/></td>
        <td> <input name = "input_type" placeholder="cat_type" id = "input_2_1"/></td>
        <td> <input name = "input_rank" placeholder="cat_weight" id = "input_2_2"/></td>
        <td> <input name = "input_content" placeholder="content" id = "input_2_3"/></td>
        <td> <input name = "input_weight" placeholder="con_weight" id = "input_2_4"/></td>
        <td> <input name = "input_link" placeholder="con_link" id = "input_2_5"/></td>
        
        
        <td> <input name = "submit" class = "button-small" type = "submit" value = "up_tag">
             <input name = "submit" class = "button-secsmall" type = "submit" value = "del_tag"></td>
    </tr>
    
    <tr>
        <input name = "hidden_category" type = "hidden" id = "hidden_2_0"/>
        <input name = "hidden_type" type = "hidden" id = "hidden_2_1"/>
        <input name = "hidden_rank" type = "hidden" id = "hidden_2_2"/>
        <input name = "hidden_content" type = "hidden" id = "hidden_2_3"/>
        <input name = "hidden_weight" type = "hidden" id = "hidden_2_4"/>
        <input name = "hidden_link" type = "hidden" id = "hidden_2_5"/>
    </tr>
        
    </form>
    
    <form method = 'POST' action = 'operate.php'>
    <tr>
        
        <td> <input name = "input_category" placeholder="category" id = "input_3_0"/></td>
        <td> <input name = "input_type" placeholder="cat_type" id = "input_3_1"/></td>
        <td> <input name = "input_rank" placeholder="cat_weight" id = "input_3_2"/></td>
        <td> <input name = "input_content" placeholder="content" id = "input_3_3"/></td>
        <td> <input name = "input_weight" placeholder="con_weight" id = "input_3_4"/></td>
        <td> <input name = "input_link" placeholder="con_link" id = "input_3_5"/></td>
        
        
        <td> <input name = "submit" class = "button-small" type = "submit" value = "up_tag">
             <input name = "submit" class = "button-secsmall" type = "submit" value = "del_tag"></td>
    </tr>
    <tr>
        <input name = "hidden_category" type = "hidden" id = "hidden_3_0"/>
        <input name = "hidden_type" type = "hidden" id = "hidden_3_1"/>
        <input name = "hidden_rank" type = "hidden" id = "hidden_3_2"/>
        <input name = "hidden_content" type = "hidden" id = "hidden_3_3"/>
        <input name = "hidden_weight" type = "hidden" id = "hidden_3_4"/>
        <input name = "hidden_link" type = "hidden" id = "hidden_3_5"/>
    </tr>
    </form>
    </tbody>
</table>

    
    
    
    


</section>
    <footer></footer>
</div>

 </body> 
    
</html>




<script>
    
function func(){
    
    var selected = $('select option:selected').val();
    var temp=<?php echo json_encode($type_arr);?>;
    var tag_list = Array();
    for(var i = 0; i < temp.length; i++){
        if(Object.values(temp[i])[0] == selected){
            tag_list.push(Object.values(temp[i]));
        }
    }
    
    for(var i = 0; i < tag_list.length; i++){
        for(var j = 0; j < tag_list[i].length; j++){
            var temp_id = "input" + "_" + i + "_" + j ;
            var hidden_id = "hidden" + "_" + i + "_" + j;
            document.getElementById(temp_id).value = tag_list[i][j];
            document.getElementById(hidden_id).value = tag_list[i][j];
        }
    }
    for(var i = tag_list.length; i < 4; i++){
        for(var j = 0; j < 7; j++){
            var temp_id = "input" + "_" + i + "_" + j ;
            var hidden_id = "hidden" + "_" + i + "_" + j;
            document.getElementById(temp_id).value = '';
            document.getElementById(hidden_id).value = '';
        }
    }
    
    
}
</script>

<?php
    
    $userinfo = @$_POST['username'];
    $passinfo = @$_POST['password'];
    
    $servername = "127.0.0.1";      //change the ip address to the server's
    $databasename = "news_content";
    $username = "root";
    $password = "";
    if(!isset($_SESSION['userinfo'])){
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
            $conn->query("SET NAMES utf8"); 
            $sql = $conn->prepare('SELECT * FROM `admin` WHERE `username` = :userinfo
                                        and `password` = :passinfo');
            $sql->execute(array(':userinfo' => $userinfo, ':passinfo' => $passinfo));
            $numcount=$sql->rowCount();

            if($numcount == 0){
                echo "<script>confirm('Password not match!')</script>";
                echo "<script>window.location.href = 'index.php'</script>";
                exit();
            }else{
                $_SESSION['userinfo'] = $userinfo;
            }
        }
        catch(PDOException $e) {     
                echo $sql . "<br>" . $e->getMessage();
        }
    }
?>

<script>

    onload = function() {
            document.getElementById("selection").selectedIndex = 0;
    }
   
    document.onkeydown = function(event) {
        var target, code, tag;
        if (!event) {
            event = window.event; //针对ie浏览器
            target = event.srcElement;
            code = event.keyCode;
            if (code == 13) {
                tag = target.tagName;
                if (tag == "TEXTAREA") { return true; }
                else { return false; }
            }
        }
        else {
            target = event.target; //针对遵循w3c标准的浏览器，如Firefox
            code = event.keyCode;
            if (code == 13) {
                tag = target.tagName;
                if (tag == "INPUT") { return false; }
                else { return true; }
            }
        }
    };
</script>
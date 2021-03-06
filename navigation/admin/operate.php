<?php
    function is_valid($value){
        $value = trim($value);
        return !empty($value);
    }
?>

<?php
    if(!empty($_POST['id'])){
        $length = count($_POST['id']);
    }
    
    $servername = "127.0.0.1";
    $databasename = "news_content";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=$databasename",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("SET NAMES utf8");
    if($_POST['submit'] == 'insert'){
        for($i = 0; $i < $length; $i++){
            if(is_valid($_POST['id'][$i]) and is_valid($_POST['item'][$i]) and
               is_valid($_POST['type'][$i]) and is_valid($_POST['link'][$i])){ 
                $sql = "INSERT INTO picture (id, item, type, note, link)
                        VALUES ('" . $_POST['id'][$i] . "', '" . $_POST['item'][$i] . "', '" . 
                        $_POST['type'][$i] . "', '" . $_POST['note'][$i] . "', '"  . $_POST['link'][$i] . "')";

                $conn->exec($sql);
            }
        }
        echo "<script>confirm('add successful!')</script>";
    }else if($_POST['submit'] == 'update'){
        
        $sql = $conn->prepare("SELECT * FROM `picture` WHERE `id` = :id and `item` = :item");
        $sql->execute(array(':id' => $_POST['id'][0], ':item' => $_POST['item'][0]));
        $numcount=$sql->rowCount();
        if($numcount == 0){
            echo "<script>confirm('no sql matches')</script>";
        }else{
            $sql = "UPDATE `picture` SET `type` = '" . $_POST['type'][0] . "', `note` = '" . $_POST['note'][0] . 
                    "', `link` = '" . $_POST['link'][0] . "' WHERE `id` = '" . $_POST['id'][0] . 
                    "' AND `item` = '" . $_POST['item'][0] . "';";
            
            $conn->exec($sql);
            echo "<script>confirm('update successful')</script>";
        }
    }else if($_POST['submit'] == 'up_tag'){
        $category = $_POST['hidden_category'];
        $type = $_POST['hidden_type'];
        $rank = $_POST['hidden_rank'];
        $content = $_POST['hidden_content'];
        $weight = $_POST['hidden_weight'];
        $link = $_POST['hidden_link'];
        $new_category = $_POST['input_category'];
        $new_type = $_POST['input_type'];
        $new_rank = $_POST['input_rank'];
        $new_content = $_POST['input_content'];
        $new_weight = $_POST['input_weight'];
        $new_link = $_POST['input_link'];
        $sql = $conn->prepare("SELECT * FROM `navigation` WHERE `category` = :category and `cat_type` = :type
                               and `cat_weight` = :rank and `content` = :content and `content_weight` = :weight
                               and `content_link` = :link ");
        $sql->execute(array(':category'=>$category, ':type'=>$type, ':rank'=>$rank, ':content'=>$content,
                            ':weight'=>$weight, ':link'=>$link));
        $numcount = $sql->rowcount();
        if($numcount == 0){
            $sql = "INSERT INTO navigation (category, cat_type, cat_weight, content, content_weight, content_link)
                        VALUES ('" . $new_category . "', " . $new_type . ", " . $new_rank . ", '" 
                        . $new_content . "', "  . $new_weight . ", '" . $new_link . "')";
            $conn->exec($sql);
            echo "<script>confirm('insert successful')</script>";
        }else{
            $sql = "DELETE FROM `navigation` WHERE `category` = '" . $category . "' and `cat_type` = " 
                               . $type . " and `cat_weight` = " . $rank . " and `content` = '" . $content 
                               . "' and `content_weight` = " . $weight . " and `content_link` = '"
                               . $link . "';";
            $conn->exec($sql);
            $sql = "INSERT INTO navigation (category, cat_type, cat_weight, content, content_weight, content_link)
                        VALUES ('" . $new_category . "', " . $new_type . ", " . $new_rank . ", '" 
                        . $new_content . "', "  . $new_weight . ", '" . $new_link . "')";
            $conn->exec($sql);
            echo "<script>confirm('update successful')</script>";
        }
        
    }else if($_POST['submit'] == 'del_tag'){
        $category = $_POST['input_category'];
        $type = $_POST['input_type'];
        $rank = $_POST['input_rank'];
        $content = $_POST['input_content'];
        $weight = $_POST['input_weight'];
        $link = $_POST['input_link'];
        $sql = $conn->prepare("SELECT * FROM `navigation` WHERE `category` = :category and `cat_type` = :type
                               and `cat_weight` = :rank and `content` = :content and `content_weight` = :weight
                               and `content_link` = :link ");
        $sql->execute(array(':category'=>$category, ':type'=>$type, ':rank'=>$rank, ':content'=>$content,
                            ':weight'=>$weight, ':link'=>$link));
        $numcount = $sql->rowcount();
        if($numcount == 0){
            echo "<script>confirm('no sql matches')</script>";
        }else{
            $sql = "DELETE FROM `navigation` WHERE `category` = '" . $category . "' and `cat_type` = " 
                               . $type . " and `cat_weight` = " . $rank . " and `content` = '" . $content 
                               . "' and `content_weight` = " . $weight . " and `content_link` = '"
                               . $link . "';";
             
            $conn->exec($sql);
            echo "<script>confirm('delete successful')</script>";
        }
    }
    
    echo "<script>alert('jumping to original page...');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    
?>
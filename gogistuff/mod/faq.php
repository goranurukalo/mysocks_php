<?php
if($_SESSION['role']==1){
    if(!isset($_REQUEST['job'])){
        header('location: n1shhh.php');
    }else{
        $job = $_REQUEST['job'];
        if(!($job > 0 && $job<5)){
            header('location: n1shhh.php');
        }
        else{

            if($job == '1'){
                if(isset($_POST['submitfaq'])){
                    $faqdata = array();
                    $error = 0;

                    if(isset($_POST['question'])){
                        $regQuestion = "/^[\w\?\s\']{3,127}$/";

                        if(!preg_match($regQuestion, $_POST['question'])){
                            $error = 1;
                        }
                        else{
                            $faqdata['question'] = $_POST['question'];
                        }
                    }
                    else{
                        $error = 1;
                    }
                    if(isset($_POST['answer'])){
                        $regQuestion = "/^[\w\?\s\'\.\,]{3,254}$/";

                        if(!preg_match($regQuestion, $_POST['answer'])){
                            $error = 1;
                        }
                        else{
                            $faqdata['answer'] = $_POST['answer'];
                        }
                    }
                    else{
                        $error = 1;
                    }

                    if(!$error){
                        include("dbconnection.php");

                        $query = sprintf("INSERT INTO faq VALUES('','%s','%s')",$faqdata['question'],$faqdata['answer']);

                        $result = mysql_query($query, $connect);
                        mysql_close($connect);

                        if($result){
                            echo "upisano";
                        }
                        else{
                            echo "nije upisano u bazu";
                        }
                    }
                    else{
                        echo "nije prosao validaciju";
                    }
                }

                echo"<div class='bigText'>FAQ > ADD</div>";
                echo"
                <div class='faqaddblock forminside'>
                    <form action='".$_SERVER['PHP_SELF']."' method='POST' onsubmit='return addfaq();'>
                        <input type='hidden' name='page' id='page' value='11'>
                        <input type='hidden' name='job' id='job' value='1'>
                        <input type='text' name='question' id='question' placeholder='QUESTION?' value='".@$_POST['question']."'>
                        <input type='text' name='answer' id='answer' class='answers' placeholder='ANSWER?' value='".@$_POST['answer']."'>

                        <input type='submit' name='submitfaq' id='submitfaq' value='ADD FAQ'>
                    </form>";
                echo"</div>
                ";

            }
            else{
                if(!isset($_REQUEST['productID'])){
                    include('funct/itemfunct.php');
                    fillitems(array('page'=>$page,'job'=>$job));
                }
                else{
                    //
                    // pitaj koji je job i onda prikazi ga tako kako treba
                    //
                    if($job == 2){
                        include("dbconnection.php");

                        
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                                if(isset($_POST['submitfaqmanage'])){
                                    $query = sprintf("UPDATE faq SET faqQuestion='%s', faqAnswer='%s' WHERE faqID=%d",$_POST['managequestion'],$_POST['manageanswer'],$_REQUEST['productID']);
                                    $result = mysql_query($query,$connect);
                                    if($result){
                                        echo "upisano";
                                    }
                                    else{
                                        echo "nije upisano";
                                    }
                                }
                                $query = sprintf("SELECT * FROM faq WHERE faqID=%d",$_REQUEST['productID']);
                                $result = mysql_query($query,$connect);
                                if(mysql_num_rows($result)){
                                $row = mysql_fetch_array($result);
                                   
                                echo"<div class='bigText'>FAQ > MANAGE</div>";
                                echo"
                                    <div class='faqaddblock forminside'>
                                        <form action='#' method='POST' onsubmit='return addfaq();'>
                                            <input type='hidden' name='page' id='page' value='11'>
                                            <input type='hidden' name='job' id='job' value='2'>
                                            <input type='hidden' name='productID' id='productID' value='".$row['faqID']."'>
                                            <input type='text' name='managequestion' id='managequestion' placeholder='QUESTION?' value='".$row['faqQuestion']."'>
                                            <input type='text' name='manageanswer' class='manageanswer' placeholder='ANSWER?' value='".$row['faqAnswer']."'>

                                            <input type='submit' name='submitfaqmanage' id='submitfaqmanage' value='MANAGE FAQ'>
                                        </form>";
                                echo"</div>
                                    ";
                                   }
                            }
                        }
                        else{
                            header('location: n1shhh.php');
                        }
                        mysql_close($connect);
                    }
                    else if($job == 3){

                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                                include("dbconnection.php");
                                $query = sprintf("DELETE FROM faq WHERE faqID=%d",$_REQUEST['productID']);
                                $result = mysql_query($query,$connect);
                                mysql_close($connect);
                                if($result){
                                    $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
                                    header('location: n1shhh.php?page=11&job=3&offset='.$offset);
                                }
                                else{
                                    echo "greska pri brisanju u bazi";
                                }
                            }
                        }
                        
                    }
                    else if($job == 4){

                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                                include("dbconnection.php");
                                $query = sprintf("SELECT * FROM faq WHERE faqID=%d",$_REQUEST['productID']);
                                $result = mysql_query($query,$connect);
                                mysql_close($connect);

                                if(mysql_num_rows($result)){
                                    $row = mysql_fetch_array($result);
                                    echo"<div class='viewproductblock'>
                                            <div class='vpblock'>
                                                <div class='vpbname'>FAQ ID: </div>
                                                <div class='vpbtext'>".$row['faqID']."</div>
                                            </div>
                                            <div class='vpblock'>
                                                <div class='vpbname'>Question: </div>
                                                <div class='vpbtext'>".$row['faqQuestion']."</div>
                                            </div>
                                            <div class='vpblock'>
                                                <div class='vpbname'>Answer: </div>
                                                <div class='vpbtext'>".$row['faqAnswer']."</div>
                                            </div>
                                        </div>";
                                }
                            }
                        }



                    }

                }
            }
        }
    }
}
?>
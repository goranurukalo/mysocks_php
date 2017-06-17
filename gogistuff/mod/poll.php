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
                echo"<div class='bigText'>POLL > ADD</div>";
                if(isset($_POST['submitpoll'])){
                    $polldata = array();
                    $error = 0;

                    if(isset($_POST['question'])){
                        $regQuestion = "/^[\w\?\s\'\,\.]{3,254}$/";

                        if(!preg_match($regQuestion, $_POST['question'])){
                            $error = 1;
                        }
                        else{
                            $polldata['question'] = $_POST['question'];
                        }
                    }
                    else{
                        $error = 1;
                    }
                    if(isset($_POST['answers'])){
                        $polldata['answers'] = array();
                        foreach($_POST['answers'] as $row){
                            if(preg_match("/^[\w\s\'\.\,\!\d]{1,127}$/", $row)){
                                $polldata['answers'][] = $row;
                            }
                        }
                    }
                    else{
                        $error = 1;
                    }

                    if(count($polldata['answers'])>1 && !$error){
                        #upis u bazu

                        include("dbconnection.php");
                        $queryquestion = sprintf("INSERT INTO pollquestion VALUES('','%s',0)",$polldata['question']);
                        $result = mysql_query($queryquestion,$connect);
                        
                        #id od poslednjeg upisa
                        $polldata['questionID'] = mysql_insert_id();

                        foreach($polldata['answers'] as $row){
                            $queryanswer = sprintf("INSERT INTO pollanswer VALUES('','%s',%d,0)",$row,$polldata['questionID']);
                            $result = mysql_query($queryanswer,$connect);                            
                        }
                        
                        mysql_close($connect);
                    }else{echo "nije upisao";}
                }

                echo"
                <div class='faqaddblock forminside'>
                    <form action='".$_SERVER['PHP_SELF']."' method='POST' onsubmit='return addpoll();'>
                        <input type='hidden' name='page' id='page' value='12'>
                        <input type='hidden' name='job' id='job' value='1'>
                        <input type='text' name='question' id='question' placeholder='QUESTION?'>
                        <div id='answerparent'>
                            <input type='text' name='answers[]' class='answers' placeholder='ANSWER'>
                            <input type='text' name='answers[]' class='answers' placeholder='ANSWER'>
                        </div>
                        <button type='button' onclick='ineedanswer();' class='addmorebutton'>Add answer!</button>
                        <input type='submit' name='submitpoll' id='submitpoll' value='ADD POLL'>
                    </form>";?>
                    <script>
                        function ineedanswer(){
                            var parent = document.getElementById('answerparent');
                            var answer = document.createElement('input');
                            answer.setAttribute('type', 'text');
                            answer.setAttribute('name', 'answers[]');
                            answer.setAttribute('class', 'answers');
                            answer.setAttribute('placeholder', 'ANSWER');

                            parent.appendChild(answer);
                        }
                    </script><?php
                echo"</div>
                ";
                
            }
            else{
                if(!isset($_REQUEST['productID'])){
                    include('funct/itemfunct.php');
                    fillitems(array('page'=>$page,'job'=>$job));
                }
                else{
                    if($job == 2){
                        //echo "manage";

                        #zahtev za remove answer-a                        
                        if(isset($_REQUEST['pollremoveanswer'])){
                            if(preg_match("/^\d+$/", $_REQUEST['pollremoveanswer'])){
                                include("dbconnection.php");
                                $query = sprintf("DELETE FROM pollanswer WHERE pollAnswerID=%d",$_REQUEST['pollremoveanswer']);
                                $result = mysql_query($query,$connect);
                                mysql_close($connect);
                            }
                        }
                        

                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){

                                if(isset($_POST['submitpollmanage'])){
                                    #upisi u bazu

                                        $polldata = array();
                                        $error = 0;

                                        if(isset($_POST['question'])){
                                            $regQuestion = "/^[\w\?\s\'\,\.]{3,254}$/";

                                            if(!preg_match($regQuestion, $_POST['question'])){
                                                $error = 1;
                                            }
                                            else{
                                                $polldata['question'] = $_POST['question'];
                                            }
                                        }
                                        else{
                                            $error = 1;
                                        }

                                        if(isset($_POST['answers'])){
                                            $polldata['answers'] = array();
                                            foreach($_POST['answers'] as $row){
                                                if(preg_match("/^[\w\s\'\.\,\!\d]{1,127}$/", $row)){
                                                    $polldata['answers'][] = $row;
                                                }
                                            }
                                        }
                                        else{
                                            $error = 1;
                                        }

                                        if(isset($_POST['answerID'])){
                                            $polldata['answerID'] = array();
                                            foreach($_POST['answerID'] as $row){
                                                if(preg_match("/^\d+$/", $row)){
                                                    $polldata['answerID'][] = $row;
                                                }
                                            }
                                        }
                                        else{
                                            $error = 1;
                                        }

                                        if(count($polldata['answers'])>1 && !$error && count($polldata['answerID'])>=2){
                                            #upis u bazu

                                            include("dbconnection.php");
                                            $queryquestion = sprintf("UPDATE pollquestion SET pollQuestion='%s' WHERE pollQuestionID=%d ",$polldata['question'], $_REQUEST['productID']);
                                            $result = mysql_query($queryquestion,$connect);


                                            for($i = 0 ; $i < count($polldata['answerID']); $i++){
                                                $queryanswer = sprintf("UPDATE pollanswer SET pollAnswer='%s' WHERE pollAnswerID=%d",$polldata['answers'][$i],$polldata['answerID'][$i]);
                                                $result = mysql_query($queryanswer,$connect);
                                            }
                                            for($i = count($polldata['answerID']); $i < count($polldata['answers']);$i++){
                                                $queryanswer = sprintf("INSERT INTO pollanswer VALUES('','%s',%d,0)",$polldata['answers'][$i],$_REQUEST['productID']);
                                                $result = mysql_query($queryanswer,$connect); 
                                            }
                                            
                                            mysql_close($connect);
                                        }
                                        else{
                                            echo "nije uso u if za upis";
                                        }


                                }

                                include("dbconnection.php");
                                $query = sprintf("SELECT * FROM pollquestion WHERE pollQuestionID=%d",$_REQUEST['productID']);
                                $result = mysql_query($query,$connect);
                                

                                if(mysql_num_rows($result)){
                                    $row = mysql_fetch_array($result);

                                    $query = sprintf("SELECT * FROM pollanswer WHERE pollQuestionID=%d",$row['pollQuestionID']);
                                    $res = mysql_query($query,$connect);
                                    mysql_close($connect);


                                    echo"
                                        <div class='faqaddblock forminside'>
                                            <form action='".$_SERVER['PHP_SELF']."' method='POST' onsubmit='return managepoll();'>
                                                <input type='hidden' name='page' id='page' value='12'>
                                                <input type='hidden' name='job' id='job' value='2'>
                                                <input type='hidden' name='productID' id='productID' value='".$row['pollQuestionID']."'>
                                                <input type='text' name='question' id='question' placeholder='QUESTION?' value='".$row['pollQuestion']."'>
                                                <div id='answerparent'>";
                                            
                                    
                                    while($r = mysql_fetch_array($res)){
                                        echo "
                                        <input type='hidden' name='answerID[]' id='answerID[]' value='".$r['pollAnswerID']."'>
                                        <input type='text' name='answers[]' class='answers' placeholder='ANSWER' value='".$r['pollAnswer']."'>";
                                        if(mysql_num_rows($res)>2){
                                            echo"<a class='answerRemove' href='n1shhh.php?page=12&job=2&productID=".$row['pollQuestionID']."&pollremoveanswer=".$r['pollAnswerID']."'>Remove</a>";
                                        }       
                                    }
                                    echo"   </div>
                                                <button type='button' onclick='ineedanswer();' class='addmorebutton'>Add answer!</button>
                                                <input type='submit' name='submitpollmanage' id='submitpollmanage' value='MANAGE POLL'>
                                            </form>";?>
                                            <script>
                                                function ineedanswer(){
                                                    var parent = document.getElementById('answerparent');
                                                    var answer = document.createElement('input');
                                                    answer.setAttribute('type', 'text');
                                                    answer.setAttribute('name', 'answers[]');
                                                    answer.setAttribute('class', 'answers');
                                                    answer.setAttribute('placeholder', 'ANSWER');

                                                    parent.appendChild(answer);
                                                }
                                            </script><?php
                                        echo"</div>";

                                }
                            }
                        }
                    }
                    else if($job == 3){

                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                                include("dbconnection.php");
                                $query = sprintf("DELETE FROM pollanswer WHERE pollQuestionID=%d",$_REQUEST['productID']);
                                $result = mysql_query($query,$connect);
                                                            
                                $query = sprintf("DELETE FROM pollquestion WHERE pollQuestionID=%d",$_REQUEST['productID']);
                                $result = mysql_query($query,$connect);
                                mysql_close($connect);
                                if($result){
                                    $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
                                    header('location: n1shhh.php?page=12&job=3&offset='.$offset);
                                }
                                else{
                                    echo "nije obrisan question";
                                }
                            }
                        }
                    }
                    else if($job == 4){
                        
                        
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                                include("dbconnection.php");
                                $query = sprintf("SELECT * FROM pollquestion WHERE pollQuestionID=%d",$_REQUEST['productID']);
                                $result = mysql_query($query,$connect);
                                

                                if(mysql_num_rows($result)){
                                    $row = mysql_fetch_array($result);

                                    $query = sprintf("SELECT * FROM pollanswer WHERE pollQuestionID=%d",$row['pollQuestionID']);
                                    $res = mysql_query($query,$connect);
                                    mysql_close($connect);

                                    echo"<div class='viewproductblock'>
                                            <div class='vpblock'>
                                                <div class='vpbname'>Poll ID: </div>
                                                <div class='vpbtext'>".$row['pollQuestionID']."</div>
                                            </div>
                                            <div class='vpblock'>
                                                <div class='vpbname'>Poll question: </div>
                                                <div class='vpbtext'>".$row['pollQuestion']."</div>
                                            </div>
                                            <div class='pollspacer'></div>";

                                    while($r = mysql_fetch_array($res)){
                                        echo"
                                            <div class='vpblock'>
                                                <div class='vpbname'>AnswerID: </div>
                                                <div class='vpbtext'>".$r['pollAnswerID']."</div>
                                            </div>
                                            <div class='vpblock'>
                                                <div class='vpbname'>Answer: </div>
                                                <div class='vpbtext'>".$r['pollAnswer']."</div>
                                            </div>
                                            <div class='vpblock'>
                                                <div class='vpbname'>Votes: </div>
                                                <div class='vpbtext'>".$r['vote']."</div>
                                            </div>
                                            <div class='pollspacer'></div>
                                            ";
                                        
                                    }
                                    echo "</div>";
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
<?php
    #kada nesto dodje procesiraj i posalji rezultate nazad
    //echo $_GET['visitPer'];
    if(isset($_GET['visitPer'])){
        if(preg_match("/^[\w]{3,5}$/",$_GET['visitPer'])){
            include('dbconnection.php');
            $query = "";
            $date = array();
            if($_GET['visitPer'] == "year"){
                $data = array();

                for($i = 1; $i < 13; $i++){
                    $query = "SELECT COUNT(*) as c FROM visit WHERE time > ".mktime(0, 0, 0, $i, 1, date('Y'))." AND  time < ".mktime(23, 59, 59, $i+1, 0, date('Y'));
                    $result = mysql_query($query,$connect);
                    $date[date('M',mktime(0, 0, 0, $i, 1, date('Y')))]=mysql_fetch_array($result)['c'];
                }
                echo json_encode($date);
            }


            if($_GET['visitPer'] == "month"){
                $data = array();

                for($i = 1; $i < date('t')+1; $i++){
                    $query = "SELECT COUNT(*) as c FROM visit WHERE time > ".mktime(0, 0, 0, date('m'), $i, date('Y'))." AND  time < ".mktime(23, 59, 59, date('m'), $i, date('Y'));
                    $result = mysql_query($query,$connect);
                    $date[$i]=mysql_fetch_array($result)['c'];
                }
                echo json_encode($date);
                
            }




            if($_GET['visitPer'] == "week"){//output 7 values
                $data = array();

                for($i = 0; $i < 7; $i++){
                    $query = "SELECT COUNT(*) as c FROM visit WHERE time > ".mktime(0, 0, 0, date('m'), date('d')-$i, date('Y'))." AND  time < ".mktime(23, 59, 59, date('m'), date('d')-$i, date('Y'));
                    $result = mysql_query($query,$connect);
                    $date[date('D', mktime(0, 0, 0, date('m'), date('d')-$i, date('Y')))]=mysql_fetch_array($result)['c'];
                }
                echo json_encode($date);
                
            }



            if($_GET['visitPer'] == "day"){
                $data = array();

                for($i = 0; $i < 24; $i++){
                    $query = "SELECT COUNT(*) as c FROM visit WHERE time > ".mktime($i, 0, 0, date('m'), date('d'), date('Y'))." AND  time < ".mktime($i, 59, 59, date('m'), date('d'), date('Y'));
                    $result = mysql_query($query,$connect);
                    $date[$i]=mysql_fetch_array($result)['c'];
                }
                echo json_encode($date);
            }
            
            mysql_close($connect);



            if(false){
                                                    //H , M , S , M , D , Y
                //echo "mktime:".mktime()."-time".mktime(0, 0, 0, 1, 1, date("Y"));
            }
        }
    }
?>
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

                if(!isset($_REQUEST['productID'])){
                    include('funct/itemfunct.php');
                    fillitems(array('page'=>$page,'job'=>$job));
                }
                else{
                    if($job == 1){
                        //echo "add";
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                            include("dbconnection.php");
                            $query = sprintf("UPDATE product SET categoryID = 3 WHERE productID=%d",$_REQUEST['productID']);
                            $result = mysql_query($query, $connect);
                            mysql_close($connect);
                        
                            if($result){
                                $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
                                header('location: n1shhh.php?page=10&job=1&offset='.$offset);
                            }
                        }
                    }
                    }
                    else if($job == 2){
                        //echo"manage";

                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                            include("dbconnection.php");
                            if(isset($_POST['submitsalemanage'])){
                                
                                if(isset($_POST['saleprocent'])){
                                        if(preg_match("/^[1-9]{0,1}[0-9]{1,2}$|^100$/",$_POST['saleprocent'])){
                                            $query = sprintf("UPDATE product SET saleProcent=%d WHERE productID=%d",$_POST['saleprocent'],$_REQUEST['productID']);
                                            $result = mysql_query($query, $connect);
                                            
                                            if($result){
                                                echo "uspesana promena sale procenta";
                                            }
                                        }
                                }  
                                
                            }

                            
                            $query = sprintf("SELECT * FROM product WHERE productID=%d",$_REQUEST['productID']);
                            $result = mysql_query($query, $connect);
                            mysql_close($connect);
                            if(mysql_num_rows($result)>0){


                                $row = mysql_fetch_array($result);



                                echo"
                                    <div class='useraddf forminside'>
                                        <form action='".$_SERVER['PHP_SELF']."' method='POST' id='salemanage' onsubmit='return managesale();'>
                                            <input type='hidden' name='page' value='10'>
                                            <input type='hidden' name='job' value='2'>
                                            <input type='hidden' name='productID' value='".$row['productID']."'>
                                            <div class='viewproductblock'>
                                            <div class='vpblock'>
                                                <div class='vpbname'>Product price: </div>
                                                <div class='vpbtext'>$".($row['price']/100)."</div>
                                            </div>
                                            <div class='vpblock'>
                                                <div class='vpbname'>NEW PRICE: </div>
                                                <div class='vpbtext'>$".(($row['price'] - ($row['saleProcent']/100)*$row['price'])/100)."</div>
                                            </div>
                                            </div>
                                            <input type='text' name='saleprocent' id='saleprocent' placeholder='SALE PERCENT' value='".$row['saleProcent']."'>

                                            <input type='submit' name='submitsalemanage' id='submitsalemanage' value='MANAGE SALE'>
                                        </form>
                                    </div>";
                            }
                        }
                    }

                    }
                    else if($job == 3){
                        //echo"remove";
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                            include("dbconnection.php");
                            $query = sprintf("UPDATE product SET categoryID = 4 WHERE productID=%d",$_REQUEST['productID']);
                            $result = mysql_query($query, $connect);
                            mysql_close($connect);
                        
                        if($result){
                            $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
                            header('location: n1shhh.php?page=10&job=3&offset='.$offset);
                        }
                        }
                    }
                    }
                    else if($job == 4){
                        //echo"list";
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                        include("dbconnection.php");
                        $query = sprintf("SELECT * FROM product p JOIN users u ON u.userID=p.userAddID JOIN color c ON c.colorID=p.colorID JOIN material m ON m.materialID=p.materialID JOIN pattern pa ON pa.patternID=p.patternID JOIN category ca ON ca.categoryID=p.categoryID WHERE productID=%d",$_REQUEST['productID']);
                        $result = mysql_query($query, $connect);
                        mysql_close($connect);
                        if(mysql_num_rows($result)){
                            
                        
                        $row = mysql_fetch_array($result);
                        echo"<div class='viewproductblock'>
                            <div class='vpblock'>
                                <div class='vpbname'>ProductID: </div>
                                <div class='vpbtext'>".$row['productID']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Product name: </div>
                                <div class='vpbtext'>".$row['productName']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Old price: </div>
                                <div class='vpbtext'>$".($row['price']/100)."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Sale procent: </div>
                                <div class='vpbtext'>".$row['saleProcent']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>NEW PRICE: </div>
                                <div class='vpbtext'>$".(($row['price'] - ($row['saleProcent']/100)*$row['price'])/100)."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Quantity: </div>
                                <div class='vpbtext'>".$row['quantity']."</div>
                            </div>
                            <div class='vpblock'>
                                <img width='230' height='230' class='vpbimg' src='".$row['imgLink']."' alt=''></img>
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
?>
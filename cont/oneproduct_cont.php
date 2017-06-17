<?php
    if(isset($_REQUEST['productID'])){
        if(preg_match("/^\d+$/",$_REQUEST['productID'])){


#prvo ako je stisnuo submit button i porucio nesto pa tek onda ucitaj
        if(isset($_REQUEST['addoneproducttobag'])){
            if(!isset($_SESSION['role'])){
                header('Location: index.php?page=3');
            }
            else{
                $producttobag = array();
                $error = 0;

                if(isset($_POST['productID'])){
                    if(preg_match("/^\d+$/",$_POST['productID'])){
                            $producttobag['productID'] = $_POST['productID'];
                    }
                    else{
                        $error++;
                    }
                }
                else{
                    $error++;
                }
                if(isset($_POST['oneproductquantity'])){
                    if(preg_match("/^\d+$/",$_POST['oneproductquantity'])){
                            $producttobag['quantity'] = $_POST['oneproductquantity'];
                    }
                    else{
                        $error++;
                    }
                }
                else{
                    $error++;
                }
                if(isset($_POST['opsize'])){
                    if(preg_match("/^\d+$/",$_POST['opsize'])){
                            $producttobag['size'] = $_POST['opsize'];
                    }
                    else{
                        $error++;
                    }
                }
                else{
                    $error++;
                }

                if(!$error){
                    include("dbconnection.php");
                    $query = sprintf("INSERT INTO shoppingbaglist VALUES('', %d, %d, %d, %d)",$_SESSION['userID'],$producttobag['productID'],$producttobag['size'],$producttobag['quantity']);
                    $result = mysql_query($query,$connect);
        
                    mysql_close($connect);
                    if($result){
                        $_SESSION['numBagItems']++;
                        header('Location: index.php?page=13');
                    }
                    else{
                        echo "Sorry something went wrong";
                    }
                }
            }
        }

        
            include("dbconnection.php");

            $query = sprintf("SELECT * FROM product p JOIN color c ON p.colorID=c.colorID WHERE productID = %d",$_REQUEST['productID']);
            $result = mysql_query($query,$connect);

            if(mysql_num_rows($result)){
                $row = mysql_fetch_array($result);

                echo "<div class='oneproductleftimage'>
                            <img src='".$row['imgLink']."' alt='".$row['imgAlt']."' />
                        </div>
                        <div class='oneproductright'>
                            <div class='oprproductname'>".$row['productName']."</div>
                            <div class='oprproductid'>#".$row['productID']."</div>
                            <div class='oprprice'>$".(($row['price'] - ($row['saleProcent']/100)*$row['price'])/100)."</div>
            
                            <form action='".$_SERVER['PHP_SELF']."' method='POST' id='oneproductform' onsubmit='return submitoneproduct();'>
                                
                                <input type='hidden' name='page' id='page' value='12'>
                                <input type='hidden' name='productID' id='productID' value='".$_REQUEST['productID']."'>
                                ";
                                echo"
                                <div class='oprsize'>
                                    <select id='oneproductsize' name='opsize' class='top_select_sort _select_sort' selected='selected'>";
                                    $fk = 0;
                                    if($row['forMWK'] == 3){
                                        $fk = 1;
                                    }
                                    $query = sprintf("SELECT * FROM size s WHERE forKids=%d",$fk);
                                    $result = mysql_query($query,$connect);

                                    while($r = mysql_fetch_array($result)){
                                        echo "<option value='".$r['sizeID']."'>".$r['size']."</option>";
                                    }
                                echo"</select>
                                    
                                </div>";

                            echo"<div class='oprquantity'>
                                    <button type='button' class='btnquantity' onclick='btnminus();'>
                                        <span class='minusspan'></span>
                                    </button>
                                    <input type='text' name='oneproductquantity' id='oneproductquantity' value='1' readonly='readonly'/>
                                    <button type='button' class='btnquantityplus' onclick='btnplus();'>
                                        <span class='plusspanf'></span>
                                        <span class='plusspanl'></span>
                                    </button>
                                </div>
                                <script>
                                    function btnminus(){
                                        var qv = document.getElementById('oneproductquantity');
                                        if(qv.value > 1)
                                            qv.value = parseInt(qv.value) - 1;
                                    }
                                    function btnplus(){
                                        var qv = document.getElementById('oneproductquantity');
                                        if(qv.value < 10)
                                            qv.value = parseInt(qv.value) + 1;
                                                        
                                    }
                                    
                                </script>

                                <input type='submit' name='addoneproducttobag' id='addoneproducttobag' onclick='x=this.id;' value='ADD TO BAG'/>
                            </form>
                            <div class='oprcolor'>
                                <div class='oprcolortop color_".$row['color']."'></div>
                                <div class='oprcolorbottom'>".ucfirst($row['color'])."</div>
                            </div>
                            <div class='oprdescription'><h3>Description</h3>".$row['description']."</div>




                            <!-- mogu dodati jos 4 random itema -->

                        </div>
                        <div class='clear'></div>";

            }
        }
    }
?>

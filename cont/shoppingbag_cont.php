<?php
    include("dbconnection.php");

    if(isset($_SESSION['role'])){
        if(isset($_REQUEST['checkout']) && $_SESSION['numBagItems']>0){
            if($_REQUEST['checkout'] == $_SESSION['userID']){
                $currentTime = mktime();
                $query = sprintf("INSERT INTO orderhistory 
                                SELECT '', s.userID, s.productID, s.sizeID, s.quantity, %d FROM shoppingbaglist s WHERE s.userID=%d",$currentTime,$_SESSION['userID']);
                $result = mysql_query($query, $connect);
                

                if($result){
                    $query = sprintf("DELETE FROM shoppingbaglist WHERE userID=%d",$_SESSION['userID']);
                    $result = mysql_query($query, $connect);
                    if($result){
                        echo "Thanks for purchesing in My socks.";
                        
                        $_SESSION['numBagItems'] = 0;
                    }
                }
            }
        }else{echo "nemas nist";}

        if(isset($_REQUEST['pid']) && isset($_REQUEST['pm'])){
            if(preg_match("/^\d+$/",$_REQUEST['pid']) && preg_match("/^\d+$/",$_REQUEST['pm'])){
                $query = "";
                if($_REQUEST['pm'] > 0){
                    $query = sprintf("UPDATE shoppingbaglist SET quantity = quantity + 1 WHERE quantity < 10 AND shoppingBagListID=%d AND userID=%d",$_REQUEST['pid'],$_SESSION['userID']);
                }
                else{
                    $query = sprintf("UPDATE shoppingbaglist SET quantity = quantity - 1 WHERE quantity > 1 AND shoppingBagListID=%d AND userID=%d",$_REQUEST['pid'],$_SESSION['userID']);
                }
                $result = mysql_query($query, $connect);
                if($result){
                    #usepo
                    echo "s0";
                }
                else{
                    #nije uspelo 
                    echo "bad";
                }
            }
        }

        if(isset($_REQUEST['remove'])){
            if(preg_match("/^\d+$/",$_REQUEST['remove'])){
                #obrisi taj item
                $query = sprintf("DELETE FROM shoppingbaglist WHERE shoppingBagListID=%d AND userID=%d",$_REQUEST['remove'],$_SESSION['userID']);
                $result = mysql_query($query, $connect);
                if($result){
                    #usepo
                    if($_SESSION['numBagItems']>0){
                        $_SESSION['numBagItems']--;
                        header('Location: index.php?page=13');
                    }
                }
                else{
                    #nije uspelo brisanje 
                }
            }
        }
    }
?>


<div class="myshoppingbag">My bag (<?php echo isset($_SESSION['numBagItems'])? $_SESSION['numBagItems'] : 0; ?>)</div>

<div class="shoppingbagcont">

    <div class="sbmenunames">
        <div class="sbagname">PRODUCT</div>
        <div class="sbagname sbagnameq">QUANTITY</div>
        <div class="sbagname sbagnamet">TOTAL</div>
    </div>

    <?php
    $userproducts['totalprice'] = 0;
    if(isset($_SESSION['role'])){
        if($_SESSION['numBagItems']==0){
            echo "<div class='shoppingbagempty'>Your bag is empty.</div>";
        }
        else{
            if($_SESSION['numBagItems'] > 0){
                
                $query = sprintf("SELECT s.shoppingBagListID,s.quantity,p.imgLink,p.imgAlt,p.productName,p.productID,p.price,p.saleProcent,si.size FROM shoppingbaglist s JOIN product p ON s.productID=p.productID JOIN size si ON si.sizeID=s.sizeID WHERE userID=%d",$_SESSION['userID']);
                $result = mysql_query($query, $connect);
                mysql_close($connect);
                while($row = mysql_fetch_array($result)){
                    $rowprice = (($row['price'] - ($row['saleProcent']/100)*$row['price'])/100)*$row['quantity'];
                    echo "<div class='sbagoneitem'>

                            <div class='sbagproduct sbagblock'>
                                <img src='".$row['imgLink']."' alt='".$row['imgAlt']."' height='230' width='230' />
                            </div>

                            <div class='sbagitem sbagblock'>
                                <div class='sbagproductname'>".$row['productName']."</div>
                                <div class='sbagproductsku'>#".$row['productID']."</div>
                                <div class='sbagproductprice'>Price: $".(($row['price'] - ($row['saleProcent']/100)*$row['price'])/100)."</div>
                                <div class='sbagproductprice'>Size: ".$row['size']."</div>
                                <a href='index.php?page=13&remove=".$row['shoppingBagListID']."' class='sbagproductremove'>Remove item</a>
                            </div>

                            <div class='sbagquantity sbagblock'>

                                <div class='oprquantity'>
                                    <button class='btnquantity' onclick='btnminus(".$row['shoppingBagListID'].");'>
                                        <span class='minusspan'></span>
                                    </button>
                                    <input type='text' name='oneproductquantity' class='oneproductquantity' id='oneproductquantity".$row['shoppingBagListID']."' value='".$row['quantity']."' readonly='readonly'/>
                                    <button class='btnquantityplus' onclick='btnplus(".$row['shoppingBagListID'].");'>
                                        <span class='plusspanf'></span>
                                        <span class='plusspanl'></span>
                                    </button>
                                </div>
                            </div>
                            <div class='sbagtotal sbagblock'>
                                <div class='sbagtotalquantityprice'>$".$rowprice."</div>
                            </div>
                        </div>";
                        $userproducts['totalprice'] += $rowprice;
                }
            }
        }
    }else{ echo "<div class='shoppingbagempty'>Your bag is empty.</div>";}
    ?>
<script>
    function btnminus(x){
        var qv = document.getElementById('oneproductquantity'+x);
        /*var qv = document.getElementById('oneproductquantity'+x);
        if(qv.value > 1)
            qv.value = parseInt(qv.value) - 1;*/
            window.location.href = "index.php?page=13&pid="+x+"&pm=0";
    }
    function btnplus(x){
        var qv = document.getElementById('oneproductquantity'+x);
       /* var qv = document.getElementById('oneproductquantity'+x);
        if(qv.value < 10)
            qv.value = parseInt(qv.value) + 1;    */
            window.location.href = "index.php?page=13&pid="+x+"&pm=1";                 
    }
</script>
</div>
<div class="clear"></div>
<div class="shoppingbagtotalsum">Total: $<?php echo $userproducts['totalprice'];?></div>
<div><a href='index.php?page=13&checkout=<?php echo $_SESSION['userID'];?>' class="shoppingbagcheckout">CHECKOUT</a></div>
<div class="clear"></div>

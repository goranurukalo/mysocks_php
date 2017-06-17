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

                if(isset($_POST['productsubmit'])){
                    $error = 0;

                    if(($_FILES['productimage']['error']==0) && $_FILES['productimage']['size']>0){
				        if($_FILES['productimage']['size']<2097152){
					        if(($_FILES["productimage"]["type"] == "image/jpeg") || ($_FILES["productimage"]["type"] == "image/jpg") || ($_FILES["productimage"]["type"] == "image/png")){
                            

                                function TextProductRegex($value){
                                    $reg['productname'] = "/^[A-z0-9\s]{3,127}$/";
                                    $reg['productprice'] = "/^[0-9]{1,4}(\.?[0-9]{2})?$/";
                                    $reg['productdescription'] = "/^[a-zA-Z0-9\!\$\%\&\.\,\s]{3,254}$/";
                                    $reg['productquantity'] = "/^[0-9]{1,10}$/";
                                    $reg['productimagealt'] = "/^[A-z0-9\s]{3,127}$/";
                                    $e = 0;

                                    if(isset($_POST[$value])){
                                        if(!preg_match($reg[$value],$_POST[$value])){
                                            $e++;
                                            echo $value;
                                        }
                                    }
                                    else{
                                        $e++;
                                    }
                                    return $e;
                                }
                                function ListProductRegex($value){
                                    $e = 0;
                                    if(isset($_POST[$value])){
                                        if($_POST[$value]==0){                                            
                                            $e++; 
                                        }
                                    }
                                    else{
                                        $e++;
                                    }
                                    
                                    return $e;
                                    
                                }

                                $error += TextProductRegex('productname');
                                $error += TextProductRegex('productprice');
                                $error += TextProductRegex('productdescription');
                                $error += TextProductRegex('productquantity');
                                $error += TextProductRegex('productimagealt');

                                $error += ListProductRegex('productcolor');
                                $error += ListProductRegex('productmaterial');
                                $error += ListProductRegex('productpattern');
                                $error += ListProductRegex('productgender');

                                if($error == 0){
                                    
                                    $timeadded = mktime();
                                   
                                    $productimagepath = "images/socks/".mktime().basename($_FILES["productimage"]["name"]);
                                    if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $productimagepath)) {
                                        
                                        include("dbconnection.php");



                                        $query = sprintf("INSERT INTO product VALUES(
                                        '','%s','%d','%d','%s','%s','%s','%d','%d','%d','%d','%d','%d','%d','%d','%d')"
                                        ,
                                        $_POST['productname'],($_POST['productprice']*100),
                                        $_POST['productcolor'],$productimagepath,
                                        $_POST['productimagealt'],$_POST['productdescription'],
                                        $_POST['productmaterial'],
                                        $_POST['productpattern'],$_SESSION['userID'],
                                        $timeadded,$timeadded,
                                        $_POST['productgender'],1,
                                        0,$_POST['productquantity']
                                        );

                                        $result = mysql_query($query, $connect);
                                        mysql_close($connect);

                                        if(!$result){
                                            #unisiti sliku
                                            @unlink($productimagepath);
                                        }
                                        else{
                                            echo "upload uspesan"; 
                                        }

                                    } else {
                                        echo "Sorry, there was an error uploading your file.";
                                    }
                                }
                                else{
                                    echo "error";
                                }

                                #pitaj za liste , pitaj za sliku da li je dobra 

                                #ako svi prodju onda update
                            }else{echo"los tip slike";}
                        }else{echo"slika je prevelika";}
                    }else{echo"nema slike";}
                }

                echo"<div class='bigText'>PRODUCT > ADD</div>";
?>
            <div class='productaddform forminside'>
                <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST' id='productaddform' enctype='multipart/form-data' onsubmit='return addproduct();'>
                    <input type='hidden' name='page' value='9'/>
                    <input type='hidden' name='job' value='1'/>

                    <input type='text' name='productname' id='productname' placeholder='PRODUCT NAME' value='<?php echo @$_POST['productname'];?>'>
                    <input type='text' name='productprice' id='productprice' placeholder='PRODUCT PRICE' value='<?php echo @$_POST['productprice'];?>'>

                    <textarea cols='28' rows='8' name='productdescription' id='productdescription' placeholder='DESCRIPTION'><?php echo @$_POST['productdescription'];?></textarea>
                    
                    <?php
                        $selectdata = array();
                        include("dbconnection.php");
                        
                        $query = sprintf("SELECT * FROM color");
                        $selectdata['color'] = mysql_query($query, $connect);

                        $query = sprintf("SELECT * FROM material");
                        $selectdata['material'] = mysql_query($query, $connect);

                        $query = sprintf("SELECT * FROM pattern");
                        $selectdata['pattern'] = mysql_query($query, $connect);

                        mysql_close($connect);

                    ?>

                    <select name='productcolor' id='productcolor'>
                        <option value='0'>CHOOSE COLOR</option>
                    <?php
                        
                        while($row = mysql_fetch_array($selectdata['color'])){
                            if($row['colorID'] == @$_POST['productcolor']){
                                echo "<option value='".$row['colorID']."' selected>".$row['color']."</option>";
                            }
                            else{
                                echo "<option value='".$row['colorID']."'>".$row['color']."</option>";
                            }
                        }                  
                    ?>
                    </select>


                  
                    <select name='productmaterial' id='productmaterial'>
                        <option value='0'>CHOOSE MATERIAL</option>
                    <?php
                        while($row = mysql_fetch_array($selectdata['material'])){

                            if($row['materialID'] == @$_POST['productmaterial']){
                                echo "<option value='".$row['materialID']."' selected>".$row['material']."</option>";
                            }
                            else{
                                echo "<option value='".$row['materialID']."'>".$row['material']."</option>";
                            }
                        }
                    ?>
                    </select>


                    <select name='productpattern' id='productpattern'>
                        <option value='0'>CHOOSE PATTERN</option>
                    <?php
                        while($row = mysql_fetch_array($selectdata['pattern'])){

                            if($row['patternID'] == @$_POST['productpattern']){
                                echo "<option value='".$row['patternID']."' selected>".$row['pattern']."</option>";
                            }
                            else{
                                echo "<option value='".$row['patternID']."'>".$row['pattern']."</option>";
                            }
                        }
                    ?>
                    </select>

                    <input type='hidden' name='useraddID' value='<?php echo $_SESSION['userID'];?>'/>

                    <select name='productgender' id='productgender'>
                        <option value='0' <?php echo (0 == @$_POST['productgender']) ?  'selected' : '' ; ?>>CHOOSE GENDER</option>
                        <option value='1'<?php echo (1 == @$_POST['productgender']) ?  'selected' : '' ; ?>>CHOOSE MEN</option>
                        <option value='2'<?php echo (2 == @$_POST['productgender']) ?  'selected' : '' ; ?>>CHOOSE WOMEN</option>
                        <option value='3'<?php echo (3 == @$_POST['productgender']) ?  'selected' : '' ; ?>>CHOOSE KID</option>
                    </select>

                    <input type='hidden' name='categoryID' value='1'/>

                    <input type='text' name='productquantity' id='productquantity' placeholder='PRODUCT QUANTITY' value='<?php echo @$_POST['productquantity'];?>'>

                    <input type='file' name='productimage' id='productimage' accept='image/*' data-maxfilesize='2000000'>
                    <input type='text' name='productimagealt' id='productimagealt' placeholder='PRODUCT ALT' value='<?php echo @$_POST['productimagealt'];?>'>

                    <input type='submit' name='productsubmit' id='productsubmit'  value='ADD PRODUCT'>
                    
                </form>
            <script>
                document.getElementById('productimage').onchange = function () {
                    document.styleSheets[0].addRule(".forminside input[type='file']:after", 'content: "' +this.value.replace(/.*[\/\\]/, '') + '";');
                };
            </script>
        </div>
            
<?php
            }
            else{
                if(!isset($_REQUEST['productID'])){
                    include('funct/itemfunct.php');
                    fillitems(array('page'=>$page,'job'=>$job));
                }
                else{
                    if($job == 2){

                        if(isset($_POST['productsubmit'])){
                    $error = 0;

                                function TextProductRegex($value){
                                    $reg['productname'] = "/^[A-z0-9\s]{3,127}$/";
                                    $reg['productprice'] = "/^[0-9]{1,4}(\.?[0-9]{1,2})?$/";
                                    $reg['productdescription'] = "/^[a-zA-Z0-9\!\$\%\&\.\,\s]{3,254}$/";
                                    $reg['productquantity'] = "/^[0-9]{1,10}$/";
                                    $reg['productimagealt'] = "/^[A-z0-9\s]{3,127}$/";
                                    $reg['productsaleprocent'] = "/^[1-9]{0,1}[0-9]{1,2}$|^100$/";
                                    $e = 0;

                                    if(isset($_POST[$value])){
                                        if(!preg_match($reg[$value],$_POST[$value])){
                                            $e++;
                                            echo $value;
                                        }
                                    }
                                    else{
                                        $e++;
                                    }
                                    return $e;
                                }
                                function ListProductRegex($value){
                                    $e = 0;
                                    if(isset($_POST[$value])){
                                        if($_POST[$value]==0){                                            
                                            $e++; 
                                        }
                                    }
                                    else{
                                        $e++;
                                    }
                                    
                                    return $e;
                                    
                                }

                                $error += TextProductRegex('productname');
                                $error += TextProductRegex('productprice');
                                $error += TextProductRegex('productdescription');
                                $error += TextProductRegex('productquantity');
                                $error += TextProductRegex('productimagealt');
                                $error += TextProductRegex('productsaleprocent');

                                $error += ListProductRegex('productcolor');
                                $error += ListProductRegex('productmaterial');
                                $error += ListProductRegex('productpattern');
                                $error += ListProductRegex('productgender');
                                $error += ListProductRegex('productcategory');
                                


                                if(($_FILES['productimage']['error']==0) && $_FILES['productimage']['size']>0){
				                    if($_FILES['productimage']['size']<2097152){
					                    if(($_FILES["productimage"]["type"] == "image/jpeg") || ($_FILES["productimage"]["type"] == "image/jpg") || ($_FILES["productimage"]["type"] == "image/png")){
                                            echo "fajl je ok";

                                            if($error == 0){
                                                
                                                $timeadded = mktime();
                                            
                                                $productimagepath = "images/socks/".mktime().basename($_FILES["productimage"]["name"]);
                                                if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $productimagepath)) {
                                                    
                                                    include("dbconnection.php");

                                                    $timeadded = mktime();
                                                    $query = sprintf("UPDATE product SET 
                                                    productName='%s',
                                                    price=%d,
                                                    colorID=%d,
                                                    imgLink='%s',
                                                    imgAlt='%s',
                                                    description='%s',
                                                    materialID=%d,
                                                    patternID=%d,
                                                    userAddID=%d,
                                                    timeLastChange=%d,
                                                    forMWK=%d,
                                                    categoryID=%d,
                                                    saleProcent=%d,
                                                    quantity=%d

                                                    WHERE productID=%d",
                                                    
                                                    $_POST['productname'],($_POST['productprice']*100),
                                                    $_POST['productcolor'],$productimagepath,
                                                    $_POST['productimagealt'],$_POST['productdescription'],
                                                    $_POST['productmaterial'],
                                                    $_POST['productpattern'],$_SESSION['userID'],
                                                    $timeadded,
                                                    $_POST['productgender'],$_POST['productcategory'],
                                                    $_POST['productsaleprocent'],$_POST['productquantity'],
                                                    
                                                    $_POST['productID']
                                                    );

                                                    $result = mysql_query($query, $connect);
                                                    mysql_close($connect);

                                                    if(!$result){
                                                        #unisiti sliku
                                                        @unlink($productimagepath);
                                                    }
                                                    else{
                                                        echo "upload uspesan";
                                                        if(isset($_POST['imgLink'])){
                                                            @unlink($_POST['imgLink']);
                                                        }
                                                    }

                                                } else {
                                                    echo "Sorry, there was an error uploading your file.";
                                                }
                                            }
                                            else{
                                                echo "error";
                                            }

                                        }else{$error++;}
                                    }else{$error++;}
                                }else{
                                    #namesti da se imglink ne menja
                                    
                                    if($error==0){
                                       
                                                    include("dbconnection.php");

                                                    $timeadded = mktime();
                                                
                                                    $query = sprintf("UPDATE product SET 
                                                    productName='%s',
                                                    price=%d,
                                                    colorID=%d,
                                                    imgAlt='%s',
                                                    description='%s',
                                                    materialID=%d,
                                                    patternID=%d,
                                                    userAddID=%d,
                                                    timeLastChange=%d,
                                                    forMWK=%d,
                                                    categoryID=%d,
                                                    saleProcent=%d,
                                                    quantity=%d

                                                    WHERE productID=%d",
                                                    
                                                    $_POST['productname'],($_POST['productprice']*100),
                                                    $_POST['productcolor'],
                                                    $_POST['productimagealt'],$_POST['productdescription'],
                                                    $_POST['productmaterial'],
                                                    $_POST['productpattern'],$_SESSION['userID'],
                                                    $timeadded,
                                                    $_POST['productgender'],$_POST['productcategory'],
                                                    $_POST['productsaleprocent'],$_POST['productquantity'],
                                                    
                                                    $_POST['productID']
                                                    );

                                                    $result = mysql_query($query, $connect);
                                                    mysql_close($connect);

                                                    if($result){
                                                        echo "upload uspesan";        
                                                    }else{
                                                        echo"error"; 
                                                    }
                                    }
                                }
                            
                }
            
            include("dbconnection.php");
            $query = sprintf("SELECT * FROM product WHERE productID='%s'",$_REQUEST['productID']);
            $result = mysql_query($query, $connect);
            
            $row = mysql_fetch_array($result);


?>
            <div class='productaddform forminside'>
                <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST' id='productaddform' enctype='multipart/form-data' onsubmit='return true;'>
                    <input type='hidden' name='page' value='9'/>
                    <input type='hidden' name='job' value='2'/>
                    <input type='hidden' name='productID' value='<?php echo @$_REQUEST['productID'];?>'/>

                    <input type='text' name='productname' id='productname' placeholder='PRODUCT NAME' value='<?php echo $row['productName'];?>'>
                    <input type='text' name='productprice' id='productprice' placeholder='PRODUCT PRICE' value='<?php echo ($row['price']/100);?>'>

                    <textarea cols='28' rows='8' name='productdescription' id='productdescription' placeholder='DESCRIPTION'><?php echo $row['description'];?></textarea>
                    
                    <?php
                        $selectdata = array();
                        include("dbconnection.php");
                        
                        $query = sprintf("SELECT * FROM color");
                        $selectdata['color'] = mysql_query($query, $connect);

                        $query = sprintf("SELECT * FROM material");
                        $selectdata['material'] = mysql_query($query, $connect);

                        $query = sprintf("SELECT * FROM pattern");
                        $selectdata['pattern'] = mysql_query($query, $connect);
                        
                        $query = sprintf("SELECT * FROM category");
                        $selectdata['category'] = mysql_query($query, $connect);

                        mysql_close($connect);

                    ?>

                    <select name='productcolor' id='productcolor'>
                        <option value='0'>CHOOSE COLOR</option>
                    <?php
                        
                        while($r = mysql_fetch_array($selectdata['color'])){
                            if($r['colorID'] == $row['colorID']){
                                echo "<option value='".$r['colorID']."' selected>".$r['color']."</option>";
                            }
                            else{
                                echo "<option value='".$r['colorID']."'>".$r['color']."</option>";
                            }
                        }                  
                    ?>
                    </select>


                  
                    <select name='productmaterial' id='productmaterial'>
                        <option value='0'>CHOOSE MATERIAL</option>
                    <?php
                        while($r = mysql_fetch_array($selectdata['material'])){

                            if($r['materialID'] == $row['materialID']){
                                echo "<option value='".$r['materialID']."' selected>".$r['material']."</option>";
                            }
                            else{
                                echo "<option value='".$r['materialID']."'>".$r['material']."</option>";
                            }
                        }
                    ?>
                    </select>


                    <select name='productpattern' id='productpattern'>
                        <option value='0'>CHOOSE PATTERN</option>
                    <?php
                        while($r = mysql_fetch_array($selectdata['pattern'])){

                            if($r['patternID'] == $row['patternID']){
                                echo "<option value='".$r['patternID']."' selected>".$r['pattern']."</option>";
                            }
                            else{
                                echo "<option value='".$r['patternID']."'>".$r['pattern']."</option>";
                            }
                        }
                    ?>
                    </select>

                    <select name='productcategory' id='productcategory'>
                        <option value='0'>CHOOSE CATEGORY</option>
                    <?php
                        while($r = mysql_fetch_array($selectdata['category'])){

                            if($r['categoryID'] == $row['categoryID']){
                                echo "<option value='".$r['categoryID']."' selected>".$r['category']."</option>";
                            }
                            else{
                                echo "<option value='".$r['categoryID']."'>".$r['category']."</option>";
                            }
                        }
                    ?>
                    </select>

                    <input type='hidden' name='useraddID' value='<?php echo $_SESSION['userID'];?>'/>

                    <select name='productgender' id='productgender'>
                        <option value='0' <?php echo (0 == $row['forMWK']) ?  'selected' : '' ; ?>>CHOOSE GENDER</option>
                        <option value='1'<?php echo (1 == $row['forMWK']) ?  'selected' : '' ; ?>>CHOOSE MEN</option>
                        <option value='2'<?php echo (2 == $row['forMWK']) ?  'selected' : '' ; ?>>CHOOSE WOMEN</option>
                        <option value='3'<?php echo (3 == $row['forMWK']) ?  'selected' : '' ; ?>>CHOOSE KID</option>
                    </select>

                    <input type='hidden' name='categoryID' value='1'/>
                    <input type='hidden' name='imgLink' value='<?php echo $row['imgLink'];?>'/>

                    <input type='text' name='productquantity' id='productquantity' placeholder='PRODUCT QUANTITY' value='<?php echo $row['quantity'];?>'>

                    <input type='file' name='productimage' id='productimage' accept='image/*' data-maxfilesize='2000000'>
                    <input type='text' name='productimagealt' id='productimagealt' placeholder='PRODUCT ALT' value='<?php echo $row['imgAlt'];?>'>
                    <input type='text' name='productsaleprocent' id='productsaleprocent' placeholder='PRODUCT SALE PROCENT' value='<?php echo $row['saleProcent'];?>'>

                    <input type='submit' name='productsubmit' id='productsubmit'  value='MANAGE PRODUCT'>
                    
                </form>
            <script>
                document.getElementById('productimage').onchange = function () {
                    document.styleSheets[0].addRule(".forminside input[type='file']:after", 'content: "' +this.value.replace(/.*[\/\\]/, '') + '";');
                };
            </script>
        </div>
            
<?php


                    }
                    else if($job == 3){
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                            include("dbconnection.php");
                            $query = sprintf("DELETE FROM product WHERE productID=%d",$_REQUEST['productID']);
                            $result = mysql_query($query, $connect);
                            mysql_close($connect);
                        
                        if($result){
                            $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
                            header('location: n1shhh.php?page=9&job=3&offset='.$offset);
                        }
                            }
                            }
                    }
                    else if($job == 4){
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
                                <div class='vpbname'>Price: </div>
                                <div class='vpbtext'>$".($row['price']/100)."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Color: </div>
                                <div class='vpbtext'>".$row['color']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Material: </div>
                                <div class='vpbtext'>".$row['material']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Pattern: </div>
                                <div class='vpbtext'>".$row['pattern']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Category: </div>
                                <div class='vpbtext'>".$row['category']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Description: </div>
                                <div class='vpbtext'>".$row['description']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>User added: </div>
                                <div class='vpbtext'>".$row['firstName']." ".$row['lastName']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Add Time: </div>
                                <div class='vpbtext'>".@date('d/m/Y H:i:s',$row['timeProductAdd'])."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Last c. t.: </div>
                                <div class='vpbtext'>".@date('d/m/Y H:i:s',$row['timeLastChange'])."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Gender</div>
                                <div class='vpbtext'>".$row['forMWK']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Sale procent: </div>
                                <div class='vpbtext'>".$row['saleProcent']."</div>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Quantity: </div>
                                <div class='vpbtext'>".$row['quantity']."</div>
                            </div>
                            <div class='vpblock'>
                                <img width='230' height='230' class='vpbimg' src='".$row['imgLink']."' alt=''></img>
                            </div>
                            <div class='vpblock'>
                                <div class='vpbname'>Img alt: </div>
                                <div class='vpbtext'>".$row['imgAlt']."</div>
                            </div> 
                            <a class='myprofilemanage' href='n1shhh.php?page=9&job=2&productID=".$row['productID']."&offset=0'>MANAGE</a>
                        </div>";
                        
                        }

                        else{
                            echo "<div class='error'>Sorry but that product do not exist</div>";
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
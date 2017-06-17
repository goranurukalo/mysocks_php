<?php
if($_SESSION['role']==1){
    function fillitems($values=array()){

        if(isset($values['page'])&&isset($values['job'])){
            $bigTextLeft = array(
                '8' => "USER",
                '9' => "PRODUCT",
                '10' => "SALE",
                '11' => "FAQ",
                '12' => "POLL"
            );
            $bigTextRight = array(
                '1' => "ADD",
                '2' => "MANAGE",
                '3' => "REMOVE",
                '4' => "VIEW"
            );
            $data['bigTextleft'] = $bigTextLeft[$values['page']];
            $data['bigTextRight'] = $bigTextRight[$values['job']];

            $data['offset'] = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
            if(!preg_match("/^\d+$/",$data['offset'])){
                $data['offset'] = 0;
            }
            
            echo"<div class='bigText'>".$data['bigTextleft']." > ".$data['bigTextRight']."</div>";
            
            include("dbconnection.php");
            $query = array(
                '8' => "SELECT * FROM users LIMIT 5 OFFSET ".$data['offset'],
                '9' => "SELECT * FROM product LIMIT 5 OFFSET ".$data['offset'],
                '10' => "SELECT * FROM product WHERE categoryID=3 LIMIT 5 OFFSET ".$data['offset'],
                '11' => "SELECT * FROM faq LIMIT 5 OFFSET  ".$data['offset'],
                '12' => "SELECT * FROM pollquestion LIMIT 5 OFFSET  ".$data['offset'],
                '13' => "SELECT * FROM product WHERE categoryID <> 3 LIMIT 5 OFFSET ".$data['offset']
            );
            $paginationquery = array(
                '8' => "SELECT COUNT(*) as c FROM users",
                '9' => "SELECT COUNT(*) as c FROM product",
                '10' => "SELECT COUNT(*) as c FROM product WHERE categoryID=3",
                '11' => "SELECT COUNT(*) as c FROM faq",
                '12' => "SELECT COUNT(*) as c FROM pollquestion",
                '13' => "SELECT COUNT(*) as c FROM product WHERE categoryID <> 3"
            );

            $result;
            $paginationresult;

            if($values['job']=='1' && $values['page']=='10'){
                $result = mysql_query($query['13'], $connect);
                $paginationresult = mysql_query($paginationquery['13'], $connect);
            }
            else{
                $result = mysql_query($query[$values['page']], $connect);
                $paginationresult = mysql_query($paginationquery[$values['page']], $connect);
            }
            mysql_close($connect);

            while($row = mysql_fetch_array($result)){
            
                echo 
                    "<div class='itemblock'>";
                    
                if($values['page']==8){
                    $imgurl;                
                    if($row['statusID']==1){
                        $imgurl = 'images/gogiimg/user.png';
                    }
                    else if($row['statusID']==2){
                        $imgurl = 'images/gogiimg/banned.png';
                    }
                    else if($row['statusID']==3){
                        $imgurl = 'images/gogiimg/waiting.png';
                    }
                    else if($row['statusID']==4){
                        $imgurl = 'images/gogiimg/deleted.png';
                    }              
                    if($row['roleID'] == 1){
                        $imgurl = 'images/gogiimg/administrator.png';
                    }
                    echo
                    "<img src='".$imgurl."' alt='user image' class='itemimage'>";


                    echo 
                    "<div class='itemtext'>
                        <div class='itemfirstlastname'>".$row['firstName']." ".$row['lastName']."</div>
                        <div class='itememail'>".$row['email']."</div>
                    </div>";

                    echo 
                    "<a href='n1shhh.php?page=".$values['page']."&job=".$values['job']."&productID=".$row['userID']."&offset=".$data['offset']."' class='itemcommand small".$data['bigTextRight']."'></a>
                    </div>";
                }
                else if($values['page']==9){
                    echo 
                    "<img height='128' width='128' src='".$row['imgLink']."' alt='".$row['imgAlt']."' class='itemimage'>";
                    echo 
                    "<div class='itemtext'>
                        <div class='itemproductname'>".$row['productName']."</div>
                        <div class='itemproductid'>#".$row['productID']."</div>
                        <div class='itemproductprice'>$".($row['price']/100)."</div>
                    </div>";
                    echo 
                    "<a href='n1shhh.php?page=".$values['page']."&job=".$values['job']."&productID=".$row['productID']."&offset=".$data['offset']."' class='itemcommand small".$data['bigTextRight']."'></a>
                    </div>";
                }
                else if($values['page']==10){
                    echo 
                    "<img height='128' width='128' src='".$row['imgLink']."' alt='".$row['imgAlt']."' class='itemimage'>";
                    echo 
                    "<div class='itemtext'>
                        <div class='itemproductname'>".$row['productName']."</div>
                        <div class='itemproductid'>#".$row['productID']."</div>
                        <div class='itemproductprice'>$".($row['price']/100)."</div>
                        <div class='itemproductsale'>".$row['saleProcent']."%</div>
                    </div>";
                    echo 
                    "<a href='n1shhh.php?page=".$values['page']."&job=".$values['job']."&productID=".$row['productID']."&offset=".$data['offset']."' class='itemcommand small".$data['bigTextRight']."'></a>
                    </div>";
                }
                else if($values['page']==11){
                    echo 
                    "<img src='images/gogiimg/faq.png' alt='faq image' class='itemimage'>";
                    echo 
                    "<div class='itemtext'>".$row['faqQuestion']."</div>";
                    echo 
                    "<a href='n1shhh.php?page=".$values['page']."&job=".$values['job']."&productID=".$row['faqID']."&offset=".$data['offset']."' class='itemcommand small".$data['bigTextRight']."'></a>
                    </div>";
                }
                else if($values['page']==12){
                    echo 
                    "<img src='images/gogiimg/poll.png' alt='poll image' class='itemimage'>";
                    echo 
                    "<div class='itemtext'>".$row['pollQuestion']."</div>";
                    echo 
                    "<a href='n1shhh.php?page=".$values['page']."&job=".$values['job']."&productID=".$row['pollQuestionID']."&offset=".$data['offset']."' class='itemcommand small".$data['bigTextRight']."'></a>
                    </div>";
                }
            }
            //
            //
            //ovo plus gore upit je paginacija
            //
            //
            $data['dbcountitems'] = mysql_fetch_array($paginationresult)['c'];
            $data['paginationpages'] = floor($data['dbcountitems']/5) + 1 ;
            $data['thispage'] = ($data['offset'] / 5) + 1;


            $data['prevpageid'] = $data['offset'] - 5;
            $data['nextpageid'] = $data['offset'] + 5; 

            echo"<div class='paginationbtns'>";
            if($data['thispage']>1){
                echo "<a href='n1shhh.php?page=".$values['page']."&job=".$values['job']."&offset=".$data['prevpageid']."' class='pbtnprev pbtnall'>PREV</a>";
            }
            else{
                echo"<div class='pbtnprev pbtnall'>PREV</div>";
            }
            echo "<div class='pbtnnumber pbtnall'>".$data['thispage']."</div>";

            if(($data['offset']+5) >= $data['dbcountitems']){
                echo "<div class='pbtnnext pbtnall'>NEXT</div>";
            }
            else{
                echo"<a href='n1shhh.php?page=".$values['page']."&job=".$values['job']."&offset=".$data['nextpageid']."' class='pbtnnext pbtnall'>NEXT</a>";
            }

            echo "</div>";

            echo"<div class='clear'></div>";
        }
    }
}
?>
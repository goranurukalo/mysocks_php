<div class="productfilters">

<div class="productfiltername">FILTERS</div>

    <form action='<?php echo $_SERVER['PHP_SELF']?>' method='POST' id='productfilterform'>
    <input type="hidden" name='page' id='page' value='11'>
    <input type="hidden" name='lpos' id='lpos' value='<?php echo isset($_REQUEST['lpos'])? $_REQUEST['lpos'] : 0;?>'>

    <div class="pfilterblock">
        <div class="pfiltername" onclick='myshowhide(this);'>v Color</div>
        <div class="pfilterbody pfilterbodyonlycolor">
        
        <?php
            include("dbconnection.php");
            $query = sprintf("SELECT * FROM color");
            $result = mysql_query($query, $connect);
            
            while($row = mysql_fetch_array($result)){
                echo "<div class='pfcolorblock'>
                        <input type='radio' name='filtercolors' id='fc_".$row['color']."' value='".$row['colorID']."'";
                        if(isset($_REQUEST['filtercolors'])){
                            if($_REQUEST['filtercolors'] == $row['colorID']){
                                echo ' checked';
                            }
                        }
                        else if($row['color']==='rainbow'){
                            echo ' checked';
                        }
                         echo "/>
                        <label for='fc_".$row['color']."' class='pfcolor color_".$row['color']."'></label>
                        <div class='pfcolorname'>".ucfirst($row['color'])."</div>
                    </div>";
            }			
        ?>

        </div>
    </div>

    <div class="pfilterblock">
        <div class="pfiltername" onclick='myshowhide(this);'>v Size</div>
        <div class="pfilterbody">
            <div class="pfsizeblock radiobuttonparent rbpfilters">
                <ul>

                    <?php
                        //include("dbconnection.php");
                        $query = sprintf("SELECT * FROM size");
                        if(isset($_REQUEST['forKid'])){
                            $regFK = "/^[0-1]$/";
                            if(preg_match($regFK,$_REQUEST['forKid'])){
                                 
                                $query .= " WHERE forKids=".$_REQUEST['forKid'];
                            }
                        }
                        $result = mysql_query($query, $connect);

                        $sizeChecked = 0;                        
                        while($row = mysql_fetch_array($result)){
                            echo "<li>
                                    <input type='radio' name='pfsize' id='pfsize".$row['sizeID']."' value='".$row['sizeID']."'";
                                    if(isset($_REQUEST['pfsize'])){
                                        if($_REQUEST['pfsize'] == $row['sizeID']){
                                            echo ' checked';
                                            $sizeChecked = 1;
                                        }
                                    }
                                    echo "/>
                                    <label for='pfsize".$row['sizeID']."' class='radiobuttonlable'>".$row['size']."</label>
                                    <div class='check'></div>
                                </li>";
                        }
                        
                    ?>
                    <li>
                        <input type="radio" name="pfsize" id='pfsize_all' value="0" <?php echo ($sizeChecked==0)?'checked' : '';?>/>
                        <label for="pfsize_all" class='radiobuttonlable'>All</label>
                        <div class="check"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="pfilterblock">
        <div class="pfiltername" onclick='myshowhide(this);'>v Material</div>
        <div class="pfilterbody">
            



            <div class="pfmaterialblock radiobuttonparent rbpfilters">
                <ul>
                    <?php
                        //include("dbconnection.php");
                        $query = sprintf("SELECT * FROM material");
                        $result = mysql_query($query, $connect);
                        
                        $materialChecked = 0;

                        while($row = mysql_fetch_array($result)){
                            echo "<li>
                                    <input type='radio' name='pfmaterial' id='pfmaterial_".$row['materialID']."' value='".$row['materialID']."'";
                                    if(isset($_REQUEST['pfmaterial'])){
                                        if($_REQUEST['pfmaterial'] == $row['materialID']){
                                            echo ' checked';
                                            $materialChecked = 1;
                                        }
                                    }
                                    echo "/>
                                    <label for='pfmaterial_".$row['materialID']."' class='radiobuttonlable'>".ucfirst($row['material'])."</label>
                                    <div class='check'></div>
                                </li>";
                        }
                    ?>

                    <li>
                        <input type="radio" name="pfmaterial" id='pfmaterial_all' value="0" <?php echo ($materialChecked==0)?'checked' : '';?>/>
                        <label for="pfmaterial_all" class='radiobuttonlable'>All</label>
                        <div class="check"></div>
                    </li>
                </ul>

            </div>




        </div>
    </div>

    <div class="pfilterblock">
        <div class="pfiltername" onclick='myshowhide(this);'>v Pattern</div>
        <div class="pfilterbody">
        

            <div class="pfpatternblock radiobuttonparent rbpfilters">

                <ul>

                    <?php
                        //include("dbconnection.php");
                        $query = sprintf("SELECT * FROM pattern");
                        $result = mysql_query($query, $connect);
                        
                        $patternCheck = 0;

                        while($row = mysql_fetch_array($result)){
                            echo "<li>
                                    <input type='radio' name='pfpattern' id='pfpattern_".$row['patternID']."' value='".$row['patternID']."'";
                                    if(isset($_REQUEST['pfpattern'])){
                                        if($_REQUEST['pfpattern'] == $row['patternID']){
                                            echo ' checked';
                                            $patternCheck= 1;
                                        }
                                    }
                                    echo "/>
                                    <label for='pfpattern_".$row['patternID']."' class='radiobuttonlable'>".ucfirst($row['pattern'])."</label>
                                    <div class='check'></div>
                                </li>";
                        }
                    ?>

                    <li>
                        <input type="radio" name="pfpattern" id='pfpattern_all' value="0" <?php echo ($patternCheck==0)?'checked' : '';?>/>
                        <label for="pfpattern_all" class='radiobuttonlable'>All</label>
                        <div class="check"></div>
                    </li>
                </ul>

            </div>



        </div>
    </div>


</div>
<?php
			#
			#	napravi podatak koji cu samo da dodam u link 
			#
$data['offset'] = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
$data['itemsperpage'] = isset($_REQUEST['sortView'])? $_REQUEST['sortView'] : 9;
$sview = $data['itemsperpage'];
			$navigationlink = "";

			$wherepart['color'] = 0;
            $wherepart['size'] = 0;
            $wherepart['material'] = 0;
            $wherepart['pattern'] = 0;

            $wherepart['category'] = 0;
            $wherepart['sale'] = 0;
            $wherepart['forMWK'] = 0;
            $wherepart['search'] = 0;


            $wherepart['priceandold_az'] =0;

            $fullorder = 'ORDER BY ';
            $fullwhere = 'WHERE ';


            if(isset($_REQUEST['filtercolors'])){               
                if($_REQUEST['filtercolors']!='12'){    
                    if(preg_match("/^\d+$/",$_REQUEST['filtercolors'])){
                        $wherepart['color'] = ' colorID='.$_REQUEST['filtercolors'].' AND';
						$navigationlink .= '&colorID='.$_REQUEST['filtercolors'];
                    }
                }
            }
            if(isset($_REQUEST['pfsize'])){
                if($_REQUEST['pfsize']!='0'){
                    if(preg_match("/^\d+$/",$_REQUEST['pfsize'])){
                        $wherepart['size'] = ' sizeID='.$_REQUEST['pfsize'].' AND';
						$navigationlink .= '&sizeID='.$_REQUEST['pfsize'];
                    }
                }
            }
            if(isset($_REQUEST['pfmaterial'])){
                if($_REQUEST['pfmaterial']!='0'){
                    if(preg_match("/^\d+$/",$_REQUEST['pfmaterial'])){
                        $wherepart['material'] = ' materialID='.$_REQUEST['pfmaterial'].' AND';
						$navigationlink .= '&materialID='.$_REQUEST['pfmaterial'];
                    }
                }
            }
            if(isset($_REQUEST['pfpattern'])){
                if($_REQUEST['pfpattern']!='0'){
                    if(preg_match("/^\d+$/",$_REQUEST['pfpattern'])){
                        $wherepart['pattern'] = ' patternID='.$_REQUEST['pfpattern'].' AND';
						$navigationlink .= '&patternID='.$_REQUEST['pfpattern'];
                    }
                }
            }
            if(isset($_REQUEST['sort_by'])){//category
                if($_REQUEST['sort_by']=='1'){
                    $wherepart['category'] = ' categoryID='.$_REQUEST['sort_by'].' AND';
					$navigationlink .= '&categoryID='.$_REQUEST['sort_by'];
                }
            }
            if(isset($_REQUEST['searchtext'])){
                if(preg_match("/^[\w\d\s]+$/",$_REQUEST['searchtext'])){
                    $wherepart['search'] = " productName LIKE '%".trim($_REQUEST['searchtext'])."%' AND";
                }
            }
            if(isset($_REQUEST['lpos'])){
                if($_REQUEST['lpos']=='2'){
                    $wherepart['forMWK'] = ' forMWK=1 AND ';   //MEN
					$navigationlink .= '&lpos=2';
                }
                if($_REQUEST['lpos']=='3'){
                    $wherepart['forMWK'] = ' forMWK=2 AND ';   //WOMEN
					$navigationlink .= '&lpos=3';
                }
                if($_REQUEST['lpos']=='4'){
                    $wherepart['forMWK'] = ' forMWK=3 AND ';  //KID
					$navigationlink .= '&lpos=4';
                }
                if($_REQUEST['lpos']=='5'){
                    $wherepart['sale'] = ' saleProcent > 0 AND';  
                }
            }
 
                if($wherepart['color']){
                    $fullwhere .=  $wherepart['color'];
                }
                if($wherepart['size']){
                    $fullwhere .=  $wherepart['size'];
                }
                if($wherepart['material']){
                    $fullwhere .=  $wherepart['material'];
                }
                if($wherepart['pattern']){
                    $fullwhere .=  $wherepart['pattern'];
                }
                if($wherepart['category']){
                    $fullwhere .=  $wherepart['category'];
                }
                if($wherepart['sale']){
                    $fullwhere .=  $wherepart['sale'];
                }
                if($wherepart['forMWK']){
                    $fullwhere .=  $wherepart['forMWK'];
                }
                if($wherepart['search']){
                    $fullwhere .=  $wherepart['search'];
                }
                $fullwhere .= ' 1=1 ';


            if(isset($_REQUEST['sort_by'])){
                if(preg_match("/^\d+$/",$_REQUEST['sort_by'])){
                    if($_REQUEST['sort_by'] == '2'){
                        $wherepart['priceandold_az'] = "price DESC";
						$navigationlink .= '&sort_by=2';
                    }
                    else if($_REQUEST['sort_by'] == '3'){
                        $wherepart['priceandold_az'] = "price";
						$navigationlink .= '&sort_by=3';
                    }
                    else if($_REQUEST['sort_by'] == '4'){
                        $wherepart['priceandold_az'] = "timeProductAdd";
						$navigationlink .= '&sort_by=4';
                    }
                    else if($_REQUEST['sort_by'] == '5'){
                        $wherepart['priceandold_az'] = "productName";
						$navigationlink .= '&sort_by=5';
                    }
                }
            }
			if(isset($_REQUEST['forKid'])){
                            $regFK = "/^[0-1]$/";
                            if(preg_match($regFK,$_REQUEST['forKid'])){
                                $navigationlink .= "&forKid=".$_REQUEST['forKid'];              
							}
            }

            if($wherepart['priceandold_az']){
                $fullorder .= " ".$wherepart['priceandold_az']." ";
            }else{
                $fullorder = '';
            }

            
            $fullquery = "SELECT * FROM product ".$fullwhere." ".$fullorder." LIMIT ".$sview." OFFSET ".$data['offset'];

            $fullresult = mysql_query($fullquery, $connect);
?>

<script>
    function myshowhide(obj){

        var text = obj.textContent;

        if(text.charAt(0) == "v"){
            //
            //  pokazi obj
            //
            obj.textContent = "^"+text.substr(1,text.length);
            obj.parentElement.children[1].style.cssText = "max-height: 500px;transition: max-height 0.25s ease-in;";
        }
        else{
            //
            //  sakrij obj
            //
            obj.textContent = "v"+text.substr(1,text.length);
            obj.parentElement.children[1].style.cssText = "max-height: 0;transition: max-height 0.25s ease-out;overflow: hidden;";
        }
    }

    
    //
    //
    //  STAVI GORE DA Php-om POSTAVLJAS v ^ [pfopend]
    //  tako da se js ne bi zbunjivao :D 
    //  kada je nesto izabrano iz padajucih a da nije podrazumevano
    //
    //
</script>



<?php
            $query = "SELECT COUNT(*) as c FROM product ".$fullwhere." ".$fullorder;
            $result = mysql_query($query,$connect);

            $values['page'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;

            $data['dbcountitems'] = mysql_fetch_array($result)['c'];
            
            
            $data['paginationpages'] = floor($data['dbcountitems']/$data['itemsperpage'] ) + 1 ;
            $data['thispage'] = ($data['offset'] / $data['itemsperpage'] ) + 1;

            $data['prevpageid'] = $data['offset'] - $data['itemsperpage'] ;
            $data['nextpageid'] = $data['offset'] + $data['itemsperpage'] ;

            $data['paginationHTML'] = "";

            $data['paginationHTML'] .="<div class='paginationbtns'>";
            if($data['thispage']>1){
                $data['paginationHTML'] .= "<a href='index.php?page=".$values['page']."&offset=".$data['prevpageid'].$navigationlink."' class='pbtnprev pbtnall'>PREV</a>";
            }
            else{
                $data['paginationHTML'] .="<div class='pbtnprev pbtnall'>PREV</div>";
            }
            $data['paginationHTML'] .= "<div class='pbtnnumber pbtnall'>".$data['thispage']."</div>";

            if(($data['offset']+$data['itemsperpage']) >= $data['dbcountitems']){
                $data['paginationHTML'] .= "<div class='pbtnnext pbtnall'>NEXT</div>";
            }
            else{
                $data['paginationHTML'] .="<a href='index.php?page=".$values['page']."&offset=".$data['nextpageid'].$navigationlink."' class='pbtnnext pbtnall'>NEXT</a>";
            }

            $data['paginationHTML'] .= "</div>";

            $data['paginationHTML'] .="<div class='clear'></div>";

    
            $sortQuickLinks = isset($_REQUEST['sortQuickLinks']) ? $_REQUEST['sortQuickLinks'] : 1;
    ?>





<div class="productcontainer">
    <div class="pagination_all">
        

        <input type="hidden" name='sortQuickLinks' id='sortQuickLinks' value='<?php echo $sortQuickLinks;?>'>
        <input type="hidden" name='sortView' id='sortView' value='<?php echo $data['itemsperpage'];?>'>
        <?php 
            $sortBy = $sortQuickLinks;
            
        ?>
        <div class="sort_box">
			<label for="sort_by_top" class="sort_by_text">Sort by:</label>
			<select id="sort_by_top_select" name="sort_by" class="top_select_sort _select_sort" selected="selected">
                <option value="1" <?php echo (1 == $sortBy) ?  'selected' : '' ; ?>>Newest</option>
                <option value="2" <?php echo (2 == $sortBy) ?  'selected' : '' ; ?>>Price [High - Low]</option>
                <option value="3" <?php echo (3 == $sortBy) ?  'selected' : '' ; ?>>Price [Low - High]</option>
                <option value="4" <?php echo (4 == $sortBy) ?  'selected' : '' ; ?>>Oldest</option>
                <option value="5" <?php echo (5 == $sortBy) ?  'selected' : '' ; ?>>A-Z</option>
            </select>
			<label for="view_top" class="view_text">View:</label>
			<select id="view_top_select" name="view" class="top_select_view _select_view" selected="selected">
                <option value="9" <?php echo (9 == $sview) ?  'selected' : '' ; ?>>9</option>
                <option value="12" <?php echo (12 == $sview) ?  'selected' : '' ; ?>>12</option>
                <option value="15" <?php echo (15 == $sview) ?  'selected' : '' ; ?>>15</option>
            </select>
		</div>
        </form>

        <?php
            echo $data['paginationHTML'] ;
        ?>

    </div>
    <div class="productsbody">


        <?php

        #
	#	ovde je bilo pre - - - 
	#
            if(mysql_num_rows($fullresult)>0){
            while($row = mysql_fetch_array($fullresult)){
                echo "<a class='oneproductbody' href='index.php?page=12&productID=".$row['productID']."'>
                        <figure class='opbimagehlight'>
                        <img src='".$row['imgLink']."' alt='".$row['imgAlt']."'/>
                            <figcaption>
                                <h2>".$row['productName']."</h2>
                                <p>".substr($row['description'], 0 , 25)."...</p>
                            </figcaption>			
                        </figure>
                        <div class='opbtextblock'>";
                        if($row['saleProcent'] != 0){
                            echo"<div class='opbbpricebeffore'>$".($row['price']/100)."</div>";
                        }
                        echo"<div class='opbbpricenow'>$".(($row['price'] - ($row['saleProcent']/100)*$row['price'])/100)."</div>";
                        if($row['saleProcent'] != 0){
                            echo"<div class='opbbpriceprocent'>(-".$row['saleProcent']."%)</div>";
                        }
                        echo"</div>
                    </a>";
            }}
            else{
                echo"<div class='noproduct'>No products found.</div>";
            }
        ?>



    </div>
    <div class="pagination_all">
        <div class="sort_box">
			<label for="sort_by_top" class="sort_by_text">Sort by:</label>
			<select id="sort_by_top_select" name="sort_by" class="bottom_select_sort _select_sort" selected="selected">     
                <option value="1" <?php echo (1 == $sortBy) ?  'selected' : '' ; ?>>Newest</option>
                <option value="2" <?php echo (2 == $sortBy) ?  'selected' : '' ; ?>>Price [High - Low]</option>
                <option value="3" <?php echo (3 == $sortBy) ?  'selected' : '' ; ?>>Price [Low - High]</option>
                <option value="4" <?php echo (4 == $sortBy) ?  'selected' : '' ; ?>>Oldest</option>
                <option value="5" <?php echo (5 == $sortBy) ?  'selected' : '' ; ?>>A-Z</option>
            </select>
			<label for="view_top" class="view_text">View:</label>
			<select id="view_top_select" name="view" class="bottom_select_view _select_view" selected="selected">
                <option value="9" <?php echo (9 == $sview) ?  'selected' : '' ; ?>>9</option>
                <option value="12" <?php echo (12 == $sview) ?  'selected' : '' ; ?>>12</option>
                <option value="15" <?php echo (15 == $sview) ?  'selected' : '' ; ?>>15</option>
            </select>
		</div>
    

    <?php
            echo $data['paginationHTML'] ;
            mysql_close($connect);
    ?>

    </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $( ":radio" ).change(function() {
		    submit_filter();
	    });
	
        $('._select_sort').change(function(){
            $('#sortQuickLinks').val($(this).val());
            submit_filter();
        });
        $('._select_view').change(function(){
            $('#sortView').val($(this).val());
            submit_filter();
        });	

        function submit_filter(){
	        document.getElementById("productfilterform").submit();
        }
    });
</script>

<div class="clear"></div>	
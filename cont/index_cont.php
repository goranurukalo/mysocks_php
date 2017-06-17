<div id='index_slider'></div>

<div class="typeshowcase">
    

    <div class="tsbox">
    <a href='index.php?page=11&lpos=2&forKid=0'>
        <div class="newarrivals">
            new arrivals
        </div>
        <div class="men_women_kid_nar">
            MEN's
        </div>
        <div class="tsboximage tsmen"></div>
    </a>
    </div>

    <div class="tsbox">
    <a href='index.php?page=11&lpos=3&forKid=0'>
        <div class="newarrivals">
            new arrivals
        </div>
        <div class="men_women_kid_nar">
            LADIES
        </div>
        <div class="tsboximage tswomen"></div>
    </a>
    </div>
    
    <div class="tsbox">
    <a href='index.php?page=11&lpos=4&forKid=1'>
        <div class="newarrivals">
            new arrivals
        </div>
        <div class="men_women_kid_nar">
            KIDS
        </div>
        <div class="tsboximage tskid"></div>
    </a>
    </div>
</div>

<div class="clear"></div>

<div id="index_paralex"></div>

<div class="showcaseproducts">
<?php
    include("dbconnection.php");
    $query = "SELECT * FROM product ORDER BY RAND() LIMIT 4";
    $result = mysql_query($query, $connect);
    mysql_close($connect);

    while($row = mysql_fetch_array($result)){
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
    }

?>

</div>

<script>
var slider_i = 0;
var slider_array = [
        "<img src='images/slider1-min.jpg' alt='Bow ties slider'/>",
        "<img src='images/slider2-min.jpg' alt='Bow ties slider'/>",
        "<img src='images/slider3-min.jpg' alt='Bow ties slider'/>",
        "<img src='images/slider4-min.jpg' alt='Bow ties slider'/>"
];
var slider_elem;
function sliderNext(){
	slider_i++;
	slider_elem.style.opacity = 0;
	if(slider_i > (slider_array.length - 1)){
		slider_i = 0;
	}
	setTimeout('sliderSlide()',1000);
}
function sliderSlide(){
	slider_elem.innerHTML = slider_array[slider_i];
	slider_elem.style.opacity = 1;
	setTimeout('sliderNext()',4000);
}
$(document).ready(function(){
    slider_elem = document.getElementById('index_slider');
    sliderSlide();
});
</script>
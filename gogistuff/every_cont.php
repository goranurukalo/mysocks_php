<?php
if($_SESSION['role']==1){
    $linetext = array(
        '2' => array('User', 8),
        '3' => array('Product', 9),
        '4' => array('Sale', 10),
        '5' => array('FAQ', 11),
        '6' => array('Poll', 12)
        );
?>


<div class="logintext">My socks</div>
<div class="loginline"></div>
<div class="loginlinetext"><?php echo $linetext[$page][0];?></div>

<div class="ec4blocks">

    <a class="ecblock ripplelink cyan ec4add" href="n1shhh.php?page=<?php echo $linetext[$page][1];?>&job=1"></a>
    <a class="ecblock ripplelink cyan ec4manage" href="n1shhh.php?page=<?php echo $linetext[$page][1];?>&job=2"></a>
    <a class="ecblock ripplelink cyan ec4remove" href="n1shhh.php?page=<?php echo $linetext[$page][1];?>&job=3"></a>
    <a class="ecblock ripplelink cyan ec4view" href="n1shhh.php?page=<?php echo $linetext[$page][1];?>&job=4"></a>
</div>
<script>
$(function(){
	var ink, d, x, y;
	$(".ripplelink").mouseenter(function(e){
    if($(this).find(".ink").length === 0){
        $(this).prepend("<span class='ink'></span>");
    }
         
    ink = $(this).find(".ink");
    ink.removeClass("animate");
     
    if(!ink.height() && !ink.width()){
        d = Math.max($(this).outerWidth(), $(this).outerHeight());
        ink.css({height: d, width: d});
    }
     
    x = e.pageX - $(this).offset().left - ink.width()/2;
    y = e.pageY - $(this).offset().top - ink.height()/2;
     
    ink.css({top: y+'px', left: x+'px'}).addClass("animate");
});
});
</script>
<div class="clear"></div>
<?php
}
?>
<?php
if($_SESSION['role']==1){
    $curpage = array(
        '0' => "",
        '1' => "",
        '2' => "",
        '3' => "",
        '4' => "",
        '5' => "",
        '6' => "",
    );
    if(isset($curpage[$page])){
        $curpage[$page] = " class='current_page_item' ";
    }
    else if($page == 8){$curpage[2] = " class='current_page_item' ";}
    else if($page == 9){$curpage[3] = " class='current_page_item' ";}
    else if($page == 10){$curpage[4] = " class='current_page_item' ";}
    else if($page == 11){$curpage[5] = " class='current_page_item' ";}
    else if($page == 12){$curpage[6] = " class='current_page_item' ";}
    else{
        $curpage['0'] = " class='current_page_item' ";
    }
?>
<div class="header wmax">
    <a href="index.php">
        <div class="logoimg"></div>
    </a>
    <div class="navmenu">
        <ul id="example-one">
            <li <?php echo $curpage[0];?>><a href='#' class='menulink'></a></li>
            <li><a href="index.php">My socks site</a></li>
            <li <?php echo $curpage[1];?>><a href="n1shhh.php?page=1">cPanel</a></li>
            <li <?php echo $curpage[2];?>><a href="n1shhh.php?page=2">User</a></li>
            <li <?php echo $curpage[3];?>><a href="n1shhh.php?page=3">Product</a></li>
            <li <?php echo $curpage[4];?>><a href="n1shhh.php?page=4">Sale</a></li>
            <li <?php echo $curpage[5];?>><a href="n1shhh.php?page=5">FAQ</a></li>
            <li <?php echo $curpage[6];?>><a href="n1shhh.php?page=6">Poll</a></li>
        </ul>
    </div>
    <script>
    $( document ).ready(function() {

        var $el, leftPos, newWidth;
            $mainNav2 = $("#example-one");
        
        $("#example-one").append("<li id='magic-line'></li>");
        
        var $magicLine = $("#magic-line");
        
        $magicLine
            .width($(".current_page_item").width())
            .css("left", $(".current_page_item a").position().left)
            .data("origLeft", $magicLine.position().left)
            .data("origWidth", $magicLine.width());
        
            
        $("#example-one li").find("a").hover(function() {
            $el = $(this);
            leftPos = $el.position().left;
            newWidth = $el.width();
            
            $magicLine.stop().animate({
                left: leftPos,
                width: newWidth
            });
        }, function() {
            $magicLine.stop().animate({
                left: $magicLine.data("origLeft"),
                width: $magicLine.data("origWidth")
            });    
        });
    });
    </script>
</div>
<div class="headerhr"></div>
<div class="clear"></div>
<?php
}
?>
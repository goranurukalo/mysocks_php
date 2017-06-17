<div id='header' class='wmax'>
    <div><a href='index.php?page=1' class='logoimage'></a></div>

    <div class='header_rightside'>
        <div class='login_cont'>
        <?php
        if(!isset($_SESSION['role'])){
        echo"
            <div class='login'>
                <a class='header_log_link' href='index.php?page=3'>Login</a>
            </div>
            <div class='register'>
                <a class='header_log_link' href='index.php?page=4'>Register</a>
            </div>
        ";}
        else{
            echo"
            <div class='logout'>
                <a class='header_log_link' href='index.php?page=14'>Logout</a>
            </div>
            ";
        }
        ?>
        </div>

        <div class='search_cart'>
            <form id='searchitem_form' action='cont/search_cont.php' method='POST' onsubmit='return sendme();'>
                <input type='text' name='searchtext' id='searchtext' class='' placeholder='SEARCH ITEM'>
                <input type='submit' name='submintsearch' id='submitsearch' class='' value=''>
            </form>
            
            <a href='index.php?page=13' class='shoppingbag'>
                <?php
                    if(isset($_SESSION['numBagItems'])){
                        echo $_SESSION['numBagItems'];
                    }
                    else{
                        echo "0";
                    }
                ?>
            </a>
        </div>

        <div class='navmenu'>
            <ul id='example-one'>
                <?php
                    include("dbconnection.php");
                    $query = sprintf("SELECT * FROM meni");
                    $result = mysql_query($query, $connect);
                    mysql_close($connect);

                    $lpos = isset($_REQUEST['lpos']) ? $_REQUEST['lpos'] : 0;
                    $lpos = $page == '1'? 1 : $lpos;
                    if($lpos == 0){
                        echo 
                        "<li class='current_page_item'>
                            <a href='#' class='menulink'></a>
                        </li>";
                    }
                    else {
                        echo 
                        "<li>
                            <a href='#' class='menulink'></a>
                        </li>";
                    }

                    while($row = mysql_fetch_array($result)){
                        if($row['meniID'] == $lpos){
                            echo
                            "<li class='current_page_item'>
                                <a href='".$row['link']."&lpos=".$row['meniID']."' class='menulink'>".$row['meni']."</a>
                            </li>";
                        }
                        else{
                            echo
                            "<li>
                                <a href='".$row['link']."&lpos=".$row['meniID']."' class='menulink'>".$row['meni']."</a>
                            </li>";
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
    <script type='text/javascript' src='js/jquery.js'></script>
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
<div class='clear'></div>
<div class='headerhr'></div>
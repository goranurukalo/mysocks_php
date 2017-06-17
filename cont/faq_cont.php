<div class="logintext">My socks</div>
<div class="loginline"></div>
<div class="loginlinetext">FAQ</div>

<div class="faqspacer"></div>
<?php
    include("dbconnection.php");
    $query = sprintf("SELECT * FROM faq");
    $result = mysql_query($query, $connect);
    mysql_close($connect);

    while($row = mysql_fetch_array($result)){
        echo 
        "<div class='faqquestion'>
        <div class='faqtext' onclick='myshowhide(this);'>v ".$row['faqQuestion']."</div>
        <div class='faqanswer'>".$row['faqAnswer']."</div>
        </div>";
    }
?>

<script>
    function myshowhide(obj){

        var text = obj.textContent;

        if(text.charAt(0) == "v"){
            //
            //  pokazi obj
            //
            obj.textContent = "^"+text.substr(1,text.length);
            obj.parentElement.children[1].style.cssText = "padding-left:20px;max-height: 500px;transition: max-height 0.25s ease-in;";
        }
        else{
            //
            //  sakrij obj
            //
            obj.textContent = "v"+text.substr(1,text.length);
            obj.parentElement.children[1].style.cssText = "padding-left:20px;max-height: 0;transition: max-height 0.25s ease-out;overflow: hidden;";
        }
    }
</script>
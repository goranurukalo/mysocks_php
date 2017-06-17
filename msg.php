<?php
    function error($value){
        echo "<div class='error-msg msgs'>
                &#x2716; ".$value."
            </div>";
    }
    function info($value){
        echo "<div class='info-msg msgs'>
                &#128712; ".$value."
            </div>";
    }
    function success($value){
        echo "<div class='success-msg msgs'>
                &#10003; ".$value."
            </div>";
    }
    function warning($value){
        echo"<div class='warning-msg msgs'>
                &#9888; ".$value."
            </div>";
    }
?>








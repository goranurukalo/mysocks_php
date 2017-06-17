<div class='footerhr'></div>
<div id="footer">
    <div class='footercont wmax'>
        <div class="footerblock">
            <h3>Information</h3>
            <ul>
                <li><a href="index.php?page=10">Contact Us</a></li>
                <li><a href="index.php?page=2">Author</a></li>
                <li><a href="index.php?page=9">FAQ</a></li>
            </ul>
        </div>

        <div class="footerblock">
            <h3>My account</h3>
            
            <ul>
            <?php
                if(!isset($_SESSION['role'])){
                    
                echo"
                    <li><a href='index.php?page=3'>Login</a></li>
                    <li><a href='index.php?page=4'>Register</a></li>
                    ";
                }
                else{
                    $bagcount = isset($_SESSION['numBagItems']) ? $_SESSION['numBagItems'] : 0;
                    if($_SESSION['role']==1){
                        echo "<li><a href='n1shhh.php'>cPanel</a></li>";
                        echo "<li><a href='MyCrazyDoc.pdf'>Documentation</a></li>";
                    }
                    echo "
                        <li><a href='index.php?page=15'>My profile</a></li>
                        <li><a href='index.php?page=13'>Bag (".$bagcount.")</a></li>
                        <li><a href='index.php?page=14'>Logout</a></li>     
                    ";
                }
            ?>
            </ul>
        </div>

        <div class="footerblock">
            <h3>Quick links</h3>
            <ul>
                <li><a href="index.php?page=11&sortQuickLinks=1">Newest</a></li>
                <li><a href="index.php?page=11&sortQuickLinks=2">Price [High - Low]</a></li>
                <li><a href="index.php?page=11&sortQuickLinks=3">Price [Low - High]</a></li>
                <li><a href="index.php?page=11&sortQuickLinks=4">Oldest</a></li>
                <li><a href="index.php?page=11&sortQuickLinks=5">A - Z</a></li>
            </ul>
        </div>

        <div class="footerblock footernl">
            <div class='footernltop'>
                <h3>Newsletter</h3>
                <ul>
                    <li>
                        <form id='newsletterform' action='index.php?page=6' method='POST' onsubmit="return sendsubscribe();">
                            <input type='text' name='nlmail' id='nlmail' placeholder='YOUR E-MAIL ADDRESS' oninput="setCustomValidity('');">
                            <input type='submit' name='nlsubmit' id='nlsubmit' value='SUBSCRIBE'>
                        </form>
                    </li>
                    <p class='footerunsub'>You may <a href='index.php?page=7'>unsubscribe</a> at any time.</p>
                </ul>
            </div>

            <div class='footernlbottom'>
                <h3>Follow us</h3>
                <ul class='footersocial'>
                    <li><a href="https://www.facebook.com/" class='footersocialimg fimgfb'></a></li>
                    <li><a href="https://www.instagram.com/" class='footersocialimg fimginst'></a></li>
                    <li><a href="https://twitter.com/" class='footersocialimg fimgtw'></a></li>
                    <li><a href="https://www.youtube.com/" class='footersocialimg fimgyt'></a></li>
                    <li><a href="https://plus.google.com/" class='footersocialimg fimggp'></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clear"></div>

    <div class="footercrline wmax"></div>
    <div class='footercopyright'>My socks &copy; 2017 by Urukalo Goran</div>
</div>
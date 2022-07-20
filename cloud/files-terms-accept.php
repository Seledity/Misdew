<?php
require_once("../inc/conx.php");
?>
<h1>Are You Sure?</h1>
You are about to agree to the <a href="https://www.misdew.com/cloud/file-terms.html">terms</a>. This will log your choice to your Misdew.com account. This cannot be undone. <br><br>
If you change your mind, you must stop using the site completely. <br><br>
Please email <b>me@justa.us</b> with any questions or options.<br><br>
<a style="font-size: 40px; font-weight: bold;" onclick="return confirm('Are you sure? By continuing, you awknowledge, consent, and agree to the terms from the previous page. They are also linked at the top of this page. You understand that your choice cannot be undone. If you change your mind, you must stop using the site completely. You can also email me@justa.us for options. \n Are you sure? \n Do you agree? \n I agree to the terms.')" href="confirm-to-terms.php?vkey=<?php echo $u_token; ?>">This is a link taking me to a web page where my choice to confirm that I awknowledge, consent, and agree to the terms from the previous page is logged and stored for my account. The terms are also linked at the top of this page. This cannot be undone. I understand. If I change my mind, I must stop using the site completely. I can also send an email to me@justa.us for options.</a> <br><br>

<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */

    // create a walker to be used if a menu has been created
    $walker = new Custom_Walker_Nav_Menu();

    dynamic_sidebar( 'social-media-widget-area' );
?>
      </section><!-- #main -->
      </div><!-- #page -->
  
<div id="newsletter-sign-up">

<span>Keep up-to-date with events &amp; membership promotions!</span>

<form method="post" action="https://app.icontact.com/icp/signup.php" name="icpsignup" id="icpsignup2900" accept-charset="UTF-8" onsubmit="return verifyRequired2900();" >
<input type="hidden" name="redirect" value="http://mediakit.occasionsonline.com/thank-you/">
<input type="hidden" name="errorredirect" value="http://www.icontact.com/www/signup/error.html">
    <input type="text" name="fields_fname" placeholder="First Name">
    <input type="text" name="fields_email" placeholder="Email">
    <input type="submit" name="Submit" value="Go!">
    <input type="hidden" name="listid" value="41392">
    <input type="hidden" name="specialid:41392" value="QS3F">
    <input type="hidden" name="clientid" value="1194751">
    <input type="hidden" name="formid" value="2900">
    <input type="hidden" name="reallistid" value="1">
    <input type="hidden" name="doubleopt" value="0">
</form>
<script type="text/javascript">

var icpForm2900 = document.getElementById('icpsignup2900');

if (document.location.protocol === "https:")

	icpForm2900.action = "https://app.icontact.com/icp/signup.php";
function verifyRequired2900() {
  if (icpForm2900["fields_email"].value == "") {
    icpForm2900["fields_email"].focus();
    alert("The Email field is required.");
    return false;
  }
  if (icpForm2900["fields_fname"].value == "") {
    icpForm2900["fields_fname"].focus();
    alert("The First Name field is required.");
    return false;
  }


return true;
}
</script>

</div><!-- #newsletter-sign-up -->


<footer id="footer" role="contentinfo">
     
     <?php wp_nav_menu( array('menu' => 'footer-pics' )); ?>
     
    </footer><!-- #footer-wrapper -->
  
    </div><!-- #wrapper-shadow -->
<div id="footer-navigation">
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_id' => 'nav-footer', 'menu' => 'Footer'  ) ); ?>
</div>
</div><!-- #wrapper -->

<?php wp_footer(); ?>

<!-- begin olark code --><script data-cfasync="false" type='text/javascript'>/*{literal}<![CDATA[*/
window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){f[z]=function(){(a.s=a.s||[]).push(arguments)};var a=f[z]._={},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={0:+new Date};a.P=function(u){a.p[u]=new Date-a.p[0]};function s(){a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{b.contentWindow[g].open()}catch(w){c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{var t=b.contentWindow[g];t.write(p());t.close()}catch(x){b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('7643-188-10-7681');/*]]>{/literal}*/</script><noscript><a href="https://www.olark.com/site/7643-188-10-7681/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript><!-- end olark code -->

<?php // The magical PNG fix for IE6 ?>
<!--[if lt IE 7 ]>
<script src="<?php bloginfo('stylesheet_directory'); ?>/inc/js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg');</script>
<![endif]-->

</body>
</html>

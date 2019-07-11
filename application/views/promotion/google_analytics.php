<script src="<?php echo base_url();?>js/cookies-message.js"></script>
    <script>
      $(document).ready(function() {
      	$.CookiesMessage({
					messageText: "This site uses cookies to store information on your computer.<br>Some of these cookies are essential to make our site work and others help us to improve by giving us some insight into how the site is being used.",
					messageBg: "#151515",								// Message box background color
					messageColor: "#FFFFFF",						// Message box text color
					messageLinkColor: "#d5b524",				// Message box links color
					closeEnable: true,									// Show the close icon
					closeColor: "#ffffff",							// Close icon color
					closeBgColor: "#151515",						// Close icon background color
					acceptEnable: true,									// Show the Accept button
					acceptText: "Accept & Close",				// Accept button text
					infoEnable: true,										// Show the More Info button
					infoText: "More Info",							// More Info button text
					infoUrl: "<?php echo base_url();?>cookies",												// More Info button URL
					cookieExpire: 180										// Cookie expire time (days)
				});

      });
    </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70072811-1', 'auto');
  ga('send', 'pageview');

</script>


<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '987789627966283');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=987789627966283&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<!--  Google Adsense Code -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2253869485022707",
    enable_page_level_ads: true
  });
</script><!--  End Google Adsense Code -->
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
    </script>  <!-- common script-->

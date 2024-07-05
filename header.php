<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>SUNRISE HOTEL</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
			function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<!--//fonts-->
	</head>

        
    <body>
        
        
            <!-- /contact -->
                    <div class="copy">
                        <p>© 2017 SUNRISE . All Rights Reserved | Design by <a href="index.php">SUNRISE</a> </p>
                    </div>
        <!--/footer -->
        <!-- js -->
        <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
        <!-- contact form -->
        <script src="js/jqBootstrapValidation.js"></script>

        <!-- /contact form -->	
        <!-- Calendar -->
                <script src="js/jquery-ui.js"></script>
                <script>
                        $(function() {
                        $( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
                        });
                </script>
        <!-- //Calendar -->
        <!-- gallery popup -->
        <link rel="stylesheet" href="css/swipebox.css">
                        <script src="js/jquery.swipebox.min.js"></script> 
                            <script type="text/javascript">
                                jQuery(function($) {
                                    $(".swipebox").swipebox();
                                });
                            </script>
        <!-- //gallery popup -->
        <!-- start-smoth-scrolling -->
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){		
                    event.preventDefault();
                    $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                });
            });
        </script>
        <!-- start-smoth-scrolling -->
        <!-- flexSlider -->
                        <script defer src="js/jquery.flexslider.js"></script>
                        <script type="text/javascript">
                        $(window).load(function(){
                        $('.flexslider').flexslider({
                            animation: "slide",
                            start: function(slider){
                            $('body').removeClass('loading');
                            }
                        });
                        });
                    </script>
                    <!-- //flexSlider -->
        <script src="js/responsiveslides.min.js"></script>
                    <script>
                                // You can also use "$(window).load(function() {"
                                $(function () {
                                // Slideshow 4
                                $("#slider4").responsiveSlides({
                                    auto: true,
                                    pager:true,
                                    nav:false,
                                    speed: 500,
                                    namespace: "callbacks",
                                    before: function () {
                                    $('.events').append("<li>before event fired.</li>");
                                    },
                                    after: function () {
                                    $('.events').append("<li>after event fired.</li>");
                                    }
                                });
                            
                                });
                    </script>
                <!--search-bar-->
                <script src="js/main.js"></script>	
        <!--//search-bar-->
        <!--tabs-->
        <script src="js/easy-responsive-tabs.js"></script>
        <script>
        $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion           
        width: 'auto', //auto or any width like 600px
        fit: true,   // 100% fit in a container
        closed: 'accordion', // Start closed if in accordion view
        activate: function(event) { // Callback function if tab is switched
        var $tab = $(this);
        var $info = $('#tabInfo');
        var $name = $('span', $info);
        $name.text($tab.text());
        $info.show();
        }
        });
        $('#verticalTab').easyResponsiveTabs({
        type: 'vertical',
        width: 'auto',
        fit: true
        });
        });
        </script>
        <!--//tabs-->
        <!-- smooth scrolling -->
            <script type="text/javascript">
                $(document).ready(function() {
                /*
                    var defaults = {
                    containerID: 'toTop', // fading element id
                    containerHoverID: 'toTopHover', // fading element hover id
                    scrollSpeed: 1200,
                    easingType: 'linear' 
                    };
                */								
                $().UItoTop({ easingType: 'easeOutQuart' });
                });
            </script>
            
            <div class="arr-w3ls">
            <a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
            </div>
        <!-- //smooth scrolling -->
        <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
    </body>

    </html>
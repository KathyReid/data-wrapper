<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <title><?php echo _("Data Story") ?></title>

        <!-- General styles -->
        <link rel="stylesheet" type="text/css" href="css/stylesheets/general.css" />

        <!-- JQuery library -->
        <script src="js/jquery-1.6.4.js" type="text/javascript"></script>

        <!-- JQueryUI library -->
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>       
        
        <!-- Fancybox assets -->
        <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

        <!-- The JS function that help navigate the app -->
        <script src="js/navigation-js.php" type="text/javascript"></script> 
        
        <!-- More general functions for the app -->
        <script src="js/functions.js" type="text/javascript"></script> 

    </head>


    <body>
    
	    <script type="text/javascript">

	     $(document).ready(function() {
	        
            //Init all inputs fields so they react properly onBlur
            initInputs();

            //Init the buttons in the header
            initHeader();

            //Loads the fancybox
            $("a.fancybox").fancybox({
                'hideOnContentClick': true
            });

            //init the error box
            $('#error').click(function() {
                $(this).hide();
            });		

            //init the Sign in button
            $('#login_submit').click(function() {
                var email = $('#email').val();
                var pwd = $('#pwd').val();
                $.post('actions/login.php', {email: email, pwd: pwd}, function(data){
                    if (data != ""){
                        data = jQuery.parseJSON(data);
                        if (data.status == 200){
                            
                            //User is logged in, the page reloads with a valid SESSION[user_id]
                            location.reload();

                        }else{
                            error(data.error);
                        }
                    }else{
                        error();
                    }
                });
            }); 

            //init the show Sign up
            $('#show_signup').click(function() {
                $("#login").hide();
                $("#show_signup").hide();
                $("#signup").show();
            }); 

            //init the Sign up
            $('#signup_submit').click(function() {
                var email = $('#email_signup').val();
                var pwd1 = $('#pwd1').val();
                var pwd2 = $('#pwd2').val();
                var tos = $(":checked").val();

                var emailReg = new RegExp(/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/);

                if(emailReg.test(email)) {
                    
                    if (pwd1 == pwd2 && pwd1 != "<?php echo _("Password") ?>"){

                        if (tos == "agree"){

                            $.post('actions/signup.php', {email: email, pwd: pwd1}, function(data){
                                if (data != ""){
                                    data = jQuery.parseJSON(data);
                                    if (data.status == 200){
                                        
                                        //User is signed up and logged in, the page reloads with a valid SESSION[user_id]
                                        location.reload();

                                    }else{
                                        error(data.error);
                                    }
                                }else{
                                    error();
                                }
                            });
                        }else{
                            error("<?php echo _("Please agree to the Terms of Use.") ?>");
                        }
                    }else{
                        error("<?php echo _("Passwords do not match.") ?>");
                    }
                }else{
                    
                    error("<?php echo _("Please enter a valid email address.") ?>");

                }
            }); 
	     });
	    </script>

        <div id="container">
    	    <div id="error" style="display:none;"><?php echo _("Errors are displayed here") ?></div>

            <!-- Start header -->
        	<?php require_once "header.php" ?>
            <!-- End header -->

        	<div id="screen_container">

                <div id="login">
            
                    <input class="login" id="email" value="<?php echo _("E-mail") ?>">
                    <input class="login" id="pwd" type="password" value="<?php echo _("Password") ?>">
                    <button id="login_submit" class="button"><?php echo _("Login") ?></button>
            
                </div>


                <div id="signup">

                    <input class="login" id="email_signup" value="<?php echo _("E-mail") ?>">
                    
                    <div class="clear"></div>
                    
                    <small><?php echo _("Enter password twice") ?></small>
                    <input class="login" id="pwd1" type="password" value="<?php echo _("Password") ?>">
                    <input class="login" id="pwd2" type="password" value="<?php echo _("Password") ?>">
                    
                    <div class="clear"></div>
                    
                    <small><a href="#terms_of_use" class="fancybox"><?php echo _("I agree to the Terms of Use") ?></a></small><input type="checkbox" id="tos" value="agree">
                    
                    <div class="clear"></div>

                    <button id="signup_submit" class="button"><?php echo _("Sign up") ?></button>
                </div>


                <div id="about">
                    <p><?php echo _("DataStory helps journalists build compelling visualizations in just a few clicks. It uses the latest, most powerful JavaScript libraries but requires no coding at all.") ?></p>
                    <p><?php echo _("The project is lead and maintained by ABZV.") ?></p>
                    <button id="show_signup" class="button"><?php echo _("Sign up") ?></button>
                </div>

        	</div>

            <!-- Start Footer -->
            <?php require_once "views/footer.php"; ?>
            <!-- End Footer -->

        </div>
    </body>
</html>
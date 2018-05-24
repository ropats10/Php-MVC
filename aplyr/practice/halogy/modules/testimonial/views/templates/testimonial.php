<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>APLYR - Your Personal Career Agent</title>
<link rel="stylesheet" type="text/css" href="style/style.css"/>


 

</head>

<body>

<div class="maincontainerarea">
    
    <div class="fixcontent">
            <div class="myaccountarea">
            	<a href="signin.html" class="signin">Sign In</a>
                <a href="signup.html" class="signup">Sign Up</a>
            </div>
    </div>
    <div class="clear"></div>
    <div class="container">
    	<div class="fixcontent">
        	<div class="header">
            	<div class="logoarea">
           	    	<a href="index.html"><img src="image/aplyr-logo.png" alt="APLYR - Your Personal Career Agent" /></a>
                </div>
                <div class="mainmenu">
                	<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="about-us.html">About Us</a></li>
						<li><a href="process.html">Process</a></li>
						<li><a href="plans.html" class="active">Plans</a></li>
						<li><a href="blog.html">Blog</a></li>
						<li><a href="contact-us.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    	
        <div class="internalpagetitle">
        	<div class="fixcontent">    
            <h1>Plans</h1>
            <div class="clear"></div>
            </div>
        </div> 
        
        <div class="fixcontent">
            <hr />
             
            <div class="clear"></div>
            
                 {if testimonial} 
                    {pagination}
                        {testimonial}
                            <div class="testmonials">
                            <img src="image/testimonials.png" width="32" height="23" />
                                            <p>{description}
                                    <br class="authorspace" /><strong>{author}</strong><br /><span>{location}</span></p>

                             </div>
                         {/testimonial}
                    {pagination}
                 
		{/if}
 
        </div>
        
        
    </div>

<div class="footerarea">
	<div class="fixcontent">
    	<div class="footerlinks">
        	© Copyrights, all rights reservevd  &nbsp;&nbsp;&nbsp;&nbsp;<a href="terms-of-services.html">Terms of Services</a>  |  <a href="privacy-policy.html">Privacy Policy</a>  |  <a href="help-center.html">Help Center</a>
        </div>
        <div class="footericon">
   	    	<img src="image/sitelock.png" width="61" height="37" />
        </div>
        <div class="clear"></div>
    </div>
</div>


    
</div>

</body>
</html>


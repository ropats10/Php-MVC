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
        	 <div class="plans">
                    {if plan} 
                        {pagination}
                                {plan}
                                    <div class="plansection">
                                        <h2 class="{className}">{planName}</h2>
                                            <ul>
                                                <li><strong>{noOfCredit}</strong> Application Credit</li>
                                                <li>Application Credit Valid for <strong>{creditValidity}</strong></li>
                                                <li>Up to <strong>{perDayLimit}</strong> Link Submission Per Day</li>
                                                <li>APLYR Customer Support {customerSupport}</li>
                                            </ul>
                                            <div class="planprice">{planPrice}</div>
                                    </div>
                                   {/plan}
                                   {pagination}
                                   {else}
                                        <p>No wiki pages added yet.</p>
				
                                    {/if}
                <div class="clear"></div>
                <div class="plangetstartedbutton">
                	<a href="signin.html">Get Started Today!</a>
                </div>
                
            </div>
             
             
            <hr />
             
            <div class="clear"></div>
            <div class="testmonials">
            	<img src="image/testimonials.png" width="32" height="23" />
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultrices, urna sit amet molestie dictum, odio lacus tempor mauris, ut facilisis orci arcu eget diam. Maecenas at feugiat sapien
    			<br class="authorspace" /><strong>Jim Carry</strong><br /><span>London</span></p>
                
            </div>
            
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


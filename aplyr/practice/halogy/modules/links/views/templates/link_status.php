{include:headerMain}
{include:menu}
{include:profileContent}



        
        <div class="fixcontent">
        	 
        	 <div class="contentarea">
             
              {include:profileMenu}
             
             <div class="myaccontainer">
             

<div class="myaccstatusbar">
                {if links} 
                {pagination}
                {links}

                <br class="clear" />
                <div class="myaccstatusbarline">

                    <div class="myaccstatusicn">
                        {link_status}
                    </div>

                    <div class="myaccstatuslink">
                        <input type="text" name="link_url" id="link_url" value="{link_url}" disabled="disabled" />
                    </div>
                    <div class="clear"></div>
                </div>
                {/links}
                {pagination}
		{else}
			<p>You have no submitted links yet.</p>
                {/if}   

                <div class="clear"></div>
</div> 




                 
            	<div class="clear"></div>
              
             
             </div>
             <div class="clear"></div>
             </div> 
             
             
           
            <div class="clear"></div>
            
        </div>
        
        
    </div>


{include:footerMain}

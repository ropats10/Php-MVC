{include:headerMain}
{include:menu}
{include:profileContent}

<div class="fixcontent">

    <div class="contentarea">

        {include:profileMenu}

        <div class="myaccontainer">
            {if errors}
            <div class="error clear">
                {errors}
            </div>
            {/if}
            
            {if message}
            <div class="message clear">
                {message}
            </div>

            {/if}

            <div class="myaccstatusbar">
                <div class="myaccstatusbarline">
                    <div class="myaccstatusicn">
                        <div class="submitlinktxt">Link</div>
                    </div>
                    <form method="post" action="{page:uri}" class="">
                        <div class="myaccstatuslink">
                            <input type="text" name="link_url" id="link_url" value=""  />
                        </div>
                        <div class="clear"></div>
                </div>

                <div class="myaccstatusbarline">
                    <div class="myaccstatusicn">
                        <div class="submitlinktxt">Comments</div>
                    </div>
                    <div class="myaccstatuslink">
                        <input type="text" name="comments" id="comments" value="" />
                        <input type="text" name="userID" id="userID" value="{user}" hidden />
                        <div class="smallbutton" style="text-align:left;">
                            <input name="submit" type="submit" value="Submit" class="customcolor" />
                        </div>
                    </div>
                    </form>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>




            </div>



            <div class="clear"></div>


        </div>
        <div class="clear"></div>
    </div> 



    <div class="clear"></div>

</div>


</div>

</div>
</div>
{include:footerMain}

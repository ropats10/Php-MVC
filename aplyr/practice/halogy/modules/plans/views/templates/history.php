{include:headerMain}
{include:menu}
{include:profileContent}

<div class="fixcontent">

    <div class="contentarea">

        {include:profileMenu}

        <div class="myaccontainer">


            <div class="myaccstatusbar">

                <h3>Plan History</h3>
                <table id="table">
                     <tr ><td style="border:none"> {pagination}</td></tr>
                     <tr>
                        <th>Plan</th>
                        <th>Purchase Date</th>
                        <th>Expire Date</th>
                        <th>Amount</th>
                        <th>Credit</th>
                        <th>Limit Per Day</th>

                    </tr>
                    {if plans} 
                   
                    {plans}
                    <tr>
                        <td>{plan}</td>
                        <td>{purchase_date}</td>
                        <td>{expire_date}</td>
                        <td> $ {amount}</td>
                        <td>{credit}</td>
                        <td>{per_day_credit}</td>

                    </tr>

                    {/plans}
                    <tr ><td style="border:none"> {pagination}</td></tr>
                </table>                
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

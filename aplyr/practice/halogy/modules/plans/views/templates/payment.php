{include:headerMain}
{include:menu}
{include:profileContent}
<div class="fixcontent">
<style type="text/css">
	div.message{
	background: #F4F4F4 none repeat scroll 0% 0%;
	padding: 10px 10px;
	border: 1px solid #CCC;
	margin: 20px 5px 20px;
	border-radius: 8px;
}
</style>

<div class="message">
    <table align="center">
        <tr>
            <td><strong>Selected plan :</strong></td>
            <td>{plan_name}</td>
        </tr>
        <tr>
            <td><strong>Credits :</strong></td>
            <td>  {no_of_credit}</td>
        </tr>
        <tr>
            <td><strong>Validity :</strong></td>
            <td> {credit_validity}</td>
        </tr>
        <tr>
            <td><strong> Validity per day :</strong></td>
            <td>  {per_day_limit}</td>
        </tr>
        <tr>
            <td><strong> Price :</strong></td>
            <td> $ {plan_price}</td>
        </tr>
    </table>
</div>
    

    <form action="" method="post">
        {if errors}
        <div class="error clear">
            {errors}
        </div>
        {/if}


        <div >
            <h3>CREDIT CARD INFORMATION</h3>
            <input type="text" name="card" id="credit-card" placeholder="Credit Card No." required /><br>
            <label><span>Expiration Date (MM/YY)</span></label><br class="clearfix">
            <div class="smalltboxarea">
                <input type="text" name="mm" class="expire" placeholder="MM" required />
                <input type="text" name="yy" class="expire" placeholder="YY" required />
                <label><span></span></label>
                <input type="text" name="code" placeholder="Card Code" />
            </div>



            <h3>BILLING ADDRESS</h3>
            <input type="text" name="fname" placeholder="First Name" value="{form:fname}" required />
            <input type="text" name="lname" placeholder="Last Name" value="{form:lname}" required /><br>

            <input type="email" name="email" placeholder="Email" value="{form:email}" required />
            <input type="text" name="phone" placeholder="Phone Number" value="{form:phone}"/><br>

            <input type="text" name="address" placeholder="Street Address" value="{form:address}" required />
             <input type="text" name="city" placeholder="City"  value="{form:city}" required />
           
            <div class="smalltboxarea">
                {select:country}
                {select:state}
            </div>
           
            <br>    
            <input class="buttonSubmit" type="submit" class="" value="Checkout" />
            <br class="clearfix"><br>

        </div>  <div class="clear"></div>

</div>
</form>



{include:footerMain}
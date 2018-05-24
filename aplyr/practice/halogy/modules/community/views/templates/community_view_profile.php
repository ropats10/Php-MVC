{include:header}

<div id="tpl-community" class="module">
		
	<div class="col col1">
	
		<h1>{page:heading}</h1>
	
		{if user:bio}
			<h3>About Me</h3>
			<div class="bio">
				{user:bio}
			</div>
		{/if}

		{if user:company}
			<h3>My work</h3>

			<p><strong>{user:company}</strong></p>
			
			<div class="bio">
				{user:company-description}
			</div>
		{/if}
		
	</div>
	<div class="col col2">
		
		<div class="avatar">
			{user:avatar}
		</div>
		
		<br />

		<ul class="menu">
			{profile:navigation}
		</ul>
		
		<br />
		
		<form method="post" action="/users/search" class="default">

			<label for="searchbox">Search user:</label><br class="clear" />
			<input type="text" name="query" id="searchbox" maxlength="255" value="" class="searchbox" />
			<input type="image" src="/static/images/btn_search.gif" id="searchbutton" />
			<br class="clear" />

		</form>
	
	</div>

</div>
		
{include:footer}
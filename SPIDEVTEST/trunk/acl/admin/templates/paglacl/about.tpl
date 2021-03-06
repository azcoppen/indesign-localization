{include file="paglacl/header.tpl"}
  </head>
  <body>
	{include file="paglacl/navigation.tpl"}
    <div style="text-align: center;">
      <table cellpadding="2" cellspacing="2" border="2" align="center">
        <tbody>
		{if $first_run != 1}
          <tr>
			<th>
				Help
			</th>
          </tr>
          <tr>
			<td>
				
			</td>
          </tr>
          <tr>
			<th>
				Donate
			</th>
          </tr>
          <tr>
			<td>
				Time working on paglacl means less time that I can work to get paid.<br />
				Therefore any donations I receive will help me to devote more time to developing paglacl.
				<p>However, I'd much rather donations in the form of code and/or documentation.</p>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" align="center">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="ipso@snappymail.ca">
				<input type="hidden" name="item_name" value="php Generic Access Control List">
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="tax" value="0">
				<input type="image" class="paypal" src="https://www.paypal.com/images/x-click-but04.gif" border="0" name="submit" title="Make payments with PayPal - it's fast, free and secure!">
				</form>
			</td>
          </tr>
        {/if}
          <tr>
			<th>
				{if $first_run != 1}
					Report
				{else}
					<font color="#ff0000">* Report *</font>
				{/if}
			</th>
          </tr>
          <tr>
			<td>
				Report some basic information back to the paglacl project so we know where to spend our time.<br />
				<b>All information will be kept private, will not be sold, and will only be used for informational purposes regarding paglacl.</b>
				<br /><br />
    		<form method="post" name="about" action="about.php" align="center">
				<textarea name="system_information" rows="10" cols="60" wrap="VIRTUAL">{$system_info}</textarea>
				<br />
				<input type="hidden" name="system_info_md5" value="{$system_info_md5}" />
				<input type="submit" name="action" value="Submit" />
				</form>
			</td>
          </tr>
		{if $first_run != 1}
		  <tr>
			<th>
				Credits
			</th>
          </tr>
          <tr>
			<td>
<pre>
{$credits}
</pre>
			</td>
          </tr>
        {/if}
        </tbody>
      </table>
    </div>
{include file="paglacl/footer.tpl"}

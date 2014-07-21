<% if $LoggedIn %>    
      <p>
      <% if not $Subscribed %>
	<a href="$SubscribeLink" class="SubscribeEmail">Subscribe to email notifications for this forum.</a>
      <% else %>
	You are subscribed to email notifications for this forum <br />
	<a href="$UnSubscribeLink"  class="UnSubscribeEmail">Click here to unsubcribe</a>
      <% end_if %>
       | 
       <a href="$Settings">Manage Subscriptions</a>
      </p>      
      <link rel="stylesheet" type="text/css" href="{$BaseHref}forum_subscribe/css/style.css">
<% end_if %>  
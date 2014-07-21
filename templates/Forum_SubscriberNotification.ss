<%--
<h3>TDG Forum Post Notification: <em>$Forum</em></h3>

<hr />
<table cellpadding="10px">
<tr>
<td bgcolor="#EEE">
<h4><a href="$AbsoluteLink" title="Go to the $Title page" class="$LinkingMode">$Title</a></h4>
<pre>
$Content
</pre>
<p>
<b><em>$Author</em></b>
</p>
<h5><a href="$AbsoluteLink" title="Go to the $Title page" class="$LinkingMode">Click here to reply to this post</a></h5>
</td>
</tr>
</table>


<hr />
<h6 style="font-size:0.8em;">NOTE: This is an automated email, please do not reply. You have received this email because you are subscribed to this forum ($Forum) or you are a TDG Forums Administrator.</h6>
--%>

<p>Hi $Recipient, </p>

<p>A new post '$Title.' has been added to <em>$Forum</em>  </p>

<pre>
$Content
</pre>


    <ul>
    <% if $Link %> <li><a href="$Link" title="Go to the $Title page" >View the topic</a></li> <% end_if %>
    <% if $UnsubscribeLink %> <li><a href="$UnsubscribeLink">Unsubscribe from the topic</a></li> <% end_if %>
    <% if $UnsubscribeLinkFromForum %> <li><a href="$UnsubscribeLinkFromForum">Unsubscribe from this forum</a></li> <% end_if %>
    </ul>

<p>Thanks,</p>
<p>The Forum Team.</p>

<p>NOTE: This is an automated email, any replies you make may not be read.</p>
<p>You have received this email because you are subscribed to this forum ($Forum)</p>
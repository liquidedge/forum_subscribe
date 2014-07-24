<h1>SilverStripe Forum subscriptions module</h1>

## Introduction

This module extends the Silverstripe Forum Module and allows logged-in users to subscribe to email notifications for each forum. This does not replace the existing Thread/Topic subscription system but creates an alternative way for users to keep up to date with forum activity on your website.

## Maintainer Contact

 * David Silvester (Nickname: davepolyester) <studio at liquidedge dot co dot nz>

## Requirements

 * SilverStripe 3.1

## Features

• A simple link on each forum page to subscribe to that forum.
• Manage Subscriptions page where users can manage all their forum subscriptions in one place.
• Users can choose to receive notification emails for all posts made to the forum or just when new threads are started. This is selectable on a forum-by-forum basis.
• Notification emails include the Title and Body of the Post plus a link to the Topic and a link to directly unsubscribe from the forum.
• Users do not receive email notifications for their own posts.
• Email notifications are not sent when a post is edited or moved.

## Installation

## Manual Installation

1. Download the file from the link above.
2. Expand the archive.
3. Place the folder in the root of your SilverStripe installation. 
4. Make sure folder is renamed 'forum_subscribe'.
5. Rebuild your database (see below).
6. If installation is successful you should see a new tab in your Forum Holder called 'Subscriptions' (see below).

## Rebuild database

Visit http://www.yoursite.com/dev/build/ in your browser.

## To show subscribe/unsubscribe links
Place the $SubscribeLink placeholder in ForumHeader.ss, just below the code line 66

	<% if Moderators %>
		<p>
			Moderators: 
			<% loop Moderators %>
				<a href="$Link">$Nickname</a>
				<% if not Last %>, <% end_if %>
			<% end_loop %>
		</p>
	<% end_if %>

	$SubscribeLink

*note 
you can also create a copy of ForumHeader.ss and place in theme folder

## Flush the cache
Also flush the cache http://www.yoursite.com/?flush=all in your browser.

## Settings
To set From and ReplyTo address of notification email, go to the 'Subscriptions' tab under the respective forum holder.

## Disclaimer
This module relies completely on the in-built email system within the SilverStripe core and has no provision for bulk email management such as batch processing etc. If your particular site has a large user base, we recommend that you check with your hosting provider to ensure that you do not exceed their limits or breach their policies around bulk emails and Spam.

## Credits and History
The original code and functionality for this module was based on Gordon Anderson's Forum Moderation Emails module (http://github.com/gordonbanderson/SilverstripeForumModerationEmails).
Gordon's module was significantly modified by David Silvester (www.liquidedge.co.nz) and combined with some seriously dirty hacking of the Forum Module to create a workable subscription and email notification system for a client's website.
Freelance developer Thomas Paulson was then contracted by David to rebuild this system as a proper module for the SS 3.1 platform. This has been released as version 0.1.






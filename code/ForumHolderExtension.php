<?php
class ForumHolderExtension extends DataExtension {
	private static $db = array(
		"FromEmail" => "Varchar(200)",
		"ReplyTo" => "Varchar(200)",
	);

	private static $defaults = array(
		"FromEmail" => "info@website.com",
		"ReplyTo" => "noreply@website.com",
	);
	
	public function updateCMSFields(FieldList $fields) {
	    $fields->addFieldToTab("Root.Subscriptions", new TextField("FromEmail", "From Email"));
	    $fields->addFieldToTab("Root.Subscriptions", new TextField("ReplyTo", "ReplyTo"));
	}
    
}

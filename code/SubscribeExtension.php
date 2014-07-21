<?php
/**
 * forum extension for enabling member subscription 
 *
 * @package forum_subscribe
 * 
 */
class SubscribeExtension extends DataExtension {

	
	private static $many_many = array(
		'Subscribers' => 'Member'		
	);
	
	/**
	  * print subscribe/unsubscribe link
	 */
	public function SubscribeLink() {	
		//Requirements::css('forum_subscribe/css/style.css');		
		$interface = new SSViewer('ForumSubscribe');		
		
		$controller = new SubscribeController();
		
		
		$loggedIn = (Member::currentUser())? true : false;
		
		$back_url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:false;
		
		return $interface->process(new ArrayData(array(
			'LoggedIn' 			=> $loggedIn,
			'Subscribed' 			=> $this->IsSubscribed(),
			'Parent'			=> $this->owner,						
			'SubscribeLink' 			=> $controller->Link('subscribe/'.$this->owner->ID),
			'UnSubscribeLink' 			=> $controller->Link('unsubscribe/'.$this->owner->ID),
			'Settings'			=> $controller->Link('settings').'?RedirectURL='.urlencode($back_url),
		)));
		
	}
	
	public function IsSubscribed(){
	
		$forum_id = $this->owner->ID;		
		$member_id = Member::currentUserID();
		
		return Forum_Subscribers::already_subscribed($forum_id,$member_id);		
	}
	
	
}//


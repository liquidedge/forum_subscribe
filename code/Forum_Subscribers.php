<?php
//
class Forum_Subscribers extends DataObject {

    private static $db = array(
    'Type' => 'varchar(20)',    
    );

    private static $has_one = array(
    'Forum' => 'Forum',
    'Member' => 'Member'
    );

	/**
	 * Checks to see if a Member is already subscribed to this thread
	 *
	 * @param int $forumID The ID of the forum to check
	 * @param int $memberID The ID of the currently logged in member (Defaults to Member::currentUserID())
	 * @return bool true if they are subscribed, false if they're not
	 */
	static function already_subscribed($forumID, $memberID = null) {
		if(!$memberID) $memberID = Member::currentUserID();
		$SQL_forumID = Convert::raw2sql($forumID);
		$SQL_memberID = Convert::raw2sql($memberID);
 		
		if(DB::query("SELECT ID FROM Forum_Subscribers WHERE `ForumID` = '$SQL_forumID' AND `MemberID` = '$SQL_memberID'")->value()) {
			return true;
		} else {
			return false;
		}
	}

}
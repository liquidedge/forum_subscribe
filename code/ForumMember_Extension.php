<?php
//
class ForumMember_Extension extends DataExtension{

	/**
	* Belongs many many relations for Forum
	*
	* @var Array
	*/
	private static $belongs_many_many = array(
	'Forums' => 'Forum'
	);

}
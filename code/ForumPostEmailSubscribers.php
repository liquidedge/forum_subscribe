<?php
class ForumPostEmailSubscribers extends DataExtension
{
    
    
    public function onAfterWrite()
    {
        // if new post
      if ($this->owner->LastEdited == $this->owner->Created) {
          $this->notifySubscribers();
      }
    
        parent::onAfterWrite();
    }
    
    /*
    function onBeforeWrite() {
      // check if this new post
      if(!$this->owner->ID){	      
          
          $this->notifySubscribers();
          
          
      }	
      parent::onBeforeWrite();	  	      	 
    }
    */

    
    /**
     * Send email to subscribers, notifying them the thread has been created or post added.
     */
    public function notifySubscribers()
    {
        // all members id except current user
        $member_id= Member::currentUserID();
        $list = DataObject::get(
            "Forum_Subscribers",
            "\"ForumID\" = '". $this->owner->ForumID ."' AND \"MemberID\" != '$member_id'"
        );
        
        if ($list) {
            foreach ($list as $obj) {
                $SQL_id = Convert::raw2sql((int)$obj->MemberID);

                // Get the members details
                $member = DataObject::get_one("Member", "\"Member\".\"ID\" = '$SQL_id'");
                
                  
                if ($member) {
                    //error_log("email sent ".$member->Email);
                    $type = $obj->Type;
                    switch ($type) {
                      // send all email notification
                      case 'all':
                          $this->createEmail($member);
                        break;
                      // send new thread only email notification  
                      case 'thread':
                        //if($this->owner->isFirstPost()){
                          $this->createEmail($member);
                        //}
                        break;
                      //  
                      default:
                        break;
                    }
                }
            }
        }
    }
    
    //CREATE THE FORUM NOTIFICATION EMAIL
    public function createEmail($member)
    {
    
        //error_log("LOG MESSAGE FROM FORUM EMAIL POST DECORATOR LINK IS ".$this->owner->AbsoluteLink());

        $controller = new SubscribeController();
        
        $email = new Email();
        
        $from_email = $this->owner->Forum()->parent()->FromEmail;
        $email->setFrom($from_email);
        
        $reply_to = $this->owner->Forum()->parent()->ReplyTo;
        $email->addCustomHeader('Reply-To', $reply_to);
        
        $email->setTo($member->Email);
        $config = SiteConfig::current_site_config();
        $email->setSubject($this->owner->Title . ' | '. $config->Title .' '. $this->owner->Forum()->Title . ' Forum');
        $email->setTemplate('Forum_SubscriberNotification');
        $email->populateTemplate(array(
            'Recipient' => $member->FirstName,
            'Link' => $this->owner->Link(),
            'Title' => $this->owner->Title,
            'Content' => $this->owner->Content,
            'Author' => $this->owner->Author()->Nickname,
            'Forum' => $this->owner->Forum()->Title,
            /* 'UnsubscribeLink' => Director::absoluteBaseURL() . $this->owner->Forum()->Link() . 'unsubscribe/' . $this->owner->ID, */
            'UnsubscribeLinkFromForum' => Director::absoluteBaseURL() . $controller->Link('unsubscribe/'.$this->owner->ForumID),

        ));
        $email->send();
    }
}

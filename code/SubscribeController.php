<?php
/**
 * forum member subscription controller
 *
 * @package forum_subscribe
 */
class SubscribeController extends Page_Controller
{

    private static $allowed_actions = array(
        'subscribe',
        'unsubscribe',
        'settings',
        'SettingsForm'
    );
        
    /**
     * Workaround for generating the link to this controller
     *
     * @return string
     */
    public function Link($action = "", $id = '', $other = '')
    {
        return Controller::join_links(__CLASS__, $action, $id, $other);
    }
    
    public function subscribe()
    {
        $forumID = $this->urlParams['ID'];
        if (Member::currentUser() && !Forum_Subscribers::already_subscribed($forumID)) {
            $obj = new Forum_Subscribers();
            $obj->ForumID = $forumID;
            $obj->MemberID = Member::currentUserID();
            $obj->Type = "all";
            //$obj->LastSent = date("Y-m-d H:i:s"); // The user was last notified right now
            $obj->write();
        }
        return  $this->redirectBack();
        ;
    }

    public function unsubscribe()
    {
        $forumID = $this->urlParams['ID'];
        $memberID = Member::currentUserID();
        
        if (Member::currentUser() && Forum_Subscribers::already_subscribed($forumID)) {
            $SQL_topicID = Convert::raw2sql($forumID);
            $SQL_memberID = Convert::raw2sql($memberID);
        
            $query = "DELETE FROM Forum_Subscribers WHERE `ForumID` = '$SQL_topicID' AND `MemberID` = '$SQL_memberID'";
            
            DB::query($query);
        }
        return  $this->redirectBack();
        ;
    }
    
    public function settings()
    {
        //return array();
      $form = $this->SettingsForm();
      
      
        $data = array(
          'Form' => $form,
          );
          
        return $this->customise($data)->renderWith(array('Settings', 'Page'));
    }
    
    public function SettingsForm()
    {
        $form = new SettingsForm($this, 'SettingsForm');
      
        $member_id = Member::currentUserID();
        $back_url = isset($_POST['RedirectURL'])?$_POST['RedirectURL']:$_GET['RedirectURL'];
        $form->loadDataFrom(array(
        "MemberID" => $member_id,
        "RedirectURL" => $back_url,
        ));
        return $form;
    }
}

// class SettingsForm
class SettingsForm extends Form
{
 
    public function __construct($controller, $form_name)
    {
        $notify_type = new ListboxField("Type[]", "Select notification type",
      $source = array(
          "all" => "All post",
          "newthread" => "New thread",
      ),
      $value = 'all'
    );
        $fields = new FieldList(
        CheckboxField::create("Forum[]", 'Forum'),
            $notify_type,
            HiddenField::create('MemberID'),
            HiddenField::create('RedirectURL')
        );
 
 
        //$actions = new FieldList( FormAction::create("doSubmit")->setTitle("Apply"), FormAction::create("doCancel")->setTitle("Go Back"), FormAction::create("doSaveNExit")->setTitle("Save & Exit") );
        $actions = new FieldList(FormAction::create("doSaveNExit")->setTitle("Save & Exit"));
        
        parent::__construct($controller, $form_name, $fields, $actions);
    }
     
     

    public function doSaveNExit(array $data, Form $form)
    {
        //echo '<pre>';print_r($data);  exit();      

        $member_id = Convert::raw2sql($data['MemberID']);
        $query = "DELETE FROM Forum_Subscribers WHERE `MemberID` = '$member_id'";
    
        DB::query($query);
    
        $types = $data['Type'];
    
        if (isset($data['Forum'])) {
            foreach ($data['Forum'] as  $forum_id) {
                //print $data['Type[\''.$forum_id.'\']'];
        $subscription_entry = new Forum_Subscribers();
                $subscription_entry->ForumID =  Convert::raw2sql($forum_id);
                $subscription_entry->MemberID =  $member_id;
                $type = Convert::raw2sql($types[$forum_id]);
                $subscription_entry->Type = $type;
                $subscription_entry->write();
            }
        }
        $url = $data['RedirectURL'];
        return Controller::curr()->redirect($url);
    }

    public function doSubmit(array $data, Form $form)
    {
        //echo '<pre>';print_r($data);  exit();      

        $member_id = Convert::raw2sql($data['MemberID']);
        $query = "DELETE FROM Forum_Subscribers WHERE `MemberID` = '$member_id'";
    
        DB::query($query);
    
        $types = $data['Type'];
    
        if (isset($data['Forum'])) {
            foreach ($data['Forum'] as  $forum_id) {
                //print $data['Type[\''.$forum_id.'\']'];
        $subscription_entry = new Forum_Subscribers();
                $subscription_entry->ForumID =  Convert::raw2sql($forum_id);
                $subscription_entry->MemberID =  $member_id;
                $type = Convert::raw2sql($types[$forum_id]);
                $subscription_entry->Type = $type;
                $subscription_entry->write();
            }
        }
    
        Controller::curr()->redirectBack();
    }
    
    public function doCancel(array $data, Form $form)
    {
        $url = $data['RedirectURL'];
        return Controller::curr()->redirect($url);
    }
     
    public function forTemplate()
    {
        $forums = $this->ListForums();
        $data = array('ListForums'=>$forums);
    
        return $this->customise($data)->renderWith(array($this->class, 'Form'));
    }
    
    public function ListForums()
    {
        $forum_holders = ForumHolder::get();
        return $forum_holders;
    }
    
    
    public function IsSubscribed($forum_id, $member_id)
    {
        $forum = Forum_Subscribers::get()
    ->filter(array('MemberID' => $member_id,
        'ForumID' => $forum_id,
    ))->First();
    
        if ($forum) {
            return true;
        } else {
            return false;
        }
    }
    
    //return all/thread
    public function Type($forum_id, $member_id)
    {
        $type = DB::query('SELECT Type FROM Forum_Subscribers WHERE `ForumID` = '.$forum_id.' and `MemberID` = '.$member_id)->value();
        return $type;
    }
}

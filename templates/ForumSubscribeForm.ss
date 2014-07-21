<form $FormAttributes>
    <% if $Message %>
        <p id="{$FormName}_error" class="message $MessageType">$Message</p>
    <% else %>
        <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
    <% end_if %>
     
    
    
	<% loop $ListForums %>
	<fieldset>
	
	  <h3>$Title</h3>
	  
	  <% loop $Forums %>	  
	    <div class="field forum">
	      <input type="checkbox" name="Forum[]" value="$ID" <% if $Top.IsSubscribed($ID, $CurrentMember.ID) %>checked="checked"<% end_if %> /> $Title		
	    </div>
	  
	  <% end_loop %>  
	  
	  </fieldset>
	  
	<% end_loop %>
	
        $Fields.dataFieldByName(MemberID)
        
        $Fields.dataFieldByName(SecurityID)        
    
    
    
     
    <% if $Actions %>
    <div class="Actions">
        <% loop $Actions %>$Field<% end_loop %>
    </div>
    <% end_if %>
    
</form>
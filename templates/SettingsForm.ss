<form $FormAttributes>
    <% if $Message %>
        <p id="{$FormName}_error" class="message $MessageType">$Message</p>
    <% else %>
        <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
    <% end_if %>
     
    
    
	<% loop $ListForums %>
	
	  <fieldset>
	
	  <h3>$Title</h3>
	  
	  <% loop Forums %>	  
	    
	    <div class="line field forum">
	    
	      <div class="unit size1of2">
	      <input type="checkbox" name="Forum[]" value="$ID" <% if $Top.IsSubscribed($ID, $CurrentMember.ID) %>checked="checked"<% end_if %> /> $Title		
	      </div>
	      
	      <div class="unit size1of2 lastUnit">   	     
	     
	      <select name="Type[$ID]">	      
		<option value="all" <% if $Top.Type($ID, $CurrentMember.ID) == "all" %>selected="selected"<% end_if %> > All posts </option>
		<option value="thread" <% if $Top.Type($ID, $CurrentMember.ID) = "thread" %>selected="selected"<% end_if %> > New threads only</option>
	      </select>
	      
	      </div>
	      
	    </div>
	  
	  <% end_loop %>  
	  
	  </fieldset>
	  
	<% end_loop %>
	
        $Fields.dataFieldByName(MemberID)
        $Fields.dataFieldByName(RedirectURL)
        $Fields.dataFieldByName(SecurityID)        
    
    
    
     
    <% if $Actions %>
    <div class="Actions">
        <% loop $Actions %>$Field<% end_loop %>
    </div>
    <% end_if %>
    
</form>
<form $FormAttributes>
    <% if $Message %>
        <p id="{$FormName}_error" class="message $MessageType">$Message</p>
    <% else %>
        <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
    <% end_if %>
     
     <fieldset>
    
        <div id="Type" class="field type">
            <label class="left" for="{$FormName}_Type">Select notification type</label>
            $Fields.dataFieldByName(Type)
            <% if $Message %>
            <span id="{$FormName}_error" class="message $Fields.dataFieldByName(Type).MessageType">
                $Fields.dataFieldByName(Type).Message
            </span>
            <% end_if %>
        </div>
     </fieldset> 
     
        $Fields.dataFieldByName(MemberID)
        
        $Fields.dataFieldByName(SecurityID)        
    
    
    
     
    <% if $Actions %>
    <div class="Actions">
        <% loop $Actions %>$Field<% end_loop %>
    </div>
    <% end_if %>
    
</form>
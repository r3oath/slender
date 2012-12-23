<script type="text/template" id="tagTemplate">
    <div class="grid_6 tag-container">
        <div class="grid_5 alpha">
            <div class="tag-header">
                <i class="icon-location"></i>                 
                <%= name %>
                <span class="delete-tag"><i class="icon-cancel"></i></span> 
            </div>
            <div class="tag-desc">
                <%= description %>
            </div>
        </div>
        <div class="grid_1 omega">
            <div class="tag-type">
                <i class="icon-tag"></i> <%= type %>
            </div>
        </div>                   
    </div>
</script>

<script type="text/template" id="tagTemplateNew">
    <div class="grid_6 tag-container tag-new-container">                
        <div class="grid_5 alpha">                    
            <div class="tag-header">
                <i class="icon-plus"></i>
                <%= name %>         
                <span class="delete-tag"><i class="icon-cancel"></i></span>
            </div>
            <div class="tag-desc">
                <%= description %>
            </div>
        </div>
        <div class="grid_1 omega">
            <div class="tag-type">
                <i class="icon-tag"></i> <%= type %>
            </div>
        </div>                   
    </div>
</script>

<script type="text/template" id="editTagTemplate">
    <div class="grid_10">        
        <span class="edit-tag-name">
            <i class="icon-location"></i> <%= name %>
        </span>
        <span class="edit-tag-desc">
            <%= description %>
        </span>
    </div>
    <div class="grid_2 edit-tag-type">
        <i class="icon-tag"></i> <%= type %>
    </div>
    <div class="grid_12">
        <textarea id="markitup" class="markitup-editor"><%= contents %></textarea>
    </div>
    <div class="grid_12 light-text">
        This content is located at <a href="<%= page %>" target="_blank"><%= page %></a>
    </div>
    <div class="grid_12 edit-save-tag">
        <button id="save-tag"><i class="icon-upload-cloud"></i> Save Tag</button>
    </div>
</script>

<script type="text/template" id="editImageTagTemplate">
    <div class="grid_10">        
        <span class="edit-tag-name">
            <i class="icon-location"></i> <%= name %>
        </span>
        <span class="edit-tag-desc">
            <%= description %>
        </span>
    </div>
    <div class="grid_2 edit-tag-type">
        <i class="icon-tag"></i> <%= type %>
    </div>
    <div class="grid_12 edit-image-tag">
        <img src="<%= contents %>" alt="<%= alt %>">
    </div>
    <div class="grid_6 edit-tag-name">
        Image Location
    </div>
    <div class="grid_6 edit-tag-name">
        Alternative Text (Optional)
    </div>
    <div class="grid_6">
        <input type="text" id="image-contents" class="input-box" required="required" value="<%= contents %>">
    </div>
    <div class="grid_6">
        <input type="text" id="image-alt" class="input-box" required="required" value="<%= alt %>">
    </div>
    <div class="grid_12 light-text">
        This content is located at <a href="<%= page %>" target="_blank"><%= page %></a>
    </div>
    <div class="grid_12 edit-save-tag">
        <button id="save-tag"><i class="icon-upload-cloud"></i> Save Tag</button>
    </div>
</script>
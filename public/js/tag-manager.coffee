# --------------------------------------------------------------------------
# Backbone Tag Management
# --------------------------------------------------------------------------

# Global namespacing
window.App = 
    Models: {}
    Views: {}
    Collections: {}
    Router: {}
    RouteFuncs: {}
    Actions: {}

# Events helper
window.vent = _.extend {}, Backbone.Events

# Template helper
window.template = (id) -> return _.template $('#' + id).html();

# Various jQuery Tag related selections
tagArea = $ '#tag-area'
statusBar = $ '#status-bar'
updatedTagNotice = $ '#updated-tag-notice'

# --------------------------------------------------------------------------
# Backbone Class Definitions
# --------------------------------------------------------------------------

class App.Models.Tag extends Backbone.Model
    urlRoot: 'tags'
    defaults: 
        'contents': ''
        'alt': ''
        'description': ''
        'type': ''
        'error': ''

class App.Views.Tag extends Backbone.View
    events:
        'click': 'tagClicked'
        'click .delete-tag': 'deleteMe'
    tagClicked: ->
        window.vent.trigger 'gotoEditTag', @model.get 'id'
    deleteMe: (e) ->
        e.stopImmediatePropagation()
        if confirm('This will delete the tag and/or reset its contents.') is true
            @$el.fadeOut()
            @model.destroy()
    template: template 'tagTemplate'
    render: ->
        @$el.html @template @model.toJSON()
        return @

class App.Views.NewTag extends Backbone.View
    events:
        'click': 'tagClicked'
        'click .delete-tag': 'deleteMe'
    tagClicked: ->
        window.vent.trigger 'gotoEditTag', @model.get 'id'
    deleteMe: (e) ->
        e.stopImmediatePropagation()
        alert 'Deleted tag'
    template: template 'tagTemplateNew'
    render: ->
        @$el.html @template @model.toJSON()
        return @

class App.Views.Tags extends Backbone.View
    render: ->
        @collection.each @addOne, @
        return @
    addOne: (tag) ->
        if tag.get('enabled') is 1
            modelView = new App.Views.Tag model: tag
        else
            modelView = new App.Views.NewTag model: tag
        @$el.append modelView.render().el

class App.Views.EditTag extends Backbone.View
    events:
        'click #save-tag': 'saveTag'
    saveTag: ->
        $('#save-tag').attr 'disabled', 'disabled'
        @model.set 'contents', $('#markitup').val()
        @model.set 'enabled', 1
        @model.save()
        window.vent.trigger 'gotoUpdatedTags'
    template: template 'editTagTemplate'
    render: ->
        @$el.html @template @model.toJSON()
        return @

class App.Views.EditImageTag extends Backbone.View
    events:
        'click #save-tag': 'saveTag'
    saveTag: ->   
        $('#save-tag').attr 'disabled', 'disabled'     
        @model.set 'contents', $('#image-contents').val()
        @model.set 'alt', $('#image-alt').val()
        @model.set 'enabled', 1
        @model.save()
        window.vent.trigger 'gotoUpdatedTags'
    template: template 'editImageTagTemplate'
    render: ->
        @$el.html @template @model.toJSON()
        return @

class App.Collections.Tags extends Backbone.Collection
    model: App.Models.Tag
    url: 'tags'

class App.Router extends Backbone.Router
    initialize: ->
        window.vent.on 'gotoEditTag', @gotoEditTag, @
        window.vent.on 'gotoUpdatedTags', @gotoUpdatedTags, @
        window.vent.on 'gotoShowTags', @gotoShowTags, @
    routes:
        '': 'showTags'
        'edit/:id': 'editTag'
    gotoUpdatedTags: ->
        @navigate ''
        @updatedTags()
    updatedTags: ->
        SetStatusBar('Displaying all Tags')
        ToggleTagArea ShowTagCallback 1
    gotoShowTags: ->
        @navigate '', trigger: true
    showTags: ->
        SetStatusBar('Displaying all Tags')
        ToggleTagArea ShowTagCallback()
    gotoEditTag: (id) ->
        @navigate 'edit/' + id, trigger: true
    editTag: (id) ->
        SetStatusBar('Editing Tag ID: ' + id)
        ToggleTagArea EditTagCallback id

# --------------------------------------------------------------------------
# Various Actions
# --------------------------------------------------------------------------

ToggleTagArea = (callback = ->) ->
    tagArea.stop(true, true).animate height: 'toggle', opacity: 'toggle', callback

SetStatusBar = (status) ->
    statusBar.html status

ShowTagCallback = (updated = 0) ->
    Tags = new App.Collections.Tags;
    Tags.fetch
        success: ->
            if Tags.length is 0
                tagArea.html '<div class="error">There are currently no tags available. Start tagging!<div>'
                ToggleTagArea()
            else
                TagsView = new App.Views.Tags collection: Tags
                tagArea.html TagsView.render().el
                ToggleTagArea()
                if updated is 1
                    updatedTagNotice.fadeIn().delay(2000).fadeOut()

EditTagCallback = (id) ->
    Tag = new App.Models.Tag
    Tag.set 'id', id
    Tag.fetch
        success: ->
            if Tag.get('error') isnt ''
                tagArea.html '<div class="error">' + Tag.get('error') + '<div>'
                ToggleTagArea()
            else
                if Tag.get('type') isnt 'image'
                    TagView = new App.Views.EditTag model: Tag
                    tagArea.html TagView.render().el
                    if Tag.get('type') is 'html'
                        $("#markitup").markItUp mySettings
                else
                    TagView = new App.Views.EditImageTag model: Tag
                    tagArea.html TagView.render().el
                ToggleTagArea()

# --------------------------------------------------------------------------
# Run various Backbone tasks
# --------------------------------------------------------------------------

new App.Router;
Backbone.history.start()
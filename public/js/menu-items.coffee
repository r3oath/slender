$ ->    
    $('#menu-delete-tags').live 'click', ->
        $('.delete-tag').fadeToggle()

    $('#menu-reset-filters').live 'click', ->
        $('#search-bar').val('')
        window.vent.trigger 'gotoShowTags'
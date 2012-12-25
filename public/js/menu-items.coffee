$ ->  
    tooltipBox = $('#tooltip-box')
    filterTypeBox = $('#filter-tags-list')

    $('#menu-delete-tags').on 'click', ->
        $('.delete-tag').fadeToggle()

    $('#menu-reset-filters').on 'click', ->
        resetAllFilters()
        $('#search-bar').val('')
        window.vent.trigger 'gotoShowTags'

    $('#menu-filter-tags').on 'click', ->
        tooltipBox.hide()
        filterTypeBox.toggle()

    # Filter Types

    filterTypeBox.children('span').on 'click', ->
        if $(@).hasClass('active') isnt true
            resetAllFilters()
            $(@).addClass 'active'
            window.vent.trigger 'gotoFilterTags', $(@).data 'type'

    resetAllFilters = ->
        filterTypeBox.children('span').removeClass 'active'
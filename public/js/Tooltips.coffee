$ ->
    tooltipBox = $('#tooltip-box')
    tooltipItems = $('.tooltip')

    OFFSET = 12

    tooltipItems.live 'mouseover', ->
        tooltipBox.html $(@).data 'tooltip'
        tooltipBox.show()

    tooltipItems.live 'mouseout', ->
        tooltipBox.hide()

    tooltipItems.live 'mousemove', (e) ->
        tooltipBox.css 'top' : (e.pageY + OFFSET)
        tooltipBox.css 'left' : (e.pageX + OFFSET)
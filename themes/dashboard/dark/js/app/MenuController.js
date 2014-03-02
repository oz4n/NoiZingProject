var MenuController = (function(MenuController) {

    var menu_updatesort = function(jsonstring) {
        $.ajax({
            url: 'test',
            type: 'post',
            dataType: 'json',
            data: {data: jsonstring},
            succses: function() {
                
            }

        });
    };
    var updateOutput = function(e)
    {
        var list = e.length ? e : $(e.target),
                output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));
            menu_updatesort(window.JSON.stringify(list.nestable('serialize')));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    var menuBuilder = function() {
        $('#nestable').nestable({group: 1}).on('change', updateOutput);       
        updateOutput($('#nestable').data('output', $('#nestableMenu-output')));
    };
    
    var menuActive = function() {
        $('ul.nav > li.more-list').addClass('active');
        $('ul.dropdown-menu > li.appearance-list').addClass('active');
        $('ul.dropdown-menu > li > a.menu-list').parent().addClass('active');
    };

    return {
        init: function() {
            menuActive();
            menuBuilder();
        }
    };
}(MenuController || {}));
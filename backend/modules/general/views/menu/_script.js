//$('#parent_name').autocomplete({
//    source: function (request, response) {
//        var result = [];
//        var limit = 10;
//        var term = request.term.toLowerCase();
//        $.each(_opts.menus, function () {
//            var menu = this;
//            if (term == '' || menu.name.toLowerCase().indexOf(term) >= 0 ||
//                (menu.parent_name && menu.parent_name.toLowerCase().indexOf(term) >= 0) ||
//                (menu.route && menu.route.toLowerCase().indexOf(term) >= 0)) {
//                result.push(menu);
//                limit--;
//                if (limit <= 0) {
//                    return false;
//                }
//            }
//        });
//        response(result);
//    },
//    focus: function (event, ui) {
//        $('#parent_name').val(ui.item.name);
//        return false;
//    },
//    select: function (event, ui) {
//        $('#parent_name').val(ui.item.name);
//        $('#parent_id').val(ui.item.id);
//        return false;
//    },
//    search: function () {
//        $('#parent_id').val('');
//    }
//}).autocomplete("instance")._renderItem = function (ul, item) {
//    return $("<li>")
//        .append($('<a>').append($('<b>').text(item.name)).append('<br>')
//            .append($('<i>').text(item.parent_name + ' | ' + item.route)))
//        .appendTo(ul);
//};
//
//$('#route').autocomplete({
//    source: _opts.routes,
//});
//alert(_opts.menus.toSource());
//var result = [];
//$.each(_opts.menus, function () {
//    var menu = this;
//    if (term == '' || menu.name.toLowerCase().indexOf(term) >= 0 ||
//            (menu.parent_name && menu.parent_name.toLowerCase().indexOf(term) >= 0) ||
//            (menu.route && menu.route.toLowerCase().indexOf(term) >= 0)) {
//        result.push(menu);
//        limit--;
//        if (limit <= 0) {
//            return false;
//        }
//    }
//});
//

var result = [];
var term = $("#name").val();
var indice = 0;
console.log(term);
$.each(_opts.menus, function (index, menu) {
    if (term != menu.name)
    {
        result[indice] = {id: menu.id, name: menu.name};
        indice++;
    }
});
console.log(result);
$('#parent_name').typeahead({
    items: 10,
    source: result,
    source: function (request, response) {
        var result = [];
        var limit = 10;
        var term = request.toString().toLowerCase();

        $.each(_opts.menus, function () {
            var menu = this;
            if (term == '' || menu.name.toLowerCase().indexOf(term) >= 0 ||
                (menu.parent_name && menu.parent_name.toLowerCase().indexOf(term) >= 0) ||
                (menu.route && menu.route.toLowerCase().indexOf(term) >= 0))
            {

                result.push(menu);
                limit--;
                if (limit <= 0) {
                    return false;
                }
            }
        });
        response(result);
    },
    autoSelect: false,
    afterSelect: function (obj) {
        if (obj) {
            $('#parent_id').val(obj.id);
        }
    }
});

var source = [];
$.each(_opts.routes, function (index, value) {
    source[index] = {id: value, name: value};
});

$("#route").typeahead({
    source: source,
    autoSelect: false
});


$("#icono").keyup(function () {
    $("#fa-icono").html('<i class="fa fa-' + $(this).val() + '"></i>');
});
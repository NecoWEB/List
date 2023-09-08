$(document).ready(function(){
    $(document).on('click', '#new-product-button', function(e){
        $('.add-product').toggle();
    });

    $(document).on('click', '.product-remove', function(e){
        var target = $(this).attr('id');
        var remove = $("table tr." + target);
        $.ajax({
            type: "POST",
            url: '/nemanja_kosanovic/config/removeProduct.php',
            data: {id: target},
            success: function (data) {
                remove.hide('slow', function(){ remove.remove(); });
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    });

    $(document).on('click', '.remove-list', function(e){
        var target = $(this).attr('id');
        var remove = $(".view-a-list table tr." + target);
        $.ajax({
            type: "POST",
            url: '/nemanja_kosanovic/config/removeList.php',
            data: {id: target},
            success: function (data) {
                remove.hide('slow', function(){ remove.remove(); });
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    });

    $(document).on('click', '.view_list', function(e){
        var target = $(this).attr('id');
        location.href = '/nemanja_kosanovic/checkList.php?id_list=' + target;
    });

    

    $(document).on('click', '.product-remove-from-list', function(e){
        var rowCount = $('.productsInAList table tr').length;
        if(rowCount == 2) {
            $('.productsList').hide();
        }
        var target = $(this).attr('id');
        add = $(".productsInAList table tr." + target).remove();
        
    });

    $(document).on('click', '.product-add-to-list', function(e){
        target = $(this).attr('id');
        name_value = $(this).attr('data-name');
        add = $("table tr." + target).clone();

        $("<tr class=" + target + " data-prod='existing_item'><td>" + target + "</td><td>" + name_value + "</td><td><span id="+target+" class='product-remove-from-list btn btn-danger'>Remove</span></td></tr>").insertAfter(".product-list-header-items")
        $('.productsList').show();
        
    });
});

function addProduct() {
    var name = $('#list_name_input').val();
    $.ajax({
        type: "POST",
        url: '/nemanja_kosanovic/config/addProduct.php',
        data: {name: name},
        success: function (data) {
            var $ajaxMessage = $(".ajax-message");
            var $ajaxList = $(".product-list");
            $ajaxMessage.removeClass("alert alert-success alert-danger");
            $ajaxMessage.html('');
    
            // append product
            try {
                var response_data = JSON.parse(data);
                $('#list_name_input').val("");
    
                if (response_data['errors'] && response_data['errors'].length !== 0) {
                    $ajaxMessage.addClass("alert alert-danger");
                    var errorsList = "<ul>";
                    $.each(response_data['errors'], function (index, error) {
                        errorsList += "<li>" + error + "</li>";
                    });
                    errorsList += "</ul>";
                    $ajaxMessage.append(errorsList);
                } else {
                    $ajaxMessage.addClass("alert alert-success");
                    $ajaxMessage.append("<p>" + response_data['message'] + "</p>");

                    $("<tr class=" + response_data['id'] + "><td>" + response_data['id'] + "</td><td>" + name + "</td><td><span id="+response_data['id']+" class='product-add-to-list btn btn-success'>Add</span></td><td><span id="+response_data['id']+" class='product-remove btn btn-danger'>Remove</span></td></tr>").insertAfter(".product-list-header");
                }
            } catch (e) {
                // Handle the case where the response is not valid JSON
                $ajaxMessage.addClass("alert alert-success");
                $ajaxMessage.append("<p>" + data + "</p>");
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr);
        }
    });
}

function createList() {
    var name = $('#list_name').val();
    var date = $('#purchase_day').val();
    var desc = $('#description').val();
    var products = [];

    $('.productsInAList table tr').each(function() {
        if($.isNumeric($(this).attr('class'))) {
            products.push($(this).attr('class'));
        }
    });
    $.ajax({
        type: "POST",
        url: '/nemanja_kosanovic/config/createList.php',
        data: {
            name: name,
            date: date,
            desc: desc,
            products: products
        },
        success: function (data) {
            console.log(data);
            location.href = data;
        },
        error: function (xhr, status, error) {
            console.error(xhr);
        }
    });
}

function finishList(id_list)  {
    if($('.checkListBox:checked').length == $('.checkListBox').length) {
        $.ajax({
            type: "POST",
            url: '/nemanja_kosanovic/config/finishList.php',
            data: {
                id_list: id_list
            },
            success: function (data) {
                location.href = data;
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    }
}


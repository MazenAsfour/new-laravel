$(document).ready(function () {
    console.log('clicked');
    $('.food_menu_nav a').on('click', function (e) {
        e.preventDefault();

        // Retrieve the categoryId from the clicked element
        var categoryId = $(this).attr('id').split('-')[0];
      
        var tabs = $('.tab-pane').removeClass('active');

        var activeTab = $('#' + categoryId);
        activeTab.addClass('active');            
        $.ajax({
            url: '/get-products/' + categoryId,
            type: 'GET',
            success: function (data) {
                
                console.log('Data received:', data);
                var productsContainer = $('#products-container-' + categoryId);
                productsContainer.empty();
                console.log('Container emptied:', productsContainer);


                // Append new products to the container
                $.each(data, function (index, product) {
                    console.log('Appending product:', product);

                    var productHtml = '<div class="col-sm-6 col-lg-6">' +
                        '<div class="single_food_item media">' +
                        '<img src="' + product.image_path + '" class="mr-3" alt="...">' +
                        '<div class="media-body align-self-center">' +
                        '<h3>' + product.name + '</h3>' +
                        '<p>' + product.description + '</p>' +
                        '<h5>$' + product.price + '</h5>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    productsContainer.append(productHtml);
                });
            },
            error: function (error) {
                console.log('Error fetching products: ' + error);
            }
        });
    });
});

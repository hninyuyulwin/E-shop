$(document).ready(function () {
    loadCount();
    loadWishlist();


    function loadCount() {
        $.ajax({
            method: 'GET',
            url: "/cart-count",
            success : function(response)
            {
                $(".cart-count").html("");
                $(".cart-count").html(response.count);
            }
        });
    }

    function loadWishlist() {
        $.ajax({
            method: 'GET',
            url: "/wishlist-count",
            success: function (response) {
                $(".wishlist-count").html("");
                $(".wishlist-count").html(response.count);
            }
        });
    }
});

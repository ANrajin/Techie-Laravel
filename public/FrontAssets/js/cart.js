$(document).ready(function() {
    $(".item_delete").on("click", function() {
        var id = $(this).data("id");

        $.ajax({
            url: "/remove-cart-item/" + id,
            method: "GET",
            success: function(data) {
                location.reload(true);
            }
        });
    });
});

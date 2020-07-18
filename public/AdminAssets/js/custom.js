$(document).ready(function() {
    "use strict";

    $("#datatable1").DataTable({
        responsive: true,
        serverside: true,
        language: {
            searchPlaceholder: "Search...",
            sSearch: "",
            lengthMenu: "_MENU_ items/page"
        }
    });
    // Select2
    $(".dataTables_length select").select2({
        minimumResultsForSearch: Infinity
    });

    //fetch selected category's data
    $(".category").on("click", function() {
        var id = $(this).attr("data-id");

        $.ajax({
            url: "categories/" + id,
            method: "GET",
            dataType: "json",
            success: function(data) {
                $("#cId").val(data.id);
                $("#cNameEdit").val(data.name);
                $("#pCategoryEdit").val(data.parent_id);
                $("#statusEdit").val(data.status);

                $("#category").modal("show");
            }
        });
    });

    //fetch selected brand's data
    $(".brand").on("click", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: "brands/" + id,
            method: "GET",
            dataType: "json",
            success: function(data) {
                $("#bId").val(data.id);
                $("#brandEdit").val(data.name);
                $("#detailsEdit").val(data.details);

                $("#brand").modal("show");
            }
        });
    });

    //delete category via bootbox
    $(".cat_delete").on("click", function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var parentid = $(this).attr("data-parentId");

        if (parentid == 1) {
            bootbox.confirm(
                "Deleting a root category will also delete its associate categories",
                function(confirmed) {
                    if (confirmed) {
                        $.ajax({
                            url: "categories/" + id,
                            method: "DELETE",
                            data: {
                                //set csrf token in meta tag for resource route
                                _token: $('meta[name="csrf-token"]').attr(
                                    "content"
                                )
                            },
                            success: function(data) {
                                location.reload(true);
                            }
                        });
                    }
                }
            );
        } else {
            bootbox.confirm("Are your sure to delete?", function(confirmed) {
                if (confirmed) {
                    $.ajax({
                        url: "categories/" + id,
                        method: "DELETE",
                        data: {
                            //set csrf token in meta tag for resource route
                            _token: $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function(data) {
                            location.reload(true);
                        }
                    });
                }
            });
        }
    });

    //delete brand via bootbox
    $(".br_delete").on("click", function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");

        bootbox.confirm("Are your sure to delete?", function(confirmed) {
            if (confirmed) {
                $.ajax({
                    url: "brands/" + id,
                    method: "DELETE",
                    data: {
                        //set csrf token in meta tag for resource route
                        _token: $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(data) {
                        location.reload(true);
                    }
                });
            }
        });
    });

    //delete products via bootbox
    $(".p_delete").on("click", function(e) {
        e.preventDefault();

        var del = $(this).attr("href");
        bootbox.confirm("Are your sure to delete?", function(confirmed) {
            if (confirmed) {
                window.location.href = del;
            }
        });
    });

    //fetch data to edit product
    $(".edit_product").on("click", function() {
        var id = $(this).data("id");

        if (!id == "") {
            $.ajax({
                url: "products/" + id + "/edit",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $("input[name=id]").val(data.id);
                    $("input[name=Edit_sku]").val(data.product_sku);
                    $("input[name=Edit_pName]").val(data.product_name);
                    $("#Edit_pCat").val(data.category_id);
                    $("#Edit_pBrand").val(data.brand_id);
                    $("input[name=Edit_pQty]").val(data.quantity);
                    $("input[name=Edit_pPrice]").val(data.price);
                    $("#Edit_featured").val(data.is_featured);
                    $("#Edit_status").val(data.status);
                    $("#Edit_summernote").summernote("code", data.details);
                    $("#editProduct").modal("show");
                }
            });
        }
    });

    //fetch data to view product
    $(".view").on("click", function() {
        var id = $(this).data("id");

        if (!id == "") {
            $.ajax({
                url: "show/product/" + id,
                method: "POST",
                data: {
                    //set csrf token in meta tag for resource route
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success: function(data) {
                    $("#view").html(data);
                    $("#viewProduct").modal("show");
                }
            });
        }
    });

    //fecth data to view order summery
    $(".view_order").on("click", function() {
        var id = $(this).data("id");

        if (!id == "") {
            $.ajax({
                url: "orders/" + id,
                method: "GET",
                success: function(data) {
                    $("#view").html(data);
                    $("#viewOrder").modal("show");
                }
            });
        }
    });
});

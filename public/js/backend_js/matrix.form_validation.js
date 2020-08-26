$(document).ready(function() {

    /***************************** Start Admin's pages Valdiations *********************/


    // Form Validation To create new catagory
    $("#Add_category").validate({
        rules: {
            cat_name: {
                required: true
            },
            cat_dec: {
                required: true

            },
            url: {
                required: true,
            },
            image: {
                required: true,
                image: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Form Validation To create new product
    $("#Add_product").validate({
        rules: {
            proc_name: {
                required: true
            },
            proc_dec: {
                required: true

            },
            price: {
                required: true,
                number: true

            },
            code: {
                required: true,
            },
            Image: {
                required: true,
                image: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Form Validation To Edit products
    $("#Edit_product").validate({
        rules: {
            proc_name: {
                required: true
            },
            proc_dec: {
                required: true

            },
            price: {
                required: true,
                number: true

            },
            code: {
                required: true,
            },
            Image: {
                required: true,
                image: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Form Validation To create new coupon
    $("#Add_copon").validate({
        rules: {
            cop_code: {
                required: true,
                number: false
            },
            cop_type: {
                required: true

            },
            cop_amount: {
                required: true,
                number: true

            },
            cop_exp: {
                required: true,

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });



    /***************************** End Admin's pages Valdiations *********************/




    /***************************** Start user's pages Valdiations *********************/

    // create valdiate for current password where the ajax will check if the current password is correct or not
    $('#current_pass').keyup(function() {
        var current_pass = $('#current_pass').val();
        $.ajax({
            type: 'get',
            url: '/admin/check-pwd',
            data: { current_pass: current_pass },
            success: function(resp) {
                if (resp == 'false') {
                    $('#changPass').html('<font color="red"> current password is not correct Please try again</font>');
                } else {
                    $('#changPass').html('<font color="green"> current password Is correct </font>');
                }
            },
            error: function() {
                alert("error");
            }

        });
    });

    $("#password_validate").validate({
        rules: {
            current_pass: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            con_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    /***************************** END user's pages Valdiations *********************/

    // first way to delete the items using jquery

    // Confirm Delete
    // $("#DelConfrim").click(function() {
    //     if (confirm("Are you sure you want to Delete this item ?")) {
    //         return true;
    //     } else {
    //         return false;
    //     }

    // });


    // New Way to Delet Recods

    $(".deleteRecord").click(function() {
        var id = $(this).attr("rel");
        var deletProduct = $(this).attr("rel1");
        // use swal from the sweetAlert page plugin
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this File again!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'No,Cancel',
                confirmButtonText: 'Yes, Delete it',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
            },
            function() {
                window.location.href = "/admin/" + deletProduct + "/" + id;
                swal("Poof! Your imaginary file has been deleted!", {
                    type: "success",

                });
            });

    });

});



// Create Functions to add\Remove Mulit Inputs

$(document).ready(function() {
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper


    var fieldHTML = '<div class="control-group d-flex" style="width:100%;padding:10px 0"><div class="field_wrapper"><div><input type="text" name="sku[]" id="sku" placeholder="Enter Sku Product" style="width:150px" /> <input type="text" name="size[]" id="Size" placeholder="Enter Product Size" style="width:150px" /> <input type="text" name="price[]" id="price" placeholder="Enter Product price" style="width:150px" /> <input type="text" name="stock[]" id="stock" placeholder="Enter Product stock" style="width:150px" /><a href="javascript:void(0);" class="remove_button tip-bottom" title="Remove This Field"><i class="fa fa-close" style="font-size:20px;padding:0px 10px"></i></a></div></div></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked<input type="text" name="size[]" id="Size" placeholder="Enter Product Size" style="width:120px" /> <input type="text" name="price[]" id="price" placeholder="Enter Product price" style="width:120px" /><input type="text" name="stock[]" id="stock" placeholder="Enter Product stock" style="width:120px" />
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
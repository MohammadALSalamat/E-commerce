/*price range*/

$('#sl2').slider();

var RGBChange = function() {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')');
};

/*scroll to top*/

$(document).ready(function() {
    $(function() {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});

/**
 *  Create AJAX file to handle the changes of Size section where one we choose any size the
 *  price of that size and other details must show up
 */

$(function() {
    $("#size").change(function() {
        var IdSize = $(this).val();
        $.ajax({
            type: "get",
            url: "/get-product-price", // For this line we have to create Route in Web.php
            data: { IdSize: IdSize },
            success: function(response) {
                //create varibale to handle the price and stock values where we have to spreate 2 outputs
                var arr = response.split("#");
                var arr1 = arr[0].split("-");

                // here the respond first put ID to element that want to change his value
                $("#ChangePrice").html(arr1[0] + ' $ ' + "<br><h2>" + arr1[1] + ' RYM ' + "</h2>"); // the first value is for the price thats why we put arr[0]
                $("#price").val(arr[0]); // get the value of ChangePrice and a sign send it to addCartController
                // now create if statment to hande the stock if less than 0 or greater than 0
                if (arr[1] == 0) {
                    $("#AvalibalCart").text("Out of Stock").prop("disabled", true);
                    $("#availabilty").text("Sorry Out of Stock").css("color", "red");
                } else {
                    $("#AvalibalCart").text("Add To Cart").prop("disabled", false);
                    $("#availabilty").text("In Stock").css("color", "green");
                }
            },
            error: function() {
                alert(error);
            }
        });


    });

});

/**
 * Craete function to replace the main image with the alternate image which we can view it on click
 */
$(function() {
    $(".ChangeImage").click(function() {
        var Image = $(this).attr('src');
        $("#MainImage").attr("src", Image);

    });
});

// zoom image
$(document).ready(function() {
    $(".zoom").zoom();
});

// show the strength of password
$(document).ready(function($) {
    $('#myPassword').passtrength({
        minChars: 4,
        passwordToggle: true,
        tooltip: true
    });
});

$(function() {
    /***************************** Start user's pages Valdiations *********************/

    $("#Signup").validate({
        rules: {
            name: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            email: {
                required: true,
                email: true,
                remote: "/checkEmail" // to check if its valid or not
            },
            pass: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "<div style='color:red;font-weight:bold'>Name is required</div> ",
                minlength: "<div style='color:red;font-weight:bold'>Enter At Least 6 Charts And less than 20 </div> ",
                maxlength: "<div style='color:red;font-weight:bold'>Sorry but Max Charts is 20 </div> "
            },
            email: {
                required: "<div style='color:red;font-weight:bold'>Email is required</div> ",
                email: "<div style='color:red;font-weight:bold'>Enter Valid Email</div> ",
                remote: "<div style='color:red;font-weight:bold'>Email is Already Exists</div> "
            },
            pass: {
                required: "<div style='color:red;font-weight:bold'>Password is required</div> ",
            },

        }
    });

    // create valdiate for current password where the ajax will check if the current password is correct or not
    $('#current_pass').keyup(function() {
        var current_pass = $('#current_pass').val();
        $.ajax({
            type: 'get',
            url: '/account/check-pwd',
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

    // check subscribe user
    $('.checkEmail').click(function() {
        //get the input value
        let subscribe = $("#subscribe").val();
        $.ajax({
            type: "post",
            url: "/checkSubscribe",
            data: { subscribe: subscribe },
            success: function(resp) {
                if (resp == 'false') {
                    $('#Message').html('<font color="red"> current Email is Exist</font>');
                } else {
                    $('#Message').html('<font color="green"> Thank you For your subscribe.</font>');

                }
            },
            error: function() {
                alert("Please Enter Your Email First ");
            }
        });
    });




    // copy the information from one table to other and show the information  billing to shipping forms
    $(function() {
        $("#billtoship").click(function() {
            if (this.checked) {
                $("#ship_name").val($("#bill_name").val());
                $("#ship_address").val($("#bill_address").val());
                $("#ship_city").val($("#bill_city").val());
                $("#ship_state").val($("#bill_state").val());
                $("#ship_country").val($("#bill_country").val());
                $("#ship_postcode").val($("#bill_postcode").val());
                $("#ship_mobile").val($("#bill_mobile").val());
            } else {
                $("#ship_name").val('');
                $("#ship_address").val('');
                $("#ship_city").val('');
                $("#ship_state").val('');
                $("#ship_country").val('');
                $("#ship_postcode").val('');
                $("#ship_mobile").val('');
            }
        });
    });

});


// payment method submit
$(function() {
    $('#submit-payment').click(function() {
        // check if the radio button is checked or not
        if ($('#Paypal').is(':checked') || $('#COD').is(':checked')) {
            return true;
        } else {
            alert('please Select one of the Payment methods');
            return false;
        }


    });
});

// togole the plus on the History page

$('.toggle-info').click(function() {
    $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(500);
    if ($(this).hasClass('selected')) {
        $(this).html('<i class = " fa fa-minus fa-md" > </i>');
    } else {
        $(this).html('<i class = " fa fa-plus fa-md" > </i>');

    }



});

// function  to check if the pin code that you insert is valid to your country or not

$('#pincode').click(function() {
    var checkZipcode = $('#checkpincode').val();
    if (checkZipcode == '') {
        alert(' Sorry , Your City Zip Code Is Required');
        exit();
    }
    $.ajax({
        type: 'post',
        data: { checkZipcode: checkZipcode },
        url: '/checkZipCode',
        success: function(resp) {
            if (resp == 'True') {
                $('#sendErrormessage').html('<font color="green"> This product is valid to deliver Now</font>');
            } else {
                $('#sendErrormessage').html('<font color="red"> This Zip Code is Not Valid. Sorry, No Deliver to your area</font>');
            }
        },
        error: function() {
            alert("Error");
        }
    });
});
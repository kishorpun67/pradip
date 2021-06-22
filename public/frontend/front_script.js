$(document).ready(function(){
    // $("#subscriber_email").keypress(function () {
    //     var subscriber_email = $("#subscriber_email").val();
    //     $.ajax({
    //         type:'post',
    //         url:'/check-subcriber-email',
    //         data:{
    //             subscriber_email:subscriber_email
    //         },
    //         success:function(response) {
    //             if(response=="exists") {
    //                 $("#statusSubcriber").show();
    //                 $("#btnSubmit").hide();
    //                 $("#statusSubcriber").html("<div style= 'margin-top:5px;'><br><font color='red'>Error : Subscriber Email already exists !</font></div>");
    //             }
    //         },error:function(){
    //             alert("Error");
    //         }
    //     });
    // });

    // function enableSubscriber() {
    //     $("#btnSubmit").show();
    // };

    // $("#email").click(function () {
    //     var subscriber_email = $("#subscriber_email").val();
    //     $.ajax({
    //         type:'post',
    //         url:'/add-subcriber-email',
    //         data:{
    //             subscriber_email:subscriber_email
    //         },
    //         success:function(response) {
    //             if(response=="exists") {
    //                 $("#statusSubcriber").show();
    //                 $("#btnSubmit").hide();
    //                 $("#statusSubcriber").html("<div style= 'margin-top:5px;'><br><font color='red'>Error : Subscriber Email already exists !</font></div>");
    //             } else if(response == "save") {
    //                 $("#statusSubcriber").show();
    //                 $("#statusSubcriber").html("<div style= 'margin-top:5px;'><br><font color='green'>Success : Thanks for Subscribing!</font></div>");
    //             }
    //         },error:function(){
    //             alert("Error");
    //         }
    //     });
    // });

    // filter for sleeve
    $(".sleeve").on('click', function(){
        var sleeve = get_filter();
        var sort = $("#sort option:selected").text();
        var sleeve = $("#url").val();
        // alert(url)
        $.ajax({
            type: 'get',
            url:'products/',
            data:{
                sleeve :sleeve,
                sort:sort,
                url:url
            },
            success:function(response){
                // alert(response);
                $(".filter_products").html(response);

            },error:function(){
                alert('error');
            }
        });
    });

    function get_filter(class_name){
        var filter = [];
        $('.' + class_name + ':checked').each(function(){
            filter.push($(this).val());
        });
            return filter;
    }

    // select sort by product
    $("#sort").change( function(){
        var sort=$(this).val();
        var url = $("#url").val();
            // alert(url);
        if(sort== "" && url=="" ) {
            return false;
        }
        // this.form.submit();
        // alert(sort);
        $.ajax({
            type: 'get',
            url:'products/',
            data:{
                sort:sort,
                url:url
            },
            success:function(response){
                // alert(response);
                $(".filter_products").html(response);

            },error:function(){
                alert('error');
            }
        });
    });


    $("#selSize").change(function(){
        var idSize=$(this).val();
        // alert(idSize)
        if(idSize== "") {
            return false;
        }
        // alert(idSize);
        $.ajax({
            type: 'get',
            url:'/get-product-price',
            data:{
                idSize:idSize
            },
            success:function(response){
                // alert(response); return false;
                var arr= response.split('#');
                $("#getPrice").html("Rs."+arr[0]+".00");
                $("#product_price").val(arr[0]);
                if(arr[1]==0){
                    $(".carButton").hide();
                    $("#availability").text("Out of Stock");
                }else{
                    $(".carButton").show();
                    $("#availability").text("In Stock");
                }
            },error:function(){
                alert('error');
            }
        });
    });
    // copuy billing adddress to shipping address script
    $("#ship-to-bill").on('click', function(){
        if(this.checked){
            $("#shipping_name").val($("#billing_name").val());
            $("#shipping_address").val($("#billing_address").val());
            $("#shipping_city").val($("#billing_city").val());
            $("#shipping_state").val($("#billing_state").val());
            $("#shipping_country").val($("#billing_country").val());
            $("#shipping_email").val($("#billing_email").val());
            $("#shipping_mobile").val($("#billing_mobile").val());
        }else{
            $("#shipping_name").val('');
            $("#shipping_address").val('');
            $("#shipping_city").val('');
            $("#shipping_state").val('');
            $("#shipping_country").val('');
            $("#shipping_email").val('');
            $("#shipping_mobile").val('');
        }


    });



        // Check Admin Password is correct or not
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            type:'post',
            url:'/check-current-password',
            data:{
                current_password:current_password
            },
            success:function(response) {
                if(response=="false")
                {
                    $("#checkCurrentPassword").html("<font color=red>Current Password is Incorrect.");
                }else if(response=="true")
                {
                    $("#checkCurrentPassword").html("<font color=green>Current Password is Correct.");
                }
            },error:function(){
                alert("Error");
            }
        });

    });
    // Check Admin Password is correct or not
    $("#quntity").keyup(function () {
        var quantity = $("#quntity").val();
        console.log(quantity)
        // $.ajax({
        //     type:'post',
        //     url:'/check-current-password',
        //     data:{
        //         current_password:current_password
        //     },
        //     success:function(response) {
        //         if(response=="false")
        //         {
        //             $("#checkCurrentPassword").html("<font color=red>Current Password is Incorrect.");
        //         }else if(response=="true")
        //         {
        //             $("#checkCurrentPassword").html("<font color=green>Current Password is Correct.");
        //         }
        //     },error:function(){
        //         alert("Error");
        //     }
        // });

            // Check Admin Password is correct or not

    });
    $("#delet").keyup(function () {

        console.log(quantity)
        // $.ajax({
        //     type:'post',
        //     url:'/check-current-password',
        //     data:{
        //         current_password:current_password
        //     },
        //     success:function(response) {
        //         if(response=="false")
        //         {
        //             $("#checkCurrentPassword").html("<font color=red>Current Password is Incorrect.");
        //         }else if(response=="true")
        //         {
        //             $("#checkCurrentPassword").html("<font color=green>Current Password is Correct.");
        //         }
        //     },error:function(){
        //         alert("Error");
        //     }
        // });

    });

    // validate register form on keyup and  submit
    // $("#registerForm").validate({
    //     rules:{
    //         name:{
    //             required:true,
    //             minlength:2,
    //             accept:"[a-zA-Z]+",
    //         },
    //         password:{
    //             required:true,
    //             minlength : 8,
    //             maxlength:25,
    //         },
    //         email:{
    //             required:true,
    //             email:true,
    //             remote:"/check-email",
    //         }
    //     } ,
    //     messages:{
    //         name:{
    //             required: "Plesase enter your name",
    //             minglenth: "You Name must be atleast 2 charaters long",
    //             accept:"Your Name must contain letters only",
    //         },
    //         password:{
    //             required: "Please provide your Password",
    //             minlength:"You password must be betweent 8 to 15 charaters long",
    //             maxlength:"Your Password must beal less than 15 charater long",
    //         },
    //         email:{
    //             required: "Please enter your eamil",
    //             email:"Please enter valid  Email",
    //             remote: "Email already exists!",
    //         }
    //     }
    // });

    // suscriber function
    function checkSubscriber() {
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:'post',
            url:'/check-subcriber-email',
            data:{
                subscriber_email:subscriber_email
            },
            success:function(response) {
                if(response=="exists") {
                    $("#statusSubcriber").show();
                    $("#btnSubmit").hide();
                    $("#statusSubcriber").html("<div style= 'margin-top:5px;'><br><font color='red'>Error : Subscriber Email already exists !</font></div>");
                }
            },error:function(){
                alert("Error");
            }
        });
     }

    function enableSubscriber() {
        $("#btnSubmit").show();
    }

    function addSubscriber() {
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:'post',
            url:'/add-subcriber-email',
            data:{
                subscriber_email:subscriber_email
            },
            success:function(response) {
                if(response=="exists") {
                    $("#statusSubcriber").show();
                    $("#btnSubmit").hide();
                    $("#statusSubcriber").html("<div style= 'margin-top:5px;'><br><font color='red'>Error : Subscriber Email already exists !</font></div>");
                } else if(response == "save") {
                    $("#statusSubcriber").show();
                    $("#statusSubcriber").html("<div style= 'margin-top:5px;'><br><font color='green'>Success : Thanks for Subscribing!</font></div>");
                }
            },error:function(){
                alert("Error");
            }
        });
    }

});

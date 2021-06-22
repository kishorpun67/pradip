$(document).ready(function(){




    // select sort by product
    $("#sort").change( function(){
        var sort=$(this).val();
        var url = $("#url").val();
        var sleeve =  get_filter("sleeve");
        var fabric =  get_filter("fabric");
        var pattern =  get_filter("pattern");
        var brand =  get_filter("brand");

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
                sleeve:sleeve,
                fabric:fabric,
                pattern:pattern,
                brand:brand,
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
    // filter for sleeve
    $(".sleeve").on('click', function(){
        var  url= $("#url").val();
        var sleeveClass = 'sleeve';
        // alert(url)
        var sleeve = get_filter(sleeveClass);
        // alert(sleeve);
        var sort = $("#sort option:selected").val();
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


    // filter for fabric
    $(".fabric").on('click', function(){
        var  url= $("#url").val();
        var fabricClass = 'fabric';
        // alert(url)
        var fabric = get_filter(fabricClass);
        // alert(sleeve);
        var sort = $("#sort option:selected").val();
        $.ajax({
            type: 'get',
            url:'products/',
            data:{
                fabric :fabric,
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

    // filter for fabric
    $(".pattern").on('click', function(){
        var  url= $("#url").val();
        var patternClass = 'pattern';
        // alert(url)
        var pattern = get_filter(patternClass);
        // alert(sleeve);
        var sort = $("#sort option:selected").val();
        $.ajax({
            type: 'get',
            url:'products/',
            data:{
                pattern :pattern,
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

    // filter for fabric
    $(".brand").on('click', function(){
        var  url= $("#url").val();
        var brandClass = 'brand';
        // alert(url)
        var brand = get_filter(brandClass);
        // alert(sleeve);
        var sort = $("#sort option:selected").val();
        $.ajax({
            type: 'get',
            url:'products/',
            data:{
                brand :brand,
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
                // alert(response.stock);
                // alert(response); return false;

                if(response.discount==0){
                    $("#product_price").val(response.price);
                    $("#getPrice").html("Rs."+response.price+".00");
                }else{
                    $("#product_price").val(response.discount);
                    $("#getPrice").html("<del>"+"Rs."+response.price+".00"+"</del>");
                    $("#dicsount").html("Rs."+response.discount+".00");
                }
                if(response.stock==0){
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



    $("#add_subcribe").change( function(){
        var subscriber_email = $("#subscriber_email").val();
        alert('kk')
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
    });



});

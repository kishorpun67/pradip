/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*scroll to top*/

$(document).ready(function(){
	$(function () {
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

$(document).ready(function(){
	// change Price with size
	$("#selSize").change(function(){
		var idSize=$(this).val();
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
});

// chage product image
$(document).ready(function(){
	$(".changeImage").click(function(){
		var image = $(this).attr('src');
		$("#mainImage").attr("src",image);
	});
});

// Instantiate EasyZoom instances
var $easyzoom = $('.easyzoom').easyZoom();

// Setup thumbnails example
var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

$('.thumbnails').on('click', 'a', function(e) {
	var $this = $(this);

	e.preventDefault();

	// Use EasyZoom's `swap` method
	api1.swap($this.data('standard'), $this.attr('href'));
});

// Setup toggles example
var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

$('.toggle').on('click', function() {
	var $this = $(this);

	if ($this.data("active") === true) {
		$this.text("Switch on").data("active", false);
		api2.teardown();
	} else {
		$this.text("Switch off").data("active", true);
		api2._init();
	}
});


$().ready(function() {
	// validate register form on keyup and  submit
	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept:"[a-zA-Z]+",
			},
			password:{
				required:true,
				minlength : 8,
				maxlength:25,
			},
			email:{
				required:true,
				email:true,
				remote:"/check-email",
			}
		} ,
		messages:{
			name:{
				required: "Plesase enter your name",
				minglenth: "You Name must be atleast 2 charaters long",
				accept:"Your Name must contain letters only",
			},
			password:{
				required: "Please provide your Password",
				minlength:"You password must be betweent 8 to 15 charaters long",
				maxlength:"Your Password must be less than 15 charater long",
			},
			email:{
				required: "Please enter your eamil",
				email:"Please enter valid  Email",
				remote: "Email already exists!",
			}
		}
	})
	// password strength script
	$('#myPassword').passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeTmg :"/frontend/images/eye.svg",
	});
//    validation for login form
	$("#loginForm").validate({
		rules:{
			password:{
				required:true,
			},
			email:{
				required:true,
				email:true,
			}
		} ,
		messages:{
			password:{
				required: "Please provide your Password",
			},
			email:{
				required: "Please enter your eamil",
				email:"Please enter valid  Email",
			}
		}
	})
	// $('#loginPassword').passtrength({
	// 	eyeTmg :"/frontend/images/eye.svg",
	// });
	//  validation for update account
	$("#accountForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept:"[a-zA-Z]+",
			},
			address:{
				required:true,
				minlength : 4,
			},
			city:{
				required:true,
				minlength : 4,
			},
			state:{
				required:true,
				minlength : 2,
			},
			country:{
				required:true,
			},
		},
		messages:{
			name:{
				required: "Plesase enter trueyour name",
				minglenth: "You Name must be atleast 2 charaters long",
				accept:"Your Name must contain letters only",
			},
			address:{
				required: "Please provide your Adress",
				minlength:"You Address must be atlest 4 charaters long",
			},
			city:{
				required: "Please select city ",
				minlength:"You City must be atlest 4 charaters long",
			},
			state:{
				required: "Please select your state",
				minlength:"You State must be atlest 2 charaters long",
			},
			country:{
				required: "Please select your country",
				minlength:"You City must be atlest 4 charaters long",
			}
		}
	});

	// copuy billing adddress to shipping address script
	$("#shiptobill").on('click', function(){
		if(this.checked){
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_country").val($("#billing_country").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_mobile").val($("#billing_mobile").val());
		}else{
			$("#shipping_name").val('');
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_country").val('');
			$("#shipping_pincode").val('');
			$("#shipping_mobile").val('');
		}
	});
});
$(document).ready(function() {
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
});
$().ready(function() {

});
function selectPaymentMethod() {
	if($("#Paypal").is(':checked')) {
	}
}

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
    // Appen categories product
    // $(".category").click(function() {
	// 	var subcat_url = $(this).attr("subcat_url");
	// 	// alert(subcat_url);
    //     $.ajax({
    //         type:'get',
    //         url:'/subcat',
    //         data:{
    //             subcat_url:subcat_url
    //         },
    //         success:function(response) {
    //             // alert(response);
    //             $("#appendsubcat").html(response);
    //         },error:function(){
    //             alert("Error");
    //         }
    //     });
    // });


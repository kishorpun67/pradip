$(document).ready(function() {
    // Check Admin Password is correct or not
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);

        $.ajax({
            type:'post',
            url:'/admin/check-current-password',
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


    // updatsection  admin status
    $(".updateSectionStatus").click(function() {
        var status = $(this).text();
        var section_id= $(this).attr("section_id");
        $.ajax({
            type:'post',
            url:'/admin/update-section-status',
            data:{
                status:status,
                section_id:section_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#section-"+section_id).html("<a  class='updateSectionStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#section-"+section_id).html(" <a  class='updateSectionStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // update category satatus
    $(".updateCategoryStatus").click(function() {
        var status = $(this).text();
        var category_id= $(this).attr("category_id");
        $.ajax({
            type:'post',
            url:'/admin/update-category-status',
            data:{
                status:status,
                category_id:category_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#category-"+category_id).html("<a  class='updateCategoryStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#category-"+category_id).html(" <a  class='updateCategoryStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Appen categories level
    $("#section_id").change(function() {
        var section_id = $(this).val();
        $.ajax({
            type:'post',
            url:'/admin/append-categories-level',
            data:{
                section_id:section_id
            },
            success:function(response) {
                // alert(response)
                $("#appendCategoriesLevel").html(response);
            },error:function(){
                alert("Error");
            }
        });
    });


    // Delete category prodcut
    $(".delete_form").click(function(){
        var id =$(this).attr('rel');
        var record =$(this).attr('record');
        // alert(id);
        swal({
            title: "Are you sure?",
            text: "You will not able to recover this record again!",
            icon: "warning",
            showCancelButton : true,
            confirmButtonClass :"btn-danger",
            confirmButtonText :"Yes, delete it",
        },
        function() {
            window.location.href = "delete-"+record+"/"+id;
        }
        );
    });

       // update product satatus
       $(".updateProductStatus").click(function() {
        var status = $(this).text();
        var product_id= $(this).attr("product_id");
        $.ajax({
            type:'post',
            url:'/admin/update-product-status',
            data:{
                status:status,
                product_id:product_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#product-"+product_id).html("<a  class='updateProductStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#product-"+product_id).html(" <a  class='updateProductStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Delete category prodcut
    // $(".delete_image").click(function(){
    //     var id =$(this).attr('rel');
    //     var record =$(this).attr('record')
    //     alert(re);
    //     swal({
    //         title: "Are you sure?",
    //         text: "You will not able to r ecover this record again!",
    //         icon: "warning",
    //         showCancelButton : true,
    //         confirmButtonClass :"btn-danger",
    //         confirmButtonText :"Yes, delete it",
    //     },
    //     function() {
    //         window.location.href = "admin/delete-"+record+"/"+id;
    //     }
    //     );
    // });

    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div  style="padding-top:5px;"><input type="text" name="sku[]" id="sku" placeholder="SKU" value=""/><input type="text" name="size[]" id="size" placeholder="Size" value=""  style="margin-left:3px;"/><input type="number" name="price[]" id="price" placeholder="Price Rs."value="" style="margin-left:5px;"/><input type="number" name="stock[]" id="stock" placeholder="Stock" value="" style="margin-left:4px;"/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });


    // update post satatus
    $(".updatePostStatus").click(function() {
        var status = $(this).text();
        var post_id= $(this).attr("post_id");
        $.ajax({
            type:'post',
            url:'/admin/update-post-status',
            data:{
                status:status,
                post_id:post_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#post-"+post_id).html("<a  class='updatePostStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#post-"+post_id).html(" <a  class='updatePostStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // update brand satatus
    $(".updateBrandStatus").click(function() {
        var status = $(this).text();
        var brand_id= $(this).attr("brand_id");
        $.ajax({
            type:'post',
            url:'/admin/update-brand-status',
            data:{
                status:status,
                brand_id:brand_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#brand-"+brand_id).html("<a  class='updateBrandStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#brand-"+brand_id).html(" <a  class='updateBrandStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });


    // $(".category_id").click(function() {
    //     var category_id = $(this).attr("category_id");
    //     alert(category_id);
    //     $.ajax({
    //         type:'post',
    //         url:'/products/url',
    //         data:{
    //             category_id:category_id
    //         },
    //         success:function(response) {
    //             alert(response)
    //             $("#appendCategoriesLevel").html(response);
    //         },error:function(){
    //             alert("Error");
    //         }
    //     });
    // });



    // update ProductAttribute satatus
    $(".updateProductAttributeStatus").click(function() {
        var status = $(this).text();
        var productAttr_id= $(this).attr("productAttr_id");
        $.ajax({
            type:'post',
            url:'/admin/update-product-attr-status',
            data:{
                status:status,
                productAttr_id:productAttr_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#productAttribute-"+productAttr_id).html("<a  class='updateProductAttributeStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#productAttribute-"+productAttr_id).html(" <a  class='updateProductAttributeStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // update ProductImage satatus
    $(".updateProductImageStatus").click(function() {
        var status = $(this).text();
        var productImg_id= $(this).attr("productImg_id");
        $.ajax({
            type:'post',
            url:'/admin/update-product-img-status',
            data:{
                status:status,
                productImg_id:productImg_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#productImage-"+productImg_id).html("<a  class='updateProductImageStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#productImage-"+productImg_id).html(" <a  class='updateProductImageStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
       // update ProductImage satatus
    $(".updateProductImageStatus").click(function() {
        var status = $(this).text();
        var productImg_id= $(this).attr("productImg_id");
        $.ajax({
            type:'post',
            url:'/admin/update-product-img-status',
            data:{
                status:status,
                productImg_id:productImg_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#productImage-"+productImg_id).html("<a  class='updateProductImageStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#productImage-"+productImg_id).html(" <a  class='updateProductImageStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    // update Coupon satatus
    $(".updateCouponStatus").click(function() {
        var status = $(this).text();
        var coupon_id= $(this).attr("coupon_id");
        $.ajax({
            type:'post',
            url:'/admin/update-coupon-status',
            data:{
                status:status,
                coupon_id:coupon_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#coupon-"+coupon_id).html("<a  class='updateCouponStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#coupon-"+coupon_id).html(" <a  class='updateCouponStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // update CmsPage satatus
    $(".updateCmsStatus").click(function() {
        var status = $(this).text();
        var cms_id= $(this).attr("cms_id");
        $.ajax({
            type:'post',
            url:'/admin/update-cms-status',
            data:{
                status:status,
                cms_id:cms_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#cms-"+cms_id).html("<a  class='updateCmsStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#cms-"+cms_id).html(" <a  class='updateCmsStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // update user satatus
    $(".updateUserStatus").click(function() {
        var status = $(this).text();
        var user_id= $(this).attr("user_id");
        $.ajax({
            type:'post',
            url:'/admin/update-user-status',
            data:{
                status:status,
                user_id:user_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#user-"+user_id).html("<a  class='updateUserStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#user-"+user_id).html(" <a  class='updateUserStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    // update user satatus
    $(".updateNewsletterStatus").click(function() {
        var status = $(this).text();
        var news_id= $(this).attr("news_id");
        $.ajax({
            type:'post',
            url:'/admin/update-newsletter-status',
            data:{
                status:status,
                news_id:news_id
            },
            success:function(response) {
                if(response['status']==0) {
                    $("#news-"+news_id).html("<a  class='updateNewsletterStatus'  href='javascript:(0);'>Inctive</a>");
                }else if(response['status']==1){
                    $("#news-"+news_id).html(" <a  class='updateNewsletterStatus'  href='javascript:(0);'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
});

$(document).ready(function(){
    // update order status
    $("#upadatOrderStatusForm").click(function(){
        // console.log("name");
    });
});


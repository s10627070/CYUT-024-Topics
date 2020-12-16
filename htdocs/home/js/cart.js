$(document).ready(function(){

	load_product();

	load_cart_data();
    
	function load_product()
	{
		$.ajax({
			url:"cart/fetch_item.php",
			method:"POST",
			success:function(data)
			{
				$('#display_item').html(data);
			}
		});
	}

	function load_cart_data()
	{
		$.ajax({
			url:"cart/fetch_cart.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
				$('#cart_details').html(data.cart_details);
				$('.total_price').text(data.total_price);
				$('.badge').text(data.total_item);
			}
		});
	}
	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});


	$(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		$.ajax({
			url:"cart/action.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				alert("Your Cart has been clear");
			}
		});
	});
    /*$('.add_to_cart').click(function(){  
        var product_id = $(this).attr("id");  
        var product_name = $('#name'+product_id).val();  
        var product_price = $('#price'+product_id).val();  
        var product_quantity = $('#quantity'+product_id).val();  
        var action = "add";  
        if(product_quantity > 0)  
        {  
             $.ajax({  
                  url:"cart/action_ajax.php",  
                  method:"POST",  
                  dataType:"json",  
                  data:{  
                       product_id:product_id,   
                       product_name:product_name,   
                       product_price:product_price,   
                       product_quantity:product_quantity,   
                       action:action  
                  },  
                  success:function(data)  
                  {  
                       $('#order_table').html(data.order_table);  
                       $('.badge').text(data.cart_item);  
                       alert("已添加到購物車");  
                  }  
             });  
        }  
        else  
        {  
             alert("請輸入數量")  
        }  
   }); */ 
   $(document).on('click', '.delete', function(){  
        var product_id = $(this).attr("id");  
        var action = "remove";  
        if(confirm("您確定要取消這項商品嗎?"))  
        {  
             $.ajax({  
                  url:"cart/action.php",  
                  method:"POST",  
                  dataType:"json",  
                  data:{product_id:product_id, action:action},  
                  success:function(data){  
                        load_cart_data();
                        $('#cart-popover').popover('hide');
                       $('#order_table').html(data.order_table);  
                       $('.badge').text(data.cart_item);  
                       
                  }  
             });  
        }  
        else  
        {  
             return false;  
        }  
   });  
   $(document).on('keyup', '.quantity', function(){  
        var product_id = $(this).data("product_id");  
        var quantity = $(this).val();  
        var action = "quantity_change";  
        if(quantity != '')  
        {  
             $.ajax({  
                  url :"cart/action.php",  
                  method:"POST",  
                  dataType:"json",  
                  data:{product_id:product_id, quantity:quantity, action:action},  
                  success:function(data){  
                       $('#order_table').html(data.order_table);  
                  }  
             });  
        }  
   });  
   
});


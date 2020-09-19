$(document).ready(function(){
  $('.search_section').hide();
	showtable();
	cartNoti();



	$('.addtocartBtn').on('click',function(){


		var id= $(this).data('id');
		var name= $(this).data('name');
		var codeno=$(this).data('codeno');
		var photo=$(this).data('photo');
		var unitprice=$(this).data('unitprice');
		var discount =$(this).data('discount');
		var qty=1;

		var mylist= {id:id,name:name,codeno:codeno,photo:photo,unitprice:unitprice,
			discount:discount,qty:qty};
	//console.log(mylist);

	var cart=localStorage.getItem('cart');

	var cartArray;

	if(cart==null)
	{
		cartArray = Array();
	}
	else
	{
		cartArray = JSON.parse(cart);
	}

	var status= false;

	$.each(cartArray ,function(i,v)
	{
		if(id==v.id)
		{
			v.qty++;
			status=true;
		}
	})

	if(!status)
	{
		cartArray.push(mylist);

	}
	var cartData= JSON.stringify(cartArray);
	localStorage.setItem("cart",cartData);
	  cartNoti();

	console.log("ID:"+id+
		"Name:"+name+
		"Codeno:"+codeno+
		"Photo:"+photo+
		"unitprice:"+unitprice+
		"Discount:"+discount);
});

    function cartNoti()
       {
       		var cart = localStorage.getItem('cart');
       		var total=0;
       		var noti=0;
       		if (cart)
       		 {
       		 	var cartArray = JSON.parse(cart);

       		 	$.each(cartArray,function(i,v){

       		 		var unitprice=v.price;
       		 		var discount=v.discount;
       		 		var qty= v.qty;
       		 		if(discount){
       		 			var price = discount;
       		 		}
       		 		else{
       		 			var price= unitprice;
       		 		}
       		 		var subtotal = price * qty;

       		 		noti += qty++;
       		 		total += subtotal ++;
       		 	})

       		 	$('.shoppingcartNoti').html(noti);
       		 	$('.shoppingcartTotal').html(total+'Ks');

       		 }
       		 else
       		 {
       		 	$('.shoppingcartNoti').html(0);
       		 	$('.shoppingcartTotal').html(0+'Ks');
       		 }
       }
	function showTable(){

		var cart = localStorage.getItem('cart');

		if(cart)
		{
			$('.shoppingcart_div').show();
			$('.noneshoppingcart_div').hide();

			var cartArray = JSON.parse(cart);
			var shoppingcartData='';

			if(cartArray.length >0 )
			{
				var total=0;

				$.each(cartArray, function(i,v){
					var id= v.id;
					var codeno = v.codeno;
					var name= v.name;
					var unitprice= v.unitprice;
					var discount= v.discount;
					var photo= v.photo;
					var qty=v.qty;

					if(discount)
					{
						var price=discount;
					}
					else
					{
						var price = unitprice;
					}
					var subtotal= price * qty;

					shoppingcartData += `<tr>
					<td class="shoping__cart__item">
					<img src="${photo}" class="img-fluid" style="width:50px;">
					<h5>${name}</h5>
					</td>

					<td class="shoping__cart__price">
					${unitprice}
					</td>
					<td>
					<button class="btn btn-outline-secondary
					plus_btn" data-id="${i}"> 
					<i class="icofont-plus"></i> 
					</button>
					</td>

					<td>
					<p> ${qty} </p>
					</td>

					<td>
					<button class="btn btn-outline-secondary
					minus_btn" data-id="${i}"> 
					<i class="icofont-minus"></i>
					</button>
					</td>


					<td class="shoping__cart__total">
					${subtotal}
					</td>

					<td class="remove shoping__cart__item__close" data-id="${i}">
					<i class="icon_close" style="color:red;"></i>
					</td>


					</tr>`;
					total+=subtotal++;
				});
				$('#shoppingcart_table').html(shoppingcartData);
				$('.shoppingcartTotal').html(total + 'Ks');

			}
		}

	}


     $('#shoppingcart_table').on('click','.minus_btn',function ()
 {
        var id=$(this).data('id');
        var cart=localStorage.getItem('cart');
        var cartArray=JSON.parse(cart);
        $.each(cartArray,function (i,v) {
               if (i==id)
                {
                      v.qty--;
                        if(v.qty==0){
                            cartArray.splice(id,1);
                        }
                }
        })
        var cartData=JSON.stringify(cartArray);
        localStorage.setItem('cart',cartData);
        showTable();
        cartNoti();  
        
        })






    $('#shoppingcart_table').on('click','.plus_btn',function ()
{
       var id=$(this).data('id');
       var cart=localStorage.getItem('cart');
       var cartArray=JSON.parse(cart);
       $.each(cartArray,function (i,v) {
              if (i==id)
               {
                     v.qty++;
               }
       })
      var cartData=JSON.stringify(cartArray);
       localStorage.setItem('cart',cartData);
       showTable();
       cartNoti();
       })

    $('#shoppingcart_table').on('click','.remove',function ()
{
       var id=$(this).data('id');
       var cart=localStorage.getItem('cart');
       var cartArray=JSON.parse(cart);
       $.each(cartArray,function (i,v) {
              if (i==id)
               {
                     cartArray.splice(id,1);
               }
       })
      var cartData=JSON.stringify(cartArray);
       localStorage.setItem('cart',cartData);
      

       showTable();
       cartNoti();
        //location.reload();
       })

    $('.checkoutBtn').click(function ()
     {
      var cart=localStorage.getItem('cart');
      var note=$('#notes').val();

      $.ajaxSetup({
      	headers:{
      		'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      	}
      });
      $.post('/order',{data:cart,note:note},function(response){
      	localStorage.clear();
      	location.href="ordersuccess"

      });
    
    });

    $('.searchBtn').click(function(){
    	var searchItem=$('#searchItem').val();
    	//console.log(searchItem);
    	$.ajaxSetup({
      	headers:{
      		'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      	}
      });

    	$.post('/search',{item:searchItem},function(response){
    		$('#promotion_section').hide();
        $('.search_section').show();
      	//console.log(response);
      	 var data=response;
          var datasearch='';
      	//console.log(data);
      	$.each(data, function(i,v){
      		var id=v.id;
      		var name=v.name;
          var photos=JSON.parse(v.photo);
          var photo=photos[0];
          //console.log(photo);
      		var unitprice=v.price;
          var discount=v.discount;

      	
      		 datasearch+=`
        

                           <div class="col-lg-4 col-md-6 col-sm-6 mt-5">

                       <div class="card " style="width: 18rem; margin-left:20%">
  <img src="${photo}" class="card-img-top img-fluid" style="width:100%; height:250px;" alt="...">
  <div class="card-body">
    <h5 class="card-title">${name}</h5>


    <p class="card-text">

    </p>
    <a href="" class="btn btn-info" data-id="${id}">Shopping Cart</a>
  </div>
  </div>
</div>`;




      		 
      	});
      	$('#searchMenu').html(datasearch);
      });

    });
});





$(document).ready(function(){

	var action = "action"; var page; var cart_action = "cart_action";

	filter();
	pagination();
	add_to_cart();

	var ascending;

	$("#sort").change(function(){
		ascending = $("#sort").val();
		//console.log(ascending);
		filter();
		pagination();

    });

    var descending;

	$("#sort").change(function(){
		descending = $("#sort").val();
		//console.log(descending);
		filter();
		pagination();

    });

	var category;
	
	$("#men").click(function(){
		category = $("#men").text();
		//console.log(men);
		filter();
		pagination();

    });

    // var women;

    $("#women").click(function(){
    	category = $("#women").text();
		//console.log(women);
		filter();
		pagination();
    	
    });

    // var kids;

    $("#kids").click(function(){
    	category = $("#kids").text();
		//console.log(kids);
		filter();
		pagination();
    	
    });

    var brand; var brand_arr = [];

    $(".check").change(function(){
    	brand = $(this).val();

    	if($(this). prop("checked") == true)
		{
    		brand_arr.push(brand);
    		//console.log(brand_arr);    		
    	}
    	
    	if($(this). prop("checked") == false)
		{
	    	for(var i=0; i<brand_arr.length; i++)
	    	{
	    		if(brand == brand_arr[i])
	    		{
	    			brand_arr.splice(i,1);
	    			//console.log(brand_arr);
	    		}
	    	}
	    }
	    filter();
	    pagination();
    });

	var color;

	$("#cs-black").change(function(){
		color = $("#cs-black").val();
		//console.log(blk);
		filter();
		pagination();
	});

	// var vlt;

	$("#cs-violet").change(function(){
		color = $("#cs-violet").val();
		//console.log(vlt);
		filter();
		pagination();
	});

	// var blue;

	$("#cs-blue").change(function(){
		color = $("#cs-blue").val();
		//console.log(blue);
		filter();
		pagination();
	});

	// var ylw;

	$("#cs-yellow").change(function(){
		color = $("#cs-yellow").val();
		//console.log(ylw);
		filter();
		pagination();
	});

	// var red;

	$("#cs-red").change(function(){
		color = $("#cs-red").val();
		//console.log(red);
		filter();
		pagination();
	});

	// var grn;

	$("#cs-green").change(function(){
		color = $("#cs-green").val();
		//console.log(grn);
		filter();
		pagination();
	});

	var size;

	$("#s-size").click(function(){
		size = $("#s-size").val();
		//console.log(s);
		filter();
		pagination();
	});

	// var m;

	$("#m-size").click(function(){
		size = $("#m-size").val();
		//console.log(m);
		filter();
		pagination();
	});

	// var l;

	$("#l-size").click(function(){
		size = $("#l-size").val();
		//console.log(l);
		filter();
		pagination();
	});

	// var xl;

	$("#xs-size").click(function(){
		size = $("#xs-size").val();
		//console.log(sxl);
		filter();
		pagination();
	});

	var tag;
	
	$("#sweater").click(function(){
		tag = $("#sweater").text();
		//console.log(men);
		filter();
		pagination();

    });

    $("#shoes").click(function(){
		tag = $("#shoes").text();
		//console.log(men);
		filter();
		pagination();

    });

    // var coat;
	
	$("#coat").click(function(){
		tag = $("#coat").text();
		//console.log(men);
		filter();
		pagination();

    });

    $("#shirts").click(function(){
		tag = $("#shirts").text();
		//console.log(men);
		filter();
		pagination();

    });

    $("#jacket").click(function(){
		tag = $("#jacket").text();
		//console.log(men);
		filter();
		pagination();

    });

    // var scarf;
	
	$("#scarf").click(function(){
		tag = $("#scarf").text();
		//console.log(men);
		filter();
		pagination();

    });

    // var hat;
	
	$("#hat").click(function(){
		tag = $("#hat").text();
		//console.log(men);
		filter();
		pagination();

    });

    // var bagpack;
	
	$("#bagpack").click(function(){
		tag = $("#bagpack").text();
		//console.log(men);
		filter();
		pagination();

    });

    // var purse;

    $("#purse").click(function(){
		tag = $("#purse").text();
		//console.log(men);
		filter();
		pagination();

    });  

    var min_price; var max_price;

    $("#filter_price").click(function(){
    	min_price = $("#minamount").val();
    	min_price = min_price.substring(1);
		//console.log(min_price);
		filter();

		max_price = $("#maxamount").val();
		max_price = max_price.substring(1);
		//console.log(max_price);
		filter();
		pagination();
    });

    function filter()
    {
    	$.ajax({    		
    		url: "ajaxresponse.php",
    		type: "POST",
    		dataType: "json",
    		data: { 
    				"action":action,    				
    				"ascending":ascending,
    				"descending":descending,
    				"category":category,
    				"brand_arr":brand_arr,
    				"min_price":min_price,
    				"max_price":max_price,
    				"color":color,
    				"size":size,
    				"tag":tag,
    				"page":page,
    				"show":show
    			},    		
    		})

    		.done(function(array){ 

    			// var array = JSON.parse(data);
    			console.log(array);
    			display = "<div class='row'>";

    			for(var i=0; i<array.length; i++)
    			{
    				display += "<div class='col-lg-4 col-sm-6'>\
    							<div class='product-item'>\
			    				<div class='pi-pic'>\
			    				<a href='product.php?id1="+array[i].Product_SKU+"&id0="+array[i].Tags+"'>\
			    				<img src='img/products/"+array[i].Product_Image+"' alt=''></a>\
			    				<div class='sale pp-sale'>Sale</div>\
			    				<div class='icon'>\
			    				<i class='icon_heart_alt'></i>\
			    				</div>\
			    				<ul>\
			    				<li class='w-icon active'>\
			    				<a href='javascript:;' id='addcart' data-id22='"+array[i].Product_SKU+"'><i class='icon_bag_alt'></i></a></li>\
			    				<li class='quick-view'>\
			    				<a href='#'>+ Quick View</a></li>\
			    				<li class='w-icon'>\
			    				<a href='#'><i class='fa fa-random'></i></a></li>\
			    				</ul>\
			    				</div>\
			    				<div class='pi-text'>\
			    				<div class='catagory-name'>"+array[i].Tags+"</div>\
			    				<a href='#'>\
			    				<h5>"+array[i].Product_Name+"</h5></a>\
			    				<div class='product-price'>$"+array[i].Product_Sale_Price+"\
			    				<span>$"+array[i].Product_Price+"</span>\
			    				</div>\
			    				</div>\
			    				</div>\
			    				</div>";			    				
    			}

    			display += "</div>";

    			$(".product-list").html(display);    			
    		});    	
    }

    function pagination()
    {
    	$.ajax({
    		url: "ajaxresponse.php",
    		type: "POST",
    		dataType: "json",
    		data: { 
    				"action":action,
    				"ascending":ascending,
    				"descending":descending,
    				"category":category,
    				"brand_arr":brand_arr,
    				"min_price":min_price,
    				"max_price":max_price,
    				"color":color,
    				"size":size,
    				"tag":tag,
    				"page":page,
    				"show":show
    			},    		
    		})

    	.done(function(page){
    		var total_pages = page[page.length-1];
    		var pageno = page[page.length-2];
    		// console.log(total_pages);
    		// console.log(pageno);
    		// console.log(page);

    		pageno--;

    		var numbers = "<a href='javascript:;' id='First' data-id='1' title='First Page' style='color: dodgerblue; padding: 10px'>&laquo; First</a>\
                <a href='javascript:;' id='Previous' class='prev_page' data-id='"+pageno+"' title='Previous Page' style='color: dodgerblue; padding: 10px'>&laquo; Previous</a>";

            for (var i=1; i <= total_pages; i++)
            {
                numbers += "<a href='javascript:;' id='vary' data-id='"+i+"'";

                if(pageno == i)
                {
                    numbers += "class='number current'";
                }

                else
                {
                    numbers += "class = 'number'";
                }
                numbers += "title='"+i+"' style='color: dodgerblue; padding: 10px'>"+i+"</a>";
            }

            if (total_pages > pageno)
            {
            	pageno++;

                numbers += "<a href='javascript:;' id='Next' class='next_page' data-id='"+pageno+"' title='Next Page' style='color: dodgerblue; padding: 10px'>Next &raquo;</a>\
                <a href='javascript:;' id='Last' data-id="+total_pages+" title='Last Page' style='color: dodgerblue; padding: 10px'>Last &raquo;</a>";
            }
            
            numbers += "</div>";

            $(".pagination").html(numbers);            
    	});
    }

    $(".pagination").on("click","#First",function(){
		page = $(this).data("id");
		//console.log(page);
		filter();
		pagination();
    });

    $(".pagination").on("click","#Previous",function(){
		page = $(this).data("id");
		//console.log(page);
		filter();
		pagination();
	});

	$(".pagination").on("click","#vary",function(){
		page = $(this).data("id");
		//console.log(page);
		filter();		
		pagination();

	});

	$(".pagination").on("click","#Next",function(){
		page = $(this).data("id");
		//console.log(page);
		filter();
		pagination();
	});

	$(".pagination").on("click","#Last",function(){
		page = $(this).data("id");
		//console.log(page);
		filter();
		pagination();
	});

	var show;

    $(".p-show").change(function(){
    	show = $(this).val();
    	//console.log(show);
    	filter();
    	pagination();
    });

    var cart; var qty;

    $(".quantity").on("click","#addtocart",function(){
    	cart = $("#addtocart").data("id2");
    	qty = $("#quantity").val();
    	qty = parseInt(qty);
    	//console.log(qty);
    	add_to_cart();
    });

    $(".row").on("click","#addcart",function(){
    	cart = $(this).data("id22");
    	qty = 1;
    	//console.log(cart);
    	add_to_cart();
    });   

    var del;

    $(".select-items").on("click",".ti-close",function(){
    	del = $(this).data("id_del");
    	//console.log(del);
    	add_to_cart();
    });

    $(".cart-table").on("click",".ti-close",function(){
    	del = $(this).data("id_d");
    	//console.log(del);
    	add_to_cart();
    });

    var qy = [];

    function add_to_cart()
    {
    	$.ajax({
    		url: "cartresponse.php",
    		type: "POST",
    		dataType: "json",
    		data:{  
    				"cart_action":cart_action,   				
    				"cart":cart,
    				"qty":qty,
    				"del":del,
    				"qy":qy
    			},    		
    		})

    	.done(function(cart_array){
    		var grand_total = 0;

    		var on_hover = "<table><tbody>";

    		for(var i=0; i<cart_array.length; i++)
    		{
    			grand_total += cart_array[i].Product_Sale_Price * cart_array[i].Product_quantity;

    			on_hover += "<tr>\
    						<td class='si-pic'>\
    						<img src='img/products/"+cart_array[i].Product_Image+"' alt='' width='100' height='100'>\
    						</td>\
    						<td class='si-text'>\
    						<div class='product-selected'>\
    						<p>$"+cart_array[i].Product_Sale_Price+" x "+cart_array[i].Product_quantity+"</p>\
    						<h6>"+cart_array[i].Product_Name+"</h6>\
    						</div>\
    						</td>\
    						<td class='si-close'>\
    						<i class='ti-close' data-id_del='"+cart_array[i].Product_SKU+"'></i>\
    						</td>\
    						</tr>";
    		}

    		on_hover += "</tbody></table>";

    		$(".select-items").html(on_hover);

    		var size = cart_array.length;
    		$(".number").html(size);

    		$(".st").html("$"+grand_total+".00");
    		$(".ct").html("$"+grand_total+".00");
    		$(".cart-price").html("$"+grand_total+".00");    		

    		$("#updatebtn").click(function(){

    			for(var i=0; i<cart_array.length; i++)
    			{
    				qy[i] = $("#update"+i).val();    				
    			}
    			//console.log(qy);
    			add_to_cart();
    		});
    	});
    }
});
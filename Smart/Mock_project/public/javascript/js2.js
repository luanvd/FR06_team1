$(function() {
	var base_url = "http://group4.com/";
	var data;
	
	function numberWithCommas(x) {
    	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	function sortByName(a,b){
		var a1 = a.pro_name.toLowerCase(),
			b1 = b.pro_name.toLowerCase();
		if (a1 == b1) {
			return 0;
		}
		else return a1 > b1 ? 1 : -1;
	}

	function sortByPrice(a,b){
		var a1 = parseInt(a.pro_sale_price),
			b1 = parseInt(b.pro_sale_price);
		if (a1 == b1) {
			return 0;
		}
		else return a1 > b1 ? 1 : -1;
	}

	function sortByBrand(a,b){
		var a1 = a.brand_id.toLowerCase(),
			b1 = b.brand_id.toLowerCase();
		if (a1 == b1) {
			return 0;
		}
		else return a1 > b1 ? 1 : -1;
	}

	function sortByCountry(a,b){
		var a1 = a.pro_country.toLowerCase(),
			b1 = b.pro_country.toLowerCase();
		if (a1 == b1) {
			return 0;
		}
		else return a1 > b1 ? 1 : -1;
	}

	function generateItem($product){
		var s = "<li class='list_products'>"+ 
                                 
 			        "<div class='products-grid-row'>"+
    				    "<div class='grid_wrapper'>"+
    					   "<a href='" + base_url + "default/product/details/" + $product['pro_id'] + "'><img src='"+base_url+"/public/images/products/"+$product['pro_images']+"' class='product-image' /></a>"+
    				    "</div>"+
    				    "<div class='product-shop'>"+
    					   "<h3 class='product-name'>"+
                                "<a href=''>"+$product['pro_name']+"</a>"+
    					   "</h3>"+
    					   "<div class='desc-grid'>"+$product['pro_desc']+"</div>"+
    					   "<div class='price-box'>"+
                                "<span class='price'>" + numberWithCommas($product['pro_sale_price']) + " VND</span>"+ 
					       "</div>"+
    					   "<div class='actions'>"+                           
                                "<form action='' method='POST'>" +
                                    "<input type='hidden' value='" + $product['pro_id'] + "' name='pro_id'/>" +
                                    "<input type='hidden' value='1' name='qty'/>" +
                                    "<input type='hidden' value='<b>" + $product['pro_list_price'] + "</b>' name='pro_price'/>" +
                                    "<input type='hidden' value='" + $product['pro_name'] + "' name='pro_name'/>" +
                                    "<input type='hidden' value='" + $product['pro_images'] + "' name='pro_images'/>" +
                                    "<input type='submit' name='addCart' value='Add to Cart' class='btn-cart' />" +
        							"<a href='" + base_url + 'default/product/details/' + $product['pro_id'] + "' class='btn-details'>Details</a>" +
                                "</form>" +
    					   "</div>"+
    				    "</div>"+
    			     "</div>"+
    		      "</li>";
    	return s;
	}
    
    
	function load_result(index){
		index = index || 0;
		$.post(base_url + "default/product/index" + index, {ajax: true }, function(data) {
			console.log(data.result);
		}, "json");
	}

	function print_result(sortPageBy, sortPageDir){
		switch(sortPageBy) {
			case "1" :
				data.result.sort(sortByName);
				break;
			
			case "2" : 
				data.result.sort(sortByBrand);
				break;
			
			case "3": 
				data.result.sort(sortByCountry);
				break;
			
			case "4" : 
				data.result.sort(sortByPrice);
				break;
		}
		if (sortPageDir == "desc"){
			data.result.reverse();
		}
		
		var i=0,
			$s = "";
		for (i=0; i<data.result.length; i++){
			$s += generateItem(data.result[i]);
		}
		$("#list-product").html($s);
		$("#pagination").html(data.pagination);
	}

	function getAll(index){
		var brand = [];
		$("input:checkbox[name=brand]:checked").each(function()
		{ 
			brand.push($(this).attr('value'));
		});

		var lowprice = $("#slider-range").slider("values",0),
			highprice = $("#slider-range").slider("values",1);

		var cat;
		$(".cate_li").each(function(){
			if ($(this).hasClass("active")) {
				cat = [];
				cat.push($(this).attr("cateid"));
				$(this).find("li").each(function(){
					cat.push($(this).attr("cateid"));
				});
			};
		});
		var sortBy = $("#sort").val();
		var sortDir = $("#sortDir").val();

		var sortPageBy = $("#sortPage").val();
		var sortPageDir = $("#sortPageDir").val();


		index = index || 0;
		$.post(
			base_url + "default/product/index/" + index,
			{
				ajax: true,
				brand: brand,
				lowprice: lowprice,
				highprice: highprice,
				cat:cat,
				sortBy: sortBy,
				sortDir:sortDir
			},
			function(d) {
				if (!d.result){
					$("#list-product").html("<p id='no-item-error'>No item satisfies the search condition</p>");
                    $("#pagination").empty();
				}
				else {
					data = d;
					print_result(sortPageBy,sortPageDir);
				}
			},
			"json"
		);
	}

	$(".menu_left > ul").attr("id","cate_menu");
	$("#menu-left-dropdown > ul").prepend('<li class="cate_li active" catename="All products" cateid="0">All Products</li>')
	$(".cat_menu").menu();
    $(".cat_menu li").css({
        "width":"235px",
        "padding":"15px"
        });

	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: 20000000,
		values: [ 0, 20000000 ],
		step:200000,
		slide: function( event, ui ) {
	       $(".slider").hide();
			$( "#amount" ).val( "VND " + ui.values[ 0 ] + " - VND " + ui.values[ 1 ] );
		},
		stop: function(event, ui) {
			getAll();
		}
	});

	$( "#amount" ).val( "VND " + $( "#slider-range" ).slider( "values", 0 ) +
		" - VND " + $( "#slider-range" ).slider( "values", 1 ) );

	$(".brands-select").bind("change",function(){
	    $(".slider").hide();
        $(".banner").hide();
		getAll();
	});

	$("#sort").bind("change",function(){
	    $(".slider").hide();
        $(".banner").hide();
	    $("#sortPage").val($(this).val());
	    $("#sortPageDir").val($("#sortDir").val());
		getAll();
	});

	$("#sortDir").bind("change",function(){
	    $(".slider").hide();
        $(".banner").hide();
		getAll();
	});

	$("#sortPage").bind("change",function(){
	    $(".slider").hide();
        $(".banner").hide();
		var sortPageBy = $("#sortPage").val();
		var sortPageDir = $("#sortPageDir").val();
		print_result(sortPageBy,sortPageDir);
	});

	$("#sortPageDir").bind("change",function(){
	    $(".slider").hide();
        $(".banner").hide();
	    var sortPageBy = $("#sortPage").val();
		var sortPageDir = $("#sortPageDir").val();
		print_result(sortPageBy,sortPageDir);
	});

	$(".cate_li").on("click", function(e){
	    $(".slider").hide();
        $(".banner").hide();
		e.stopPropagation();
		$(".cate_li").removeClass("active");
		$(this).addClass("active");
        var name = $(this).attr('catename');
        $("#category-title").text(name);
		getAll();
	});

	$("#pagination").on("click","a",function(e){
		e.preventDefault();
        $(".slider").hide();
        $(".banner").hide();
		$("#sortPage").val($(this).val());
	    $("#sortPageDir").val($("#sortDir").val());
		var link = $(this).attr("href").split(/\//g).pop();
		getAll(link);
		return false;
	});

	getAll();
});
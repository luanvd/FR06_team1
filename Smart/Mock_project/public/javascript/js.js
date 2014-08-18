/**
 * 
 */

$(function(){
	$("#catetree").nestable({
		group:1
	})
	.on("change",function(){
		var data = $('#catetree').nestable("serialize");
		var $json = createOut(data,0,0);
		$json = JSON.parse("{" + $json.slice(0,$json.length - 1) + "}"); 
		$.ajax({
			type:"POST",
			url:"move_process",
			data:{data: $json}
		});
	});

	function createOut(data,parent,level){
		var out ="";
		var i;
		if (!parent){
			parent = 0;
		}
		if (!level){
			level = 0;
		}
		for (i=0; i<data.length; i++){
			out += '"' + data[i]['id'] + 'a":"' + parent + '",';
			if ((typeof data[i]['children']) == "object"){
				out += createOut(data[i]['children'],data[i]['id'],level=1);
			}
		}
		return out;
	}

	function getOrder(){
    	var out = [],
		count=1;
		$("#slider-sort-container").each(function(){
			$(this).find("li").each(function(){
				var current = $(this);
				tmp = '{' +  
					   '"pro_id":"' + current.attr('pro') + '",' +
					   '"img_link":"' + current.attr('img') + '",' +
					   '"img_order":"' + count++ +
					  '"}';
				tmp = JSON.parse(tmp);
				out.push(tmp);
				
			});
		});
		return out;
    }

    function update(){
    	$json = getOrder();
      	$.ajax({
			type:"POST",
			url:"slider/setOrder",
			data:{data: $json},
			success:function(e){
				//console.log(e);
			}
		});
    }

	$(".slider-select").bind("change",function(){
		var current = $(this);
		tmp = '{' +  
			   '"pro_id":"' + current.attr('pro') + '",' +
			   '"img_link":"' + current.attr('img') + '",';
		
		if (current.is(":checked")){
			tmp += '"img_order":"' + 'add' +
			   	   '"}';
		}
		else {
			tmp += '"img_order":"' + 'del' +
			   	   '"}';
		}
		$json = JSON.parse(tmp);
		console.log($json);
		$.ajax({
			type:"POST",
			url:"/administrator/products/setSlider",
			data:{slider: $json},
			success:function(e){
				console.log(e);
			}
		});
	});

	$(".slider-delete").click(function(e){
		var press = confirm("Delete this banner items ???");
		if (press == true){
			$(this).parent().remove();
			update();
		}
	});


    $( "#slider-sort-container" ).sortable({
	      stop: function(){
		      	update();
	      }
	    });

	$( "#slider-sort-container" ).disableSelection();
});
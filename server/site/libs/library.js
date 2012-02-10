/**
 * 
 */
$(document).ready(function(){
	$(document).scrollTop(0);
	
	var listTopHeight = $(".listTop").css("height");
	listTopHeight = parseInt(listTopHeight.replace("px",""));
	$("div.showDescription").css("top",listTopHeight+85);
	
	$(document).scroll(function(){
		var scrollDocument = $(document).scrollTop();
		var listTopHeight = $(".listTop").css("height");
		listTopHeight = parseInt(listTopHeight.replace("px",""));
		if(scrollDocument < 150){
			$("div.showDescription").css("top",listTopHeight+85);
		}else{
			$("div.showDescription").css("top",scrollDocument+20);
		}
	});
	var clientHeight = ($(window).height()-100)+"px";
	$("div.showDescription").css("height",clientHeight);
	$("div.blocShow").css("cursor","pointer");
	$("div.blocShow").click(function(){
//		$("div.showDescription").hide("fade");
		var id = $(this).attr("id");
		$("div.showDescription").html("");
		$("div.showDescription").append(
				$("<div></div>")
				.css("text-align","center")
				.append(
						$("<img/>",{ src: "images/ajax-loader.gif"})
				)
		);
		$.ajax({
			url: "TVShowDescription.php?id="+id,
			dataType: "html",
			success: function(data){
				$("div.showDescription").html("");
				$("div.showDescription").append(data);
				
//				setTimeout('$("div.showDescription").show("fade");',500);
			}
		});
		
		// on met le fan art en plein écran
		var title = $(this).attr("name");
		$("body").css("background-image","url('"+$("img[name=fanart_"+id+"]").attr("src")+"')");
	});
});
function showSeason(i){
		console.log("ok");
	$("#season_"+i).addClass("active");

}
function sleep(milliSeconds){
	var startTime = new Date().getTime(); // get the current time
	while (new Date().getTime() < startTime + milliSeconds); // hog cpu
}
function goto(i){
	 $('html, body').animate({  
	        scrollTop:$("#"+i).offset().top  
	    }, 'slow');  
//	$window.location = "#"+i;
}
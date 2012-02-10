/**
 * 
 */
$(document).ready(function(){
	
});
function showMovie(id,title){
	console.log("fanart/"+title+".tbn");
	$("body").css("background-image","url('fanart/"+title+".tbn')");
	$.ajax({
		url: "MoviesDescription.php?id="+id,
		dataType: "html",
		success: function(data){
			$("#description").html(data);
			$(".modal").modal({
				backdrop: false
			});
			$(".modal").css("width","700px");
		}
	});
}
function closeDescription(){
	$(".modal").modal("hide");
	
}
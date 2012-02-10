/**
 * 
 */
$(document).ready(function(){
	
});
function subDir(dir){
	$.ajax({
		url: "?ajax=subdir&dir="+dir,
		dataType: "json",
		type: "GET",
		success: function(data){
			$("ul.listDirs li").remove();
			var a1 = $("<a></a>", {href: "javascript:subDir('"+data[0]+"/..');"})
				.css("display","inline")
				.append("<i></i>").addClass("icon-arrow-up");
			var a2 = $("<a></a>", {href: "javascript:subDir('');"})
				.css("display","inline")
				.html("Parent");
			$("<li></li>").append(a1).append(a2).appendTo($("ul.listDirs"));
			for(var i in data){
				var a1 = $("<a></a>",{href: "javascript:subDir('"+data[i]+"');"})
					.css("display","inline")
					.append("<i></i>").addClass("icon-chevron-right");
				var a2 = $("<a></a>")
					.css("display","inline")
					.html(data[i]);
				$("<li></li>").append(a1).append(a2).appendTo($("ul.listDirs"));
			}
		}
	})
}
function addDir(){
	var dirname = $("input[name=dirToAdd]").val();
	$.ajax({
		url: "?ajax=adddir&dir="+dirname,
		dataType: "json",
		type: "GET",
		success: function(data){
			console.log(data);
		}
	});
	
}
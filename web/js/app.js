function checkDate(id, value){
	var isGood = confirm("Are you sure you want to update this match as " + value + " ?");

	var player1 = $("#"+id).find("td").eq(0).text();

	if(isGood){
		$.ajax({
		type: 'POST',
		url: '/match/change-result',
		data: {player1: player1, id: id, result: value},
		dataType: 'json',
		success: function(result){
				if($("#played").length > 0){//If played matches table exists					
					$("#"+id).clone().appendTo("#played");
					$("#played td:last").replaceWith("<td><strong>" + value + "</strong></td>");
					if(value == "WON"){
						$("#played tr:last").addClass("success");
					}else if(value == "LOST"){
						$("#played tr:last").addClass("danger");
					}					
					$("#"+id).remove();
				}else{//If played matches table doesn´t exist
					$("#no-played").remove();
					$("#played-container").append("<table class=\"table table-striped table-bordered\" id=\"played\"><thead><tr><th>Player 1</th><th>Player 2</th><th>Club</th><th>Date</th><th>Time</th><th>Comments</th><th>Result</th></tr></thead></table>");
					if(value == "WON"){
						//$("#"+id).addClass("success");
						$("#"+id).clone().addClass("success").appendTo("#played");
					}else if(value == "LOST"){
						//$("#"+id).addClass("danger");
						$("#"+id).clone().addClass("danger").appendTo("#played");
					}
					$("#played td:last").replaceWith("<td><strong>" + value + "</strong></td>");
					$("#"+id).remove();
				}
				alert("The match was updated correctly");
			}
		});
	}else{
		alert("This match won't be updated");
	}
	
}



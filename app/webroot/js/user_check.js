$(function() {
	$("form").submit(function() {
		if(!$("#UserUsername").val().match(/^[0-9a-zA-Z_]{4,20}$/) || !$("#UserPassword").val().match(/^[0-9a-zA-Z]{4,16}$/)) {
			alert("入力エラー");
			return false;
		}
		return true;
	});
});

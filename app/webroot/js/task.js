$(function() {
	setInterval(update, 1000);
  $("#AddSubmit").click(function() {
		var data = {
			todo: $("#TaskTodo").val(),
			date: $("#TaskDateYear").val() + "-" + $("#TaskDateMonth").val() + "-" + $("#TaskDateDay").val(),
			time: $("#TaskTimeHour").val() + ":" + $("#TaskTimeMin").val() + ":00",
			hour: $("#TaskHour").val(),
			minute: $("#TaskMinute").val()
		};
		$.ajax({
			type: "POST",
			url: "/todolist/tasks/ajax_submit",
			data: data,
			success: function() {
				alert('追加されました。');
			},
			error: function() {
				alert('失敗しました。');
			}
		});
  });
});

function h(text) {
  return text.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#039;").replace(/</g,"&lt;").replace(/>/g,"&gt;");
}

function update() {
	$.getJSON("/todolist/tasks/ajax_get_data", function(data) {
		var html = "";
		for(i = 0; i < data.length; i++) {
			html += "「" + h(data[i]["Task"]["todo"]) + "」が追加されました。";
			html +=  "(" + h(data[i]["Task"]["created"]) + ")<br>";
		}
		$("#latest").html(html);
	});
}

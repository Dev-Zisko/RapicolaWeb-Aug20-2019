var validate = 0;
var people = 0;
var disponibles = 0;

setInterval(function(){
	principal();
}, 2000);


function principal(){
	var tablaDatos = $("#datos");
	var route = "http://localhost:8000/realtime";
	var input = $("#dato");
	var id = $(input).val();
	$.get(route+"/"+id, function(res){
		$(res).each(function(key, value){
			if(validate == 0){
				people = value.people;
				disponibles = value.disponibles;
				tablaDatos.append("<tr><td>"+value.disponibles+"</td><td>"+value.people+"</td></tr>");
				validate = 1;
			}
			if(validate == 1){
				if(people != value.people || disponibles != value.disponibles){
					people = value.people;
					disponibles = value.disponibles;
					tablaDatos.children("tr").remove();
					tablaDatos.append("<tr><td>"+value.disponibles+"</td><td>"+value.people+"</td></tr>");
				}
			}
		});
	});
}
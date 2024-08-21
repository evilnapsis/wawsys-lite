<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Hola</h1>
<p class="alert alert-warning">Esta es una alerta!</p>
<a href="./?view=vistax2">Vista X2</a>
<button id="ajaxme" class="btn btn-primary">AJAX ME</button>

</div>

	
</div>
</div>
<script>
$("#ajaxme").click(function(){
	$.get("./?action=nuevoaction","",function(data){
		console.log(data);
	})	
});
</script>
$( document ).ready(function() {
    var clipboard = new ClipboardJS('.btn');
    $('#copiar').click(function(){
    	alert("Enlace copiado!");
    });
});
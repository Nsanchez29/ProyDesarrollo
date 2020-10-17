$(document).ready(function(){
	$(document).on("click", "#btnModal", function(){
		var numero=$(this).data('numero');
		var mesa=$(this).data('mesa');
	
		$('#ModalMesero').modal('show');
		$('#numero').val(numero);
		$('#mesa').val(mesa);
	});
});
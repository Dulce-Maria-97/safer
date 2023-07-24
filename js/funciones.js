function alerta(jcla, jmsj, jcbz) {
	if ($("#m_head_alerta").hasClass("bg-danger")) $("#m_head_alerta").removeClass("bg-danger");
	if ($("#m_head_alerta").hasClass("bg-info")) $("#m_head_alerta").removeClass("bg-info");
	if ($("#m_head_alerta").hasClass("bg-warning")) $("#m_head_alerta").removeClass("bg-warning");
	if ($("#m_head_alerta").hasClass("bg-success")) $("#m_head_alerta").removeClass("bg-success");
	$("#m_head_alerta").addClass(jcla);
	$("#m_txt_alerta").text(jcbz);
	$("#m_l_alerta").html(jmsj);
	$("#m_alerta").modal();
/* setTimeout(function(){ $("#m_alerta").modal('hide'); }, 3000); */
}
function windowScrolled(obj){
	var currentTarget = obj;
	if(currentTarget.pageYOffset > 20)
	{
		$("#header").addClass("scrolled");
	}else{
		$("#header").removeClass("scrolled");
	}
}
$(window).on('scroll', function(obj) {
	windowScrolled(obj.currentTarget);
})
$(document).ready(function(){
	windowScrolled(window);
})
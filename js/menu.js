$(function(e){
	 $('li.g-button').click(function(e , domEle){

	     $('li.selected').each(function(e){
	     	$(this).removeClass('selected');
	     });
	     	$(this).toggleClass("selected");
	     
	     
	 });
	 
});
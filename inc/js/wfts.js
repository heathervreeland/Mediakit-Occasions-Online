jQuery.noConflict();
//Shadowbox.init();

jQuery(document).ready(function($){

  /* 
   * Form specific javascript
   * Hides 'value' content of form upon focus and returns 'value' content when not in focus
   * 
   **********************************************************/
  $("input:text").focus(function() {
    if( this.value == this.defaultValue ) {
      this.value = "";
    }
  }).blur(function() {
    if( !this.value.length ) {
      this.value = this.defaultValue;
    }
  });

  var parentlink = $('.nav-meet-nicole > a');
  $(parentlink).replaceWith('<a>' + parentlink.text() + '</a>');
  /*
  $('.menu ul li').each(function(){
    var anchor = $(this).first();
    var content = anchor.text()
    $(this).has('ul').first().replaceWith('<span>' + content + '</span>');
    if($(this).has('ul')) {
      var anchor = $(this).first('a');
      var content = anchor.text()
      $(anchor).replaceWith(content);
    }
  });
  */

}); // end ready()


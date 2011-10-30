jQuery.noConflict();

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

  /*  
   * Remove last pipe from menus
   *************************************************************/
  $('.menu-sub-header li .pipe').last().remove();

}); // end ready()


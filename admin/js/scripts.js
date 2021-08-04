$(document).ready(function() {
    $('#summernote').summernote({
      height:200
    });
  });

  $(document).ready(function() {
    $('#selectAllBoxes').click(function(event){
      if(this.checked) {
        $('.checkboxes').each(function(){
          this.checked = true;
        })
      } else {
        $('.checkboxes').each(function(){
          this.checked = false;
        })
      }
    }) 
  });


function loadUsersOnline() {
  $.get("functions.php?onlineusers=result",function(data) {
    $(".usersonline").text(data);
  });
}

setInterval(function(){
  loadUsersOnline();
},500);

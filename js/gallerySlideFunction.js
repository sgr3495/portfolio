$(document).ready(function(){
  //$('#slideshow').desoSlide('rebuild');
  // Get all thumbs (an array of objects)
  //var my_thumbs = $('#slideshow').desoSlide('#thumbnail');

  $('#slideshow').desoSlide({
      thumbs: $('.thumbnail li > a'),
      effect: {
          provider: 'animate',
          name: 'fade'
      },
      auto:{
        start:true
      },
      overlay: 'none',
      interval: 5000
  });
});

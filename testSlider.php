<!DOCTYPE html>
<html>
<head>


	<section>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<style type="text/css">
    #slider{
        width: 800px;
        height: 400px;
        overflow: hidden;
    }
    #slider .slides{
        width: 3200px;
        height: 400px;
        display: inline-block;
        margin: 0;
        padding: 0;
    }
    #slider .slide{
       list-style-type: none;
       float: left;
       padding: 0;
    }
    #slider .slide img{
      width: 180px;
      height: auto;
      padding: 10px;
    }
	</style>
</head>
<body>
<div style="background-color: grey">
<div id="slider">
	<ul class="slides">
		    <li class="slide" class="sl"><img src="http://manor.net.au/wp-content/uploads/2015/06/4103-720x400.jpg"/></li>
  			<li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@mississippi/documents/media/clouds-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>

        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>

        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
  			
  			<li class="slide" class="sl"><img src="http://manor.net.au/wp-content/uploads/2015/06/4103-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@mississippi/documents/media/clouds-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
        <li class="slide"><img src="http://www.nature.org/cs/groups/webcontent/@web/@china/documents/media/giant-panda-720x400.jpg"/></li>
	</ul>
</div>
</div >
	<script type="text/javascript">
	'use strict';

	$(function(){

		var width=800;
        var pause=3000;
        var currentSlide=0;

		var $slider=$('#slider');
		var $slideContainer=$slider.find('.slides');
		var $slide=$slideContainer.find('.slide');
		var interval;
        
        function startSliding() {
        interval=setInterval(function(){
		$slideContainer.animate({'margin-left':'-='+width},2000,
	   function(){

				      currentSlide=currentSlide +4;
            //  alert('currentSlide:'+currentSlide);
             // alert($slide.length);
				      if(currentSlide==$slide.length -4 )
				      {
				      	currentSlide=0;
				      	$slideContainer.css('margin-left',0);
				      }
                });
                  	},pause);
                                }

            function stopSliding(){
            	clearInterval(interval);
            }

       $slider.on('mouseenter',stopSliding).on('mouseleave',startSliding);
       startSliding();
		
	             });
	</script>

  </section>

</body>
</html>
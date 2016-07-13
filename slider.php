<div id="slider_pack" class="  col-xs-12 col-xs-offset-0  col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2" style="margin-top: 30px;">
<!--	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>  -->
	<style type="text/css">
    #slider{
        width: 680px;
        height: 400px;
        overflow: hidden;
    }
    #slider .slides{
        width: 3200px;
        height: 10px;
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
      width: 150px;
      height:250px;
      margin:10px;
      border: 7px solid black;
      box-shadow: 10px 10px 7px grey;
    }
	</style>


<div style="">
<div id="slider">
	<ul class="slides">
		    <li class="slide" class="sl"><img src="book/images/7bf8d6311a.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/6bc1ac521d.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/42c8043b2d.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/434b953580.jpg"/></li>

        <li class="slide" class="sl"><img src="book/images/7bf8d6311a.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/6bc1ac521d.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/42c8043b2d.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/434b953580.jpg"/></li>

        <li class="slide" class="sl"><img src="book/images/7bf8d6311a.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/6bc1ac521d.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/42c8043b2d.jpg"/></li>
        <li class="slide" class="sl"><img src="book/images/434b953580.jpg"/></li>
  			
        
	</ul>
</div>
</div >
	<script type="text/javascript">
	'use strict';

	$(function(){
           var width;
           resize();
          $(window).resize(resize);
          
          function resize(){
             var w=$('.container').width();
            if (w>= 720) {
                           width=680;
                           $('#slider').css({
                               'width':'680',
                               'height':'400',
                           })
                           $('#slider .slide img').css({
                             'width': '150px',
                             'margin':'10px',
                           })
                           $('#slider_pack').css({
                              'padding-left':15+'px',
                           })
                   } else {
                        width=w;
                           $('#slider').css({
                               'width':''+w,
                               'height':''+(((((w/4)/30)*28)*2)+30)+'px',

                           })

                           $('#slider .slide img').css({
                             'width': ''+(((w/4)/30)*28)+'px',
                             'margin':''+(((w/4)/30)*1)+'px',
                             'height':''+((((w/4)/30)*28)*2)+'px',
                             'border':'3px solid black'+'px',
                           })


                           $('#slider_pack').css({
                              'padding-left':'0',
                           })
                   }
          }
	//	var width=$('#slider').width();// var sliderwidth=$('#slider').width();
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

  </div>
$(function () {

  $('#direction_to_register').on('click',function(e){
    e.preventDefault();
    $(location).attr("href",'signin.php?register');
   //  $("#signinform").slideUp(500);
    //$('#signupform').css({display:'block'});
  })

  $('#btnaddbook01').on('click',function(event){
    event.preventDefault();
    var dt=$("#form").serialize();
    //$('#txt').text($data);
//$("div").text($("form").serialize());
      $.ajax({
      type:'GET',
      url:'addbook.php',
      data:dt,
      success:function(data){
        $('#txt').html(data);
      }

        })
          });//end #btnaddbook



 $('#btnaddbooktest').on('click',function(event){
    event.preventDefault();
   // var dt=$("#formtest").serialize();
    var isbn=$('#isbntest').val();
     url = "testaddbook.php?dt="+isbn;
               $(location).attr("href", url);
   // alert(isbn);
    //$('#txt').text($data);
//$("div").text($("form").serialize());
   /*   $.ajax({
      type:'GET',
    //  url:'https://www.googleapis.com/books/v1/volumes?q=isbn:'+isbn,
      url:'https://www.googleapis.com/books/v1/volumes?q='+isbn,
      success:function(data){
         url = "testaddbook.php?dt="+data;
               $(location).attr("href", url);
                  //  $('#txt').text(data['items'][0]['volumeInfo']['imageLinks']['thumbnail']);// img
                   // $('#txt').text(data['items'][0]['volumeInfo']['language']);
               //  $('#txt').text(data['items'][0]['volumeInfo']['industryIdentifiers'][1]['type']);isbn-13
               // $('#txt').text(data['items'][0]['volumeInfo']['industryIdentifiers'][0]['type']);isbn-10
             //  $('#txt').text(data['items'][0]['volumeInfo']['publishedDate']);
       //      $('#txt').text(data['items'][0]['volumeInfo']['authors'][0]);
            //alert(data['items'][0]['volumeInfo']['title']);
          //   $('#txt').text(data['items'][0]['volumeInfo']['title']);
      }

        }) */
          });//end #btnaddbook   

 //################## addbook

$('#addbooklist' ).on('click','button',function(e){
    event.preventDefault();
    var isbn=$(this).attr('name');
   // alert($("#"+isbn).serialize()); 

    
    var dt=$("#"+isbn).serialize(); 
    //$('#txt').text($data);
//$("div").text($("form").serialize());
      $.ajax({
      type:'GET',
      url:'addbook.php',
      data:dt,
      success:function(data){
        //$('#txt').html(data);
        alert(data);
      }

        })
          });
  
  // alert( $("#"+isbn).find("[name='title']").val());

 //################## addbook






  $('#btnsearchbook').on('click',function(){
    var dat=$('#searchbook').val();
    
    $.ajax({
      type:'GET',
      url :'searchbook.php',
      data:{book:dat},
      success:function (data){
        //$('#findbooks').load('searchbook.php');
        $('#findbooks').html(data);
      }
    });//alert (dat);
  })
// KEY UP FOR FIRE FUNCTION
  $('#searchbook').keyup(function(e) {
  // if(e.keyCode == 13){
     
   
    var dat=$('#searchbook').val();
    if(dat !='') {
    
    $.ajax({
      type:'GET',
      url :'searchbook.php',
      data:{book:dat},
      success:function (data){
        $('#searchlist').html(data);
        // $('#findbooks').slideDown(300);
      }
    });
  }else  { 
     $('#findbooks').slideUp(300);
         }
  })

  $('body').click(function(evt){    
       if(evt.target.id == "searchbook"){}else{
           $('#findbooks').slideUp(300);
           $('#searchbook').val('');
           //$('#searchlist').html('');
       }
       
       //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
     //  if($(evt.target).closest('#headersearchbook').length)
      //    {}  else{ alert(1);}    ;    

      //Do processing of click event here for every element except with id menu_content

});


  $('#searchlist' ).on('click','.btnfindbook',function(){
    var isbn=$(this).attr('name');
    if (isbn!='') {
        //alert(isbn);
         //$_SESSION['isbn']=isbn;
        $.ajax({
          type:'GET',
          url:'isbn-user.php',
          data:{isbn:isbn},
          success:function(data){
                 //alert(data);
          }
           
               });
    }
               url = "isbn-user.php";
               $(location).attr("href", url);
  })


  $('#ul_findbooksnearme' ).on('click','button',function(){
    var isbn=$(this).attr('name');
    if (isbn!='') {
        //alert(isbn);
         //$_SESSION['isbn']=isbn;
        $.ajax({
          type:'GET',
          url:'isbn-user.php',
          data:{isbn:isbn},
          success:function(data){
                 //alert(data);
          }
           
               });
    }
               url = "isbn-user.php";
               $(location).attr("href", url);
  })




  $('#btnsignup').on('click',function(event){
    event.preventDefault();
    $("#signinform").slideUp(500);
    $('#signupform').css({display:'block'});
  })

  $('#btn-search').on('click',function(event){
    event.preventDefault();

    var bookname=$('#search-book').val();
    var st1=$('#adrs-st').val();
    var ct1=$('#adrs-ct').val();
    var cr1=$('#adrs-cr').val();
    if  ($.trim(st1)=='' || $.trim(ct1)=='' || $.trim(cr1)=='') {
      $('#txt').html('plz fill all address optinos');
        }
        else{
          $.ajax({

            type:'GET',
            url :'calculate/addresstocoor.php',
            data:{st:st1,ct:ct1,cr:cr1},
            success:function(data){
              $('#txt').html(data);
            }
          })
        }
})


   
   //########## send message
   $('.toggleSendMessage').on('click',function(e){
    e.preventDefault();
    var $temp=$(this);
    $temp.next('div').toggle(300);
   })

   $('.borrowlist').on('click','button',function(){
      // var name=$(this).attr('name');
       // alert($(this).prev('.mytext').val());
        var txtmessage=$(this).prev('.mytext').val();
       if ( txtmessage.trim()=='' )  {txtmessage='I would like to borrow the book,please'}
      // var username=$(this).data("username");
       var idsender=$(this).data("idsender");
       var idrecipient=$(this).data("idrecipient");
       var idbook=$(this).data("idbook");
       var title=$(this).data("title");
       var imagebook=$(this).data("imagebook");
       
       $(this).prev('.mytext').val('');
     //  alert('sender:'+idsender+' recipient:'+idrecipient+' isbnbook:'+idbook+'message:'+txtmessage+'title:'+title+'imagebook:'+imagebook);
       $.ajax({
        type:'GET',
        url:'sendmessage.php',
        data:{sender:idsender,recipient:idrecipient,isbn:idbook,title:title,imagebook:imagebook,message:txtmessage},
        success:function(data){
         //   alert(data);
        }
       })

   /*  $.ajax({
        type:'GET',
        url:'notification.php',
        data:{user:username},
        success:function(data1){
            alert(data1);
        }

       }) */
   })


   $('.in_ul_new_msg').on('click','button',function(){
      // var name=$(this).attr('name');
       // alert($(this).prev('.mytext').val());
        var txtmessage=$(this).prev('.mytext').val();
       if ( txtmessage.trim()=='' )  {txtmessage='I would like to borrow the book,please'}
      // var username=$(this).data("username");
       var idsender=$(this).data("idsender");
       var idrecipient=$(this).data("idrecipient");
       var idbook=$(this).data("idbook");
       var title=$(this).data("title");
       var imagebook=$(this).data("imagebook");
       
       $(this).prev('.mytext').val('');
       alert('sender:'+idsender+' recipient:'+idrecipient+' isbnbook:'+idbook+'message:'+txtmessage+'title:'+title+'imagebook:'+imagebook);
       $.ajax({
        type:'GET',
        url:'sendmessage.php',
        data:{sender:idsender,recipient:idrecipient,isbn:idbook,title:title,imagebook:imagebook,message:txtmessage},
        success:function(data){
         //   alert(data);
        }
       })

   })


   $('.section_reply_all_msg').on('click','button',function(){
      // var name=$(this).attr('name');
       // alert($(this).prev('.mytext').val());
        var txtmessage=$(this).prev('.mytext').val();
       if ( txtmessage.trim()=='' )  {txtmessage='I would like to borrow the book,please'}
      // var username=$(this).data("username");
       var idsender=$(this).data("idsender");
       var idrecipient=$(this).data("idrecipient");
       var idbook=$(this).data("idbook");
       var title=$(this).data("title");
       var imagebook=$(this).data("imagebook");
       
       $(this).prev('.mytext').val('');
      // alert('sender:'+idsender+' recipient:'+idrecipient+' isbnbook:'+idbook+'message:'+txtmessage+'title:'+title+'imagebook:'+imagebook);
       $.ajax({
        type:'GET',
        url:'sendmessage.php',
        data:{sender:idsender,recipient:idrecipient,isbn:idbook,title:title,imagebook:imagebook,message:txtmessage},
        success:function(data){
         //   alert(data);
        }
       })

   })

   $('.chat_name').on('click',function(e){
       e.preventDefault();
       $temp=$(this)
       $temp.next('div').toggle(2000);
       $temp=$temp.next('div');
       $temp.find('.textarea_button_all_msg').slideUp(1000);

   })
   //##############profile edit

   $('#formchangepic').on('submit',function(e) {
    e.preventDefault();
    $form=$(this);
    var formdata=new FormData($form[0]);
    var request=new XMLHttpRequest();

          request.upload.addEventListener('progress',function(e){
            var percent= e.loaded/e.total *100;
            $('#progress-bar').width(percent+'%');
          })
    
            request.open('post','changeprofilepic.php');
            request.send(formdata);
            request.onreadystatechange = function() {
               if ( request.status == 200  && request.readyState == 4) {
                     $('#editprofilepic-msg').text(request.responseText);

               if (request.responseText.trim()=='The image has uploaded') {
                     setTimeout(function(){ document.location.reload(true); }, 1500);
            }
        }
     }
 })

   $('#edit_name').on('click',function(e){
    e.preventDefault();
    var name=($('#edit_input_name').val()).trim();
    if (name.length == 0) {alert('plz enter the name'); }
    else{
        $.ajax({
          type:'GET',
          url:'editprofile_fun.php',
          data:{name:name},
          success:function(data){
               $('#edit_name_text').css({'display':'block'});
               $('#edit_name_text').html(data);
               setTimeout(function(){ document.location.reload(true); }, 1500);
          }// success
        })//$.ajax
        }//else
   })


   // get lat and lon for change the address
  $('#editprofile_find_address').on('click',function(event){
    event.preventDefault();

    var st1=$('#editprofile_adrs_st').val();
    var ct1=$('#editprofile_adrs_ct').val();
    var cr1=$('#editprofile_adrs_cr').val();
    if  ($.trim(st1)=='' || $.trim(ct1)=='' || $.trim(cr1)=='') {
      $('#editprofile_adrs_txt').html('plz fill all address optinos');
        }
        else{
          $.ajax({

            type:'GET',
            url :'calculate/addresstocoor.php',
            data:{st:st1,ct:ct1,cr:cr1},
            success:function(data){
              $('#editprofile_adrs_txt').html(data);
              $lat=$('#lat').val();
              $lon=$('#lon').val();
              if ($lat!=''  && $lat!='') {
                 $('#confirm_address').css({'display':'block'});

              };
            }
          })// $.ajax
        }//end else
})

  // confirm and update the address
      $('#confirm_address').on('click',function(e){
        e.preventDefault();
         var lat=$('#lat').val();
         var lon=$('#lon').val();
         var adrs=$('#address').val();
         $.ajax({
            type:'GET',
            url :'editprofile_fun.php',
            data:{lat:lat,lon:lon,address:adrs},
            success:function(data){
               $('#editprofile_adrs_txt').html(data);
               setTimeout(function(){ document.location.reload(true); }, 1500);
             }
         })

      })






 //##############profile edit   
     
     $('#alarmNewMessage').on('click',function(e){
          e.preventDefault();
          window.location="replytonewmsg.php";
     
     })

//########shelf_book

$('#ul_shelf_book').on('click','button',function(e){
  e.preventDefault();
  var temp=$(this);
  var isbn=temp.data('isbn');
  var con=confirm("Are you sure that you want to permanently delete this book from your shelf book");
  if (con===true) {
    $.ajax({
      type:'GET',
      url:'delete_book.php',
      data:{isbn:isbn},
      success:function(data){
          
          setTimeout(function(){ document.location.reload(true); }, 1500);
      }// end of success

    })//end of ajax
  }//end of if
  
})


// change pass
$('#edit_pass_get_oldpass_btn').on('click',function (e){
  e.preventDefault();

   $('#edit_pass_text').css({'display':'none','color':'blue',})
   $('#edit_pass_text').text('');

  var oldpass=$('#edit_pass_get_oldpass_input').val();
      oldpass=$.trim(oldpass);

      $.ajax({
        type:'GET',
        url:'changepassword.php',
        data:{oldpass:oldpass},
        success:function(data){
          if (data=='refresh') {window.location.href ="logout.php";}
              if (data=='ok') {

                $('#edit_pass_get_oldpass').css({'display':'none',});
                $('#edit_pass_get_newpass').css({'display':'inline-block',});

                $('#edit_pass_get_newpass_btn').on('click',function (e){
                e.preventDefault();

                var newpass01=$('#edit_pass_get_newpass_input01').val();
                    newpass01=$.trim(newpass01); 
                var newpass02=$('#edit_pass_get_newpass_input02').val();
                    newpass02=$.trim(newpass02); 

                    $.ajax({
                        type:'GET',
                        url:'changepassword.php',
                        data:{newpass01:newpass01,newpass02:newpass02},
                        success:function(data){
                          
                              if (data=='password changed') {
                                $('#edit_pass_text').css({'display':'block','color':'green',})
                                $('#edit_pass_text').text(data);
                                //$('#edit_pass_get_newpass').css({'display':'none'});

                              }else{
                                $('#edit_pass_text').css({'display':'block','color':'red',})
                                $('#edit_pass_text').text(data);
                              }
                           }// end of second success
                    })

               }); // end of click of edit_pass_get_newpass_btn   


              }else{
                $('#edit_pass_text').css({'display':'block','color':'red',})
                $('#edit_pass_text').text(data);
              }
        }// end first success
      })// enf of ajax

      })// end 
// end changepass







})






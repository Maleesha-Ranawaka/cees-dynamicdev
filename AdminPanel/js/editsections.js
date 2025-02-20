//KDW:12:09:2019 

// fill Program Title select box 
$('#pageType').on('change', function() {
var PageType=$('#pageType').val();

    $.ajax({
        type: "POST",
        url: "AdminModel/EditSectionHedder.php",
        data: {PageType:PageType,method:'searchTitle'},
        success: function(data){
            $('#proTitle')
            .find('option')
            .remove()
            .end()
           var res = $.parseJSON(data);
           var len = res.length;
           for(var i=0; i<len; i++){
          var option=  res[i].program_title
          var value=  res[i].idprogram
            $('#proTitle').append(`<option value="${value}"> 
            ${option} 
            </option>`); 
           }
           getProgramTitles()
           showOder()
        },
        error: function (request, status, error) {
            $("#error").append(request.responseText)
          
        }
      })
   
  });

  //get add append requested data to inputs

function getProgramTitles()
{
  var ProgramID=$('#proTitle').val();
  $.ajax({
      type: "POST",
      url: "AdminModel/EditSectionHedder.php",
      data: {PageId:ProgramID,method:'searchProgram'},
      success: function(data){
         var res = $.parseJSON(data);
         var len = res.length;
         for(var i=0; i<len; i++){
         $('#Summary').val(res[i].summary);
         $('#Title').val(res[i].program_title);
         $('#ID').val(res[i].idprogram);
         $('#Image').attr('src','../'+res[i].image_url )
         
         if(res[i].status=="1"){
          $('#status-show')[0].checked = true;
         }else{
          $('#status-hide')[0].checked = true;
         }
        
       }
        
      },
      error: function (request, status, error) {
          $("#error").append(request.responseText)
        
      }
    })

}



  $( "#proTitle" ).on('change',function() {
    getProgramTitles()
  
   
  });



// Update Program Data
$("#Program_form").on('submit', function(e){
    
    e.preventDefault();

    output =  $('input[name=status]:checked', 
                '#Program_form').val(); 
               
   var formdata = new FormData(this);
   formdata.append('status', output);
   $.confirm({
    title: 'Update Data?',
    content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
    autoClose: 'cancelAction|8000',
    icon: 'fa fa-warning',
    type: 'red',
    buttons: {
        deleteUser: {
            text: 'Update Data',
            action: function () {
              
                $.ajax({
                  type: "POST",
                  data:formdata ,
                  contentType: false,
                  cache: false,
                  processData:false,
                  url: "AdminModel/EditSectionHedder.php",
                  beforeSend: function(){
                      $('.submitBtn').attr("disabled","disabled");
                      $('#Program_form').css("opacity",".5");
                    },
                    success: function(msg) {
                     $('.statusMsg').html('');
                     // document.getElementById("error").innerHTML=msg;
                      if(msg.trim() == '"ok"'){
                          $('#Program_form')[0].reset();
                          $('.statusMsg').html('<span style="font-size:15px;color:#34A853">successfully Updated.</span>');
                          $.alert('successfully Updated');
                      }else{
                          $('.statusMsg').html('<span style="font-size:15px;color:#EA4335">Some problem occurred, please try again.</span>');
                          $.alert('Some problem occurred, please try again.!');
                      }
                      $('#Program_form').css("opacity","");
                      $(".submitBtn").removeAttr("disabled");
                }
                })
            }
        },
        cancelAction: function () {
            $.alert('action is canceled');
        }
    }
  });
});
// add Choosed image to image View
  $("#file").change(function() {
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
        alert('Please select a valid image file (JPEG/JPG/PNG).');
        $("#file").val('');
        return false;
    } if((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#Image')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };
    
            reader.readAsDataURL(this.files[0]);
        }

    }
  })


  //togle oder and program
  $('input[name="options"]').change( function() {

    if($(this).val()=="Order"){
      $("#Program_form").hide();
      $("#proTitlediv").hide();
      $("#searcTitle").hide();
      $("#searchOder").show();
      $("#oder").show();
      $('.statusMsg').html('<span style="font-size:15px;color:#34A853"></span>');
      
    }else{
      $("#Program_form").show();
      $("#proTitlediv").show();
      $("#searcTitle").show();
      $("#searchOder").hide();
      $("#oder").hide();
      $('.statusMsg').html('<span style="font-size:15px;color:#34A853"></span>');
    }
  
  })

 //Show Oder 
 function showOder() {
    $("#sortable").empty();
    $('#notsortable').empty();
  
    var PageType=$('#pageType').val();
    $.ajax({
        type: "POST",
        url: "AdminModel/EditSectionHedder.php",
        data: {PageType:PageType,method:'searchTitle'},
       
        success: function(data){
           var res = $.parseJSON(data);
           var len = res.length;
           var count=1
           $("#save_oder").show();
           $("#th").show();
           if ($("#option2").is(":checked")) {
            $("#oder").hide();
         }
         if ($("#option1").is(":checked")) {
          $("#oder").show();
       }
           $('.statusMsg').html('<span style="font-size:15px;color:#34A853"></span>');
            
           for(var i=0; i<len; i++){
             if(res[i].status=="1"){
           $('#Title').val();
           $('#notsortable').append('<div class="col-col-md-4 index text-center">'+count+'</div>')
           $('#sortable').append('<li class="oder"><div class=row><div class="col col-md-10">'+res[i].program_title+'</div><div class="col col-md-2 text-center">'+count+'</div> <input  type="hidden"  id="programID" value="'+res[i].idprogram+'" ></div></li>')
           count=count+1;
             }
         }
          
        },
        error: function (request, status, error) {
            $("#error").append(request.responseText)
          
        }
      })
   
  }

  window.onload = $(function () {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    $("#Program_form").show();
    $("#proTitlediv").show();
    $("#searcTitle").show();
    $("#searchOder").hide();
    $("#oder").hide();
    $("#save_oder").hide();
     $("#th").hide();
  } );

//Update Program Oder
  $("#save_oder").on('click', function(e){
  var oderlist= getOderList()   
  var oderlist_json = JSON.stringify(oderlist);       
   $.confirm({
    title: 'Update Oder?',
    content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
    autoClose: 'cancelAction|8000',
    icon: 'fa fa-warning',
    type: 'green',
    buttons: {
        deleteUser: {
            text: 'Update Data',
            action: function () {
              
                $.ajax({
                  type: "POST",
                  data:{oderlist_json:oderlist_json,method:'oder'},
                  url: "AdminModel/EditSectionHedder.php",
                  beforeSend: function(){
                    $('#save_oder').attr("display","block");
                    $('#oder').css("opacity",".5");
                  },success: function(msg) {
                     // $("#error").append(msg)
                      if(msg.trim() == '"ok"'){
                          $('#sortable').empty();
                          $('#notsortable').empty();
                          $("#oder").hide();
                          $("#save_oder").hide();
                           $("#th").hide();
                         $('.statusMsg').html('<span style="font-size:15px;color:#34A853">successfully Updated.</span>');
                          $.alert('successfully Oder is Updated');
                      }else{
                        $('.statusMsg').html('<span style="font-size:15px;color:#EA4335">Some problem occurred, please try again.</span>');
                          $.alert('Some problem occurred, please try again.!');
                      }
                      $('#oder').css("opacity","");
                      $('#save_oder').attr("display","none");
                }
                })
            }
        },
        cancelAction: function () {
            $.alert('action is canceled');
        }
    }
  });
});


//Create OderList Obj
function getOderList() 
{
  var obj_array = new Array();

  var ul = document.getElementById("sortable");
  var items = ul.getElementsByTagName("li");
  for (var i = 0; i < items.length; ++i)
  {
    obj = new Object();
    obj.programID= items[i].getElementsByTagName("input")[0].value; 
    obj.program_order=i+1;
   obj_array.push(obj);
  }
  return  obj_array;
}
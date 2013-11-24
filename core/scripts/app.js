$(document).ready(function(){
$("#product-table").fixedHeader({
width: 900,height: 700
});
  /** Free Cab */
    $("#freecabIcon").click(function(){
		$(".freecablist").slideToggle();
		$(".lastcalllist").hide();
		$(".scriptlist").hide();
                $(".shortcutdetails").hide();
                $("#displaysettingbox").hide();
  });
  /** Script */
  $("#scriptIcon").click(function(){
		$(".freecablist").hide();
		$(".lastcalllist").hide();
                $(".shortcutdetails").hide();
		$(".scriptlist").slideToggle();
                $("#displaysettingbox").hide();
  });
  
  /** Last call record */
  $("#lastcallIcon").click(function(){
		$(".freecablist").hide();
		$(".scriptlist").hide();
                $(".shortcutdetails").hide();
		$(".lastcalllist").slideToggle();
                $("#displaysettingbox").hide();
  });
  /* Shortcut keys area*/
   $("#shortcutIcon").click(function(){
		$(".freecablist").hide();
		$(".scriptlist").hide();
                $(".lastcalllist").hide();
		$(".shortcutdetails").slideToggle();
                $("#displaysettingbox").hide();
  });
  //* hide all active area**/
  $("#homepass").click(function(){
	$(".freecablist").hide();
	$(".scriptlist").hide();
	$(".lastcalllist").hide();
        $(".shortcutdetails").hide();
        $("#displaysettingbox").hide();
  });
  
  $('.title').click(function(){
      
      $(".freecablist").hide();
	$(".scriptlist").hide();
	$(".lastcalllist").hide();
        $(".shortcutdetails").hide();
        $("#displaysettingbox").hide();
  });
  
  $(".toolsbox").hide();
  //*profile settings*/
  $("#settings").click(function(){
		$("#displaysettingbox").slideToggle();
  });
  $("#displaysettingbox").click(function(){
		$("#displaysettingbox").hide();
  });
  /*icons main*/
 $('#mega-1').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		direction: 'right'
	});
        
   $("#responsecontainer").load("php/shiftchange.php");
   var refreshId = setInterval(function() {
      $("#responsecontainer").load('php/shiftchange.php?randval='+ Math.random());
   }, 1000);
   $.ajaxSetup({ cache: false });
	
  var refreshIdW = setInterval(function()
        {
             $('#incomingStatus').load('../master/form/coreconnection.php');
             $('#onlineStatus').load('../master/form/onlinealert.php');
        }, 1000);
        
        var LastCall = setInterval(function()
        {
             $('#lastRecordCall').load('../master/form/lastRecordCall.php');
             
        }, 10000);
        var FreeCabs = setInterval(function()
        {
             $('#freeCabSList').load('../master/form/free_cabs.php');
        }, 10000);
        
        $('#menu-item-0').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
        $('#menu-item-1').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
        $('#menu-item-2').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
        $('#menu-item-3').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
        $('#menu-item-4').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
        $('#menu-item-5').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
        $('#menu-item-6').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
        $('#menu-item-7').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
        });
        $('#menu-item-8').hover(function(){
            //alert('Here i am');
            $(".freecablist").hide();
            $(".scriptlist").hide();
            $(".lastcalllist").hide();
            $(".shortcutdetails").hide();
            $("#displaysettingbox").hide();
        });
       $("#onlineStatus").blink(); 
	   /*Booking from Text area*/
	   
		$('#locResi').simplyCountable();     
      
  });

/* Main scripts */

$(document).ready(function (){    
    
    $('#currency-converter').dropdown();
    
    /*check viewport size*/
    function checkViewportSize(width){
        return viewportSize = $(window).width(); 
    }
    
    /*set appropriate text and font-size depending on viewport size*/
    function setStepsText(){
        var viewportSize = checkViewportSize($(this).width());
        if (viewportSize > 1200){
            $('#step1').text('Step 1: Choose destination');
            $('#step2').text('Step 2: Input passenger information');
            $('#step3').text('Step 3: Confirmation');
        }else{
            $('#step1').text('Destination');
            $('#step2').text('Passenger information');
            $('#step3').text('Confirmation');
        }
    }
    
    /*apply new text and font-size to steps*/
    $(function() {
        setStepsText();
        $(window).resize(function() {
            setStepsText();
        });
    }); //how this function works?

    jQuery.fn.exists = function(){return this.length>0;}; //function to check if element exists
	
    $.getScript("destination_fields_swap_and_disable.js");
        
    /* main page car buttons accordion*/
    $('#accordion').accordion({
            heightStyle: "content",
            collapsible: true,
            active: false,
            icons: false,
            create:function(event, ui){
                var currentButton = ui.header[0];
                var currentButtonArrow = $(currentButton).find('.arrow');
                
                $(currentButtonArrow).css({
                    'transform': 'rotate(180deg)',
                    'margin-right': '14px'
                }); 
            },
            activate: function (event, ui){
                var oldButton = ui.oldHeader[0];
                var oldButtonArrow = $(oldButton).find('.arrow');
                $(oldButtonArrow).css({
                    'transform': 'rotate(0deg)',
                    'margin-right': '0px'
                });
            },
            beforeActivate: function(event, ui){
                var currentButton = ui.newHeader[0];
                var currentButtonArrow = $(currentButton).find('.arrow');
                
                $(currentButtonArrow).css({
                    'transform': 'rotate(180deg)',
                    'margin-right': '14px'
                    

                });
                
            }
            
    }); //jquery ui accordion

//main page destination choice fields. swap icon and disabled field functionalities	
function changeEventHandler(){ //function disables "to" field if "from" is empty
    var firstField = document.getElementById("pac-input-from");
    var secondField = document.getElementById("pac-input-to");

    if (firstField.value == ""){
            secondField.setAttribute("disabled", true);
            secondField.value = "";
    } else {
            secondField.removeAttribute("disabled");
    }
	
};

//function swaps values of "from" and "to"
function swapFieldValues(){
    var firstField = document.getElementById("pac-input-from");
    var secondField = document.getElementById("pac-input-to");
    var tmp;

    tmp = secondField.value;
    secondField.value = firstField.value;
    firstField.value = tmp;
	
};

if ($("#pac-input-from").exists()){
	document.getElementById("pac-input-from").addEventListener("input", changeEventHandler);
	document.getElementsByClassName("swap-icon")[0].addEventListener("click", swapFieldValues);
	
	var transferForm = document.getElementsByClassName('transfer')[0];
	var chaffeurForm = document.getElementsByClassName('chaffeur')[0];
	
        //check which radio is active and show appropriate transfer/chaffeur fields
	if  (document.getElementById('transfer-radio').checked){
		transferForm.style.display = "block";
		chaffeurForm.style.display = "none";
	} else if (document.getElementById('chaffeur-radio').checked){
		transferForm.style.display = "none";
		chaffeurForm.style.display = "block";
	}
       
        /* function that reloads car class buttons*/
        function hideCarClassContainer(){
            $('#car-class-container').animate({
                opacity: 0,          
            }, 200, callback);
        }
        
        function callback(){
            $('#fountainG').css('display','block');
            
            setTimeout( function(){
                $('#fountainG').css('visibility', 'visible');
            }, 400);
            
            
            setTimeout( function(){
                $('#fountainG').css('visibility', 'hidden');
                $('#fountainG').css('display', 'none');
                $('#car-class-container').animate({
                    opacity: 1,
                }, 400);
            }, 1000);
        }
        
	document.getElementById('transfer-radio').addEventListener("change", function () {
		$('#transfer').show('fast').fadeIn();
		$('#chaffeur').hide('fast').fadeOut();
                hideCarClassContainer();
	});
        
	document.getElementById('chaffeur-radio').addEventListener("change", function () {
		$('#transfer').hide('fast').fadeOut();
		$('#chaffeur').show('fast').fadeIn();
                hideCarClassContainer();
                
                /*reset car cost for chaffeur*/
                /*setTimeout to hide the moment when price is updated*/
                returnCheckBox.checked = false;
//                resetCost();
	});
        
        /* function to update cost when return is checked */
      /*  function multiplyCost(){
            var carClassArray = document.getElementsByClassName('car-class-min-price');
            
            for (var i = 0; i < carClassArray.length; i++){
               var oldCarClassPrice = carClassArray[i].dataset.price;
               newCarClassPrice = Number(oldCarClassPrice)*2;
               carClassArray[i].innerHTML ='$' + oldCarClassPrice + ' + ' + '$'+ oldCarClassPrice +
                       ' = $' + newCarClassPrice;
               
            }
            
        };*/
        /* function to reset cost when return is unchecked */
//        function resetCost(){
//            var carClassArray = document.getElementsByClassName('car-class-min-price');
//            for (var i = 0; i < carClassArray.length; i++){
//               carClassArray[i].innerHTML = '$' + carClassArray[i].dataset.price;
//            }
//        };
//        
        
        /*when page reloads check if checkbox is checked then update cost*/
//        if (returnCheckBox.checked){
//           multiplyCost(); 
//        };
        
        /* update cost when checkbox is true */
//        returnCheckBox.addEventListener('change', function(){
//           
//           hideCarClassContainer();
//           if (this.checked && document.getElementById('transfer-radio').checked){
//               setTimeout(function(){
//                   multiplyCost();
//               }, 200);
//               
//           }else{
//               setTimeout(function(){
//                   resetCost();
//               }, 200);
//           }
//        });
  
    }
    
    if($('#return-form').exists()){
        var returnForm = $('#return-form');
        returnForm.on('change', showHideReturnPanel);
    }
    
    function showHideReturnPanel(event){
        console.log(event.target.checked);
        if (event.target.checked)
            $('.return-panel').css('display', 'block');
        else
            $('.return-panel').css('display', 'none');
    }
    
   //index form validation (from - to fields)
   document.getElementById('index-form').addEventListener('submit', function(e){
       if ($('#pac-input-from').val() == ''){
           e.preventDefault();
            $('#pac-input-from').addClass('error');
            $(window).scrollTop(0);
            
       }else if ($('#pac-input-to').val() == ''){
            e.preventDefault();
            $('#pac-input-to').addClass('error');
            $(window).scrollTop(0);
            
       }else{
           $('#pac-input-from, #pac-input-to').removeClass('error');
           return true;
       }
       
      
   });
    
    

});


	
	






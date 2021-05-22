document.write(
      unescape("%3Cscript src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' type='text/javascript'%3E%3C/script%3E")
    );
document.addEventListener("DOMContentLoaded", function(){

  // Handler when the DOM is fully loaded
  // Add click event handler to button
	var nowY = new Date().getFullYear(),
    options = "";

	for(var Y=nowY; Y>=2019; Y--) {
	options += "<option value ="+Y+">"+ Y +"</option>";
	}

	$("#years").append( options );
	
	$('#formdiv').hide();
	$(".open").on("click", function(e) {
		e.preventDefault();
		$(".menu-overlay").addClass("active");
	});

 $("#myInputtable").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
	

  //----- CLOSE
  $('.close').on('click', function(e)  {
        $('.popup').fadeOut(350);
        //$('#hidden').val(1);
        e.preventDefault();
    });
	//removes the "active" class to .popup and .menu-box when the "Close" button is clicked
	$(".menu-close-btn").on("click", function(e) {
		e.preventDefault();
		$(".menu-overlay").removeClass("active");
	});
	
	$('.accordion-header').click(function(e) {
		e.preventDefault();
		$('.accordion-header').toggleClass('expanded');
		$('.accordion-body').toggleClass('show');
	});
	
	 $('#configreset').click(function(){
            $('#configform')[0].reset();
              $("select").each(function() { this.selectedIndex = '' });
            $( "#filtersubmit" ).trigger( "click" );
 	});
	$( '#load-file' ).click( function () {
		if ( ! window.FileReader ) {
			return alert( 'FileReader API is not supported by your browser.' );
		}
		var $i = $( '#file' ), // Put file input ID here
			input = $i[0]; // Getting the element from jQuery
		
		if ( input.files && input.files[0] ) {
			file = input.files[0]; // The file
			fr = new FileReader(); // FileReader instance
			fr.onload = function () {
				var text = fr.result;                 // the entire file
				$('.uploadselect').empty();
				var firstLine = text.split('\n').shift();// first line 
				var array = firstLine.split(",");
				var x = document.getElementById("formdiv");
			    $('#formdiv').show();
				var fieldsarray =  ['full_name','phone_number','alt_phone_num','email_address','city','district','model_of_vehicle','platform','test_ride','previous_vehicle','enquiry_date','campaign_name'];
				
				for(var j = 0; j < fieldsarray.length; j++)
				{
					var fields = document.getElementById(fieldsarray[j]);
					var opt = document.createElement('option');
					opt.innerHTML = 'select--';
					opt.value = '' ;
					fields.appendChild(opt);
					var opt = document.createElement('option');
					opt.innerHTML = 'N/A';
					opt.value = 'NA' ;
					fields.appendChild(opt);
					if( fieldsarray[j] == 'campaign_name')
					{
						var opt = document.createElement('option');
						opt.innerHTML = 'Regular Campaign';
						opt.value = 'RegularCampaign' ;
						fields.appendChild(opt);
						var opt = document.createElement('option');
						opt.innerHTML = 'Exchange Mela';
						opt.value = 'ExchangeMela' ;
						fields.appendChild(opt);
						var opt = document.createElement('option');
						opt.innerHTML = 'GixxerExclusive';
						opt.value = 'GixxerExclusive' ;
						fields.appendChild(opt);
						var opt = document.createElement('option');
						opt.innerHTML = 'SpecialCampaign';
						opt.value = 'SpecialCampaign' ;
						fields.appendChild(opt);
						
					}
					else
					{
						for(var i = 0; i < array.length; i++) {
							var opt = document.createElement('option');
							opt.innerHTML = array[i];
							opt.value = i ;
							fields.appendChild(opt);
						}
					}
				}
			};
			fr.readAsText( file );
		} else {
			alert( "File not selected or browser incompatible." )
		}
	});
	
	
});

function openForm() {
	document.getElementById("myForm").style.display = "block";
}

function closeForm() {
	$('#formdiv').hide();
	document.getElementById("file").value = "";
	$('.uploadselect').empty();
	document.getElementById("myForm").style.display = "none";
}
	
	function opendownloadForm() {
	document.getElementById("downloadform").style.display = "block";
}

function closedownloadForm() {
	document.getElementById("downloadform").style.display = "none";
}
function filterFunction() {
	var input, filter, ul, li, a, i;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	div = document.getElementById("myDropdown");
	a = div.getElementsByTagName("a");
	for (i = 0; i < a.length; i++) {
		txtValue = a[i].textContent || a[i].innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			a[i].style.display = "";
		} else {
			a[i].style.display = "none";
		}
	}
}

function myFunction() {
	document.getElementById("myDropdown").classList.toggle("show");
}
$("#bulkedit").click(function(){
		var arr_id = [];
		
		$(":checkbox:checked").each(function(i){
			arr_id[i] = $(this).val();
		})
		if(arr_id.length == 0){
			alert("atleast check one");
		}else{
		
			$('#bulkassigneddiv').show();
			var formData = new FormData();
			for(var i = 0;i<arr_id.length;i++){
				
				$("#"+arr_id[i]).css({"background":"red"});
				
			}
				
				formData.append('ids', arr_id.join());
				$("#assignupdate").click(function(){
					var assignedto = $('#bulkassigned').val();
				
				if(assignedto == '')
				{
					alert('give assigned to ');
					return false;
				}
				else
				{
					formData.append('assignedto', assignedto);
				}
			 $.ajax({
                url: "post.php", 
                method: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                	
                	 $('#bulkassigneddiv').hide(); 
                	location.reload();
                },
                error: function (error) { alert("Error"); }
            });
		  });
		}
	});
$('#cancelassign').click(function(){
	$('#bulkassigned').val('');
	 $('#bulkassigneddiv').hide();

});
$('tr #EditButton').on('click', function(e)  {
       $('.popup').fadeIn(350);
	   e.preventDefault();
	   var rowid =$(this).closest('tr').prop('id')
	  
	   $(this).closest('tr').find('td').each(function() {
		var cellvalue = $(this).html(); // also tried val() here
		var cellname = $(this).attr('id');
		
		
		if(cellname =='EnquiryStatus')
		{
			var selectfileds = ['NA','Booking Done','Closed Enquiry','Competition Bought','Dummy Enquiry','Interested','Not Interested','Not Reachable','Other Location Enquiry','Delivered'];
			$('.rightform-left-col').append("<lable class='optional'> DMSEnquiryStatus : </lable> <select  id='select1' class='optional form-control mb-3' name="+cellname+" required></select>");
			var selectoption = document.getElementById('select1');
			for(var i=0; i <  selectfileds.length ; i++)
			{
				var opt = document.createElement('option');
				opt.innerHTML = selectfileds[i];
				if(i==0)
				{
					opt.value = '';
				}
				else
				{
					opt.value = selectfileds[i] ;
				}
				if(selectfileds[i] == cellvalue)
				{
					opt.selected = true;
				}
				selectoption.appendChild(opt);
			}
			
		}
		else if(cellname == 'Testride')
		{
			var testridefields = ['Yes','No'];
			if(cellvalue == 'Yes')
			{
				$('.form-left-col').append("<p class='optional'> <b>Testride</b></p>");
				$('.form-right-col').append("<p class='optional'> : "+ cellvalue +"</p>");
			}
			else
			{
			$('.rightform-left-col').append("<lable class='optional'> Test Ride : </lable> <select  id='select2' class='optional form-control mb-3' name="+cellname+"></select>");
			var selectoption = document.getElementById('select2');
			for(var i=0; i <  testridefields.length ; i++)
			{
				var opt = document.createElement('option');
				opt.innerHTML = testridefields[i];
				opt.value = testridefields[i] ;
				if(testridefields[i] == cellvalue)
				{
					opt.selected = true;
				}
				selectoption.appendChild(opt);
			}
			}
		}
		else if(cellname == 'FollowUpDate')
		{
			$('.form-left-col').append("<p class='optional'> <b>NextFollowUpDate</b></p>");
			$('.form-right-col').append("<p class='optional'> : "+ cellvalue +"</p>");
			$('.rightform-right-col').append("<lable class='optional'> NextFollowUpDate : </lable> <input class='optional form-control mb-3' type='date' name='"+cellname+"'  required></input>");			
		} 
		else if( cellname == 'AssignedTo')
		{
			
			if(cellvalue != '')
			{
				$('.form-left-col').append("<p class='optional'> <b>"+ cellname +"</b></p>");
				$('.form-right-col').append("<p class='optional'> : "+ cellvalue +"</p>");
			}
			else
			{
				$('.rightform-right-col').append("<lable class='optional'>"+cellname+ " : </lable> <input class='optional form-control mb-3' type='text' name='"+cellname+"' value='"+cellvalue+"'  required></input>");
			}
		}
		else if( cellname == 'DMSEnquiryNumber')
		{
			
			if(cellvalue != ' ')
			{
				$('.form-left-col').append("<p class='optional'> <b>"+ cellname +"</b></p>");
				$('.form-right-col').append("<p class='optional'> : "+ cellvalue +"</p>");
			}
			else
			{
				$('.rightform-right-col').append("<lable class='optional'>"+cellname+ " : </lable> <input class='optional form-control mb-3' type='text' name='"+cellname+"' value=''  required></input>");
			}
		}
		else
		{
			if(cellname == 'EditButton' || cellname == 'bulkupdate')
			{
			}
			else if(cellname == 'FullComment')
			{
				$('.right-sec .remarks-section').append("<p class='optional'> <b> Remarks </b></p>");
				var fc ='';
				
				if(cellvalue != ' ')
				{
					var myArr = JSON.parse(cellvalue);
					var commentlenght = 1;
					
					for(var i=0; i <  myArr.length ; i++)
					{
						var splidata = myArr[i].split("|");
						var commentdate = splidata[0];
						var appendingdata = "<span style='font-size:10px; font-style:italic;'>"+commentdate+" </span><span style='font-size:14px; font-style:normal;'>"+splidata[1]+"</span>";
						
						
						fc += appendingdata+"<br>";
						
						
					}
				} 
				$('.right-sec  .remarks-section').append("<p class='optional remarks'>"+fc+"</p>");
			}
			else{
				if(cellname != 'Comments')
				{
					$('.form-left-col').append("<p class='optional'> <b>"+ cellname +"</b></p>");
					$('.form-right-col').append("<p class='optional'> : "+ cellvalue +"</p>");
				}
			}
		}
		
		});
		$('.right-sec .remarks-section').append("<textarea class='optional form-control mb-3' name='Comments' required ></textarea>");
		$('.right-sec').append("<input class='optional' type='hidden' name='tableid' value="+rowid+"></input>");
		$('.right-sec').append("<button type='submit' name='submit' value='submit' id='inlinebtn' class='optional btn  btn-submit'>Save</button>");
        e.preventDefault();
    });


$("#inlineeditform").submit(function() {
    $('#inlinebtn').prop("disabled", true);
     $('#inlinebtn').text("Saving....");
});
  //----- CLOSE
  $('.close').on('click', function(e)  {
        $('.popup').fadeOut(350);
		$('.optional').remove();
        //$('#hidden').val(1);
        e.preventDefault();
    });
	
	function keyPress (e) {
    if(e.key === "Escape") {
		 $('.popup').fadeOut(350);
		$('.optional').remove();
        //$('#hidden').val(1);
        e.preventDefault();
        // write your logic here.
    }
	
	$('#create_excel').click(function(){  
          
		var filename = $('#filename').val();
		filename = filename + ".csv";
		
        var data='';
        var myTab = document.getElementById('t01');

        // LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
        for (i = 0; i < myTab.rows.length; i++) {

            // GET THE CELLS COLLECTION OF THE CURRENT ROW.
            var objCells = myTab.rows.item(i).cells;
			
            // LOOP THROUGH EACH CELL OF THE CURENT ROW TO READ CELL VALUES.
            for (var j = 0; j < objCells.length - 2; j++) {
				
				/* if(j+1 == objCells.length)
				{}
				else
				{ */
					data +=  objCells.item(j).innerHTML+',';
				//}
            }
            data= data + '\r\n';     // ADD A BREAK (TAG).
	
        }
    
  function downloadContent(name, content) {
  var atag = document.createElement("a");
  var file = new Blob([content], {type: 'text/csv;charset=utf-8'});
  atag.href = URL.createObjectURL(file);
  atag.download = name;
  atag.click();
}

downloadContent(filename,data);
// Write data in 'Output.txt' . 
 
      });  
}
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("t01");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
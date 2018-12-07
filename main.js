
	$(document).ready(function(){
		
		$("button[name=\"shto\"]").click(function(){
		   
			$("div.inputet").append(copyDiv);
			$('div[id="copy"]:last select').selectpicker();
		});
	});
	$(document).ready(function(){
		
		$("button[name=\"fshiFaturElement\"]").click(function(){
		   
			$('.inputet #copy:last').remove();
		});
	});
	
	function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}

function deleteProdukt (id){
	
	$.post("deleteProdukt.php",
		{	id: id	},
		function(data, status){
			
			if(data=="OK"){
				var table = $('#example').DataTable();
 
				var rows = table
					.rows( "#"+id )
					.remove()
					.draw();
				
			alert("Data: " + data + "\nStatus: " + status);
			}
			else{
				alert(data);
				
			}
		}); 	
}

function deleteFatur(idFatur){
	
	$.post("delete.php",
		{	id: idFatur	,
			menu : "fatur"	
		},
		function(data, status){
			
			if(data=="OK"){
				 
				$("#"+idFatur).closest('tr').remove();
				 
				 
				 
			alert( "\nStatus: " + status);
			}
			else{
				alert(data);
				
			}
		}); 	
}

function afishoFatur( faturId){
	
	$.post("afishoArtikull.php",
		{	id: faturId	},
		function(data, status){
				
				$("#afishoFaturModal .modal-body").html(data);
				
				$("#afishoFaturModal").modal() ;
			
		}
)};
function printDiv( id ){
	
	 var divToPrint=document.getElementById( id );

	  var newWin=window.open('','Print-Window');

	  newWin.document.open();

	  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

	  newWin.document.close();

	  setTimeout(function(){newWin.close();},10);

	
	
}

function trEfect (trId){
	$("#"+trId).animate({
            height: '100px',
            width: '150px'
        
		},200);
	
}

function trEfectback (trId ){
	
	$("#"+trId).animate({
            height: '0px',
            width: '0px'
        });
	
	
}
function getSasi (select){
	
	var emri = $(select).val();
	
	$.post("phpAjax.php?action=getSasi",
		{	emri: emri	},
		function(data ){
			
			var obj = jQuery.parseJSON(data);
			
			$(select).closest('#copy').find('input[id^="sasia"]').attr("placeholder", "max = "+obj.sasi);
			
			$(select).closest('#copy').find('input[id^="sasia"]').attr("max",obj.sasi);
				
			
		});
			
		
		
	
}


function deleteShites(id){
	
	$.post("delete.php",
		{	id: id , 
			menu : "shites"	},
		function(data, status){
			
			if(data=="OK"){
				 
				$("#"+id).closest('tr').remove();
				 
				 
				 
			alert( "\nStatus: " + status);
			}
			else{
				alert(data);
				
			}
		}); 	
}
function shtoShites(){
	
	var emri = $('#krijoShites').closest('div[id^="newShites"]').find('input[name^="emri"]').val();
	var statusi = $('#krijoShites').closest('div[id^="newShites"]').find('select[name^="statusShites"]').val();
	var pass = $('#krijoShites').closest('div[id^="newShites"]').find('input[name^="pass"]').val();
	var pass1 = $('#krijoShites').closest('div[id^="newShites"]').find('input[name^="pass1"]').val();
	
	$.post("newshites.php",
		{	name : emri ,
			statusi : statusi,
			pass : pass,
			pass1 : pass1
				},
		function(data){
			
			var obj = jQuery.parseJSON(data);
			
			if(obj.query=="ok"){
			
				$('.exampleShites > tbody:last-child').append('<tr>	<td>'+ obj.id+'</td>	<td>'+obj.name+'</td><td><button id="'+ obj.id+'" type="button" class="btn btn-danger" onclick="deleteShites('+ obj.id+')">Delete</button></td></tr>');
				
				 
				 
				alert("Shitesi u krijua");
				$('#krijoShites').closest('div[id^="newShites"]').find('input[name^="emri"]').val("");
				$('#krijoShites').closest('div[id^="newShites"]').find('input[name^="pass"]').val("");
				$('#krijoShites').closest('div[id^="newShites"]').find('input[name^="pass1"]').val("");
			}
			else{
				alert("Gabim");
				
			}
		}); 	
	
	
	
	
}

function shtoFurnitor(){
	
	var emri = $('#newFurnitor').find('input[name^="emriFurnitor"]').val()
	var qyteti =$('#newFurnitor').find('input[name^="qytetiFurnitor"]').val()
	
	
	$.post("newFurnitor.php",
		{	emriFurnitor : emri ,
			qytetiFurnitor  : qyteti,
				},
		function(data){
			
			var obj = jQuery.parseJSON(data);
			
			if(obj.query=="ok"){
			
				$('.tabelFurnitor > tbody:last-child').append('<tr>	<td>'+ obj.id+'</td><td>'+obj.emer+'</td> <td>'+obj.qyteti+' </td> <td><button id="'+ obj.id+'" type="button" class="btn btn-danger" onclick="deleteShites('+ obj.id+')">Delete</button></td></tr>');
				
				 
				 
				alert("Shitesi u krijua");
				$('#krijoFurnitor').closest('div[id^="newFurnitor"]').find('input[name^="emriFurnitor"]').val("");
				$('#krijoFurnitor').closest('div[id^="newFurnitor"]').find('input[name^="qytetiFurnitor"]').val("");
			}
			else{
				alert("Gabim");
				
			}
		}); 	
	
	
	
	
}

function deleteFurnitor(idFurnitor){
	
	$.post("delete.php",
		{	id: idFurnitor	,
			menu : "furnitor"	
		},
		function(data, status){
			
			if(data=="OK"){
				 
				$("#"+idFurnitor).closest('tr').remove();
				 
				 
				 
			alert( "\nStatus: " + status);
			}
			else{
				alert(data);
				
			}
		}); 	
}














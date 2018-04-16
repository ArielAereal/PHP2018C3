$(function(){
			  var patentes = [ 

			   {value: "asd345" , data: " 2015-09-16 00:51:17 " }, 
 {value: "aih753" , data: " 2018-04-10 00:43:49 " }, 
 {value: "ogt777" , data: " 2018-04-10 00:43:57 " }, 

			   
			  ];
			  
			  // setup autocomplete function pulling from patentes[] array
			  $('#autocomplete').autocomplete({
			    lookup: patentes,
			    onSelect: function (suggestion) {
			      var thehtml = '<strong>patente: </strong> ' + suggestion.value + ' <br> <strong>ingreso: </strong> ' + suggestion.data;
			      $('#outputcontent').html(thehtml);
			         $('#botonIngreso').css('display','none');
      						console.log('aca llego');
			    }
			  });
			  

			});
//BL OPEN PAGE FUNCTIONS
$(function() {
    $("#print").click(function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div.printableArea").printArea(options);
    });
});

//BL PAGE 
var table = $('#table-besoin');
table.DataTable();
function verify(id){
	Notiflix.Confirm.Show(
	'Veuillez Confirmer',
	'Etes-vous sur de vouloir valider cela?',
	'Oui',
	'Non',
	function(){ 
		var etat = $('#etat').val();
		var tbl = $('#table-besoin');

		$.ajax({
			url: "/archive/bl/valid-"+id,
			type: "POST",
			data: {
				etat: etat				
			},
			cache: false,
			success: function(){
				$('#mytbl').load("/archive/bl/load");
			}
		});
	},false);
}
$(document).ajaxStop(function(){
    Notiflix.Notify.Info('Vérifié avec succés');
});

//NEW BL 
function add_des()
{
	var div1 = document.createElement('div');
	// Get template data
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML;
	// append to our form, so that template data
	//become part of form
	document.getElementById('newlink').appendChild(div1);
}
function dateFun(){
	var start = document.querySelectorAll(".start");
	var end = document.querySelectorAll(".end");

	for (var i = 0; i < start.length; i++) {
		end[i].value = start[i].value;
		end[i].min=start[i].value;
	 }
}
function dateFun1(){
	var start = document.querySelectorAll(".start");
	var end = document.querySelectorAll(".end");
	var feedback = document.getElementById("feedback");
	
	for (var i = 0; i < start.length; i++) {
		if (end[i].value < start[i].value ) {
			end[i].value=start[i].value;
			//feedback.style.display = "block";
		}
	}
}

//seetings 
var tbl = $('#table-setting').DataTable({
        "paging": false,
        "info": false,
        "filter": false,
        "ordering": false,
        "targets": [0,1,2,3,4,5,6,7,8],
        "orderDataType": "dom-text",
        "createdRow" : function(row,data,rowIndex){
           $(row).on('click',function(){
                $('#table-setting td').unbind();
                $('#table-setting td').on('click' ,function(){
                    var td = tbl.cell($(this).closest('td')).nodes().to$().find('input');
                    if (td.val() == 1) {
                        $(this).removeClass('bg-success');
                        $(this).toggleClass('bg-danger');
                        td.val(0);
                    }else if(td.val() == 0){
                        $(this).removeClass('bg-danger');
                        $(this).toggleClass('bg-success');
                        td.val(1);
                    }
                });
            });
        }
    });

	$('#addRow').on('click', function() {
        tbl.row.add([
            "",
            "<input type='number' name='km1[]' value='1000' style='width:auto;' >",
            "<input type='number' name='fh1[]' value='0' class='hide' readonly>",
            "<input type='number' name='fg1[]' value='0' class='hide' readonly>",
            "<input type='number' name='fa1[]' value='0' class='hide' readonly>",
            "<input type='number' name='h1[]' value='0' class='hide' readonly>",
            "<input type='number' name='r1[]' value='0' class='hide' readonly>",
            "<input type='number' name='f1[]' value='0' class='hide' readonly>",
            "<input type='number' name='c1[]' value='0' class='hide' readonly>",
            "<input type='number' name='v1[]' value='0' class='hide' readonly>"
        ]).draw(false);
        
    });

    /*$('#table-setting td').on('click',function(){
        var td = tbl.cell($(this).closest('td')).nodes().to$().find('input');
        //alert(td.val());
        if (td.val() == 1) {
            $(this).removeClass('bg-success');
            $(this).toggleClass('bg-danger');
            td.val(0);
        }else if(td.val() == 0){
            $(this).removeClass('bg-danger');
            $(this).toggleClass('bg-success');
            td.val(1);
        }
    });*/

// VISIT
var table2 = $('#table-tech').DataTable();
	var length = table2.rows().count();
	moment.locale('fr');
	
	function checkDates(){
		for (var i = 0 ; i < length; i++) {
			var dateLeasing = table2.row(i).data()[5];
			var dateExpVisite = table2.row(i).data()[7];
			var dateExpAssurance = table2.row(i).data()[9];
			var endL = moment(dateLeasing);
			var dateL = endL.fromNow();
			var endV = moment(dateExpVisite);
			var dateV = endV.fromNow();
			var endA = moment(dateExpAssurance);
			var dateA = endA.fromNow();
			table2.cell({row:i,column:6}).data(dateL);			
			table2.cell({row:i,column:8}).data(dateV);			
			table2.cell({row:i,column:10}).data(dateA);	
		}
	}
	checkDates();
	$('#table-tech tbody').on('click','#btn-edit',function(){
		//GET THE SELECTED ROW;
		var row = table2.row($(this).closest('tr'));
		var id = document.getElementById("id");
		var id1 = document.getElementById("id1");

		//GET THE FORM INPUTS
		var matricule = document.getElementById("matricule");
		var vehicule = document.getElementById("vehicule");
		var leasing = document.getElementById("dateLeasing");
		var visite = document.getElementById("dateExpVisite");
		var assurance = document.getElementById("dateExpAssurance");

		//BUTTONS CONTROL
		matricule.disabled=true;
		vehicule.disabled=true;

		//INSERT TABLE VALUES TO FORM
		id1.value = row.data()[1];
		id.value = row.data()[2];
		vehicule.value = row.data()[3];
		matricule.value = row.data()[4];
		leasing.value = row.data()[5];
		visite.value = row.data()[7];
		assurance.value = row.data()[9];
	});

	$(document).ready(function () {
		 $("#modifier-tech").click(function () {
		  	$("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
		  		submitSuccess: function($form, event){
		  			event.preventDefault();
		  			event.stopPropagation();
		  			$("#modifier-tech").unbind();
		  			// GET DATA FROM FORM
		  			var dateLeasing = $('#dateLeasing').val();
					var dateExpVisite = $('#dateExpVisite').val();
					var dateExpAssurance = $('#dateExpAssurance').val();
					var vehicule = $('#id1').val();
					var tech = $("#id").val();

					//GET THE SELECTED ROW
				    var row = table2.row("#row-"+tech);

				    //GET ROW INDEX
				    var rowIndex = row.index();

					//INITIALIZE DATES
					var week = moment().add(7, 'days').calendar();
					var month = moment().add(30, 'days').calendar()
					var endL = moment(dateLeasing);
					var dateL = endL.fromNow();
					var endV = moment(dateExpVisite);
					var dateV = endV.fromNow();
					var endA = moment(dateExpAssurance);
					var dateA = endA.fromNow();
					//alert(res);

					//UPDATE TABLE
					table2.cell({row:rowIndex,column:5}).data(dateLeasing);
					table2.cell({row:rowIndex,column:6}).data(dateL);
					table2.cell({row:rowIndex,column:7}).data(dateExpVisite);
					table2.cell({row:rowIndex,column:8}).data(dateV);
					table2.cell({row:rowIndex,column:9}).data(dateExpAssurance);
					table2.cell({row:rowIndex,column:10}).data(dateA);

					//ADD CLASSES BASED ON DATE COMPARISON
				    if (moment(dateLeasing).isBefore(week)) {
				    	$("#leasing-"+tech).removeAttr("class");
				    	$("#leasing-"+tech).attr("class","table-danger");
				    }else if (moment(dateLeasing).isBefore(month)){
				    	$("#leasing-"+tech).removeAttr("class");
				    	$("#leasing-"+tech).attr("class","table-orange");
				    } else if (moment(dateLeasing).isAfter(month)) {
				    	$("#leasing-"+tech).removeAttr("class");
				    	$("#leasing-"+tech).attr("class","table-success");
				    }

				    if (moment(dateExpVisite).isBefore(week)) {
				    	$("#visite-"+tech).removeAttr("class");
				    	$("#visite-"+tech).attr("class","table-danger");
				    }else if (moment(dateExpVisite).isBefore(month)){
				    	$("#visite-"+tech).removeAttr("class");
				    	$("#visite-"+tech).attr("class","table-orange");
				    } else if (moment(dateExpVisite).isAfter(month)) {
				    	$("#visite-"+tech).removeAttr("class");
				    	$("#visite-"+tech).attr("class","table-success");
				    }

				    if (moment(dateExpAssurance).isBefore(week)) {
				    	$("#assurance-"+tech).removeAttr("class");
				    	$("#assurance-"+tech).attr("class","table-danger");
				    }else if (moment(dateExpAssurance).isBefore(month)){
				    	$("#assurance-"+tech).removeAttr("class");
				    	$("#assurance-"+tech).attr("class","table-orange");
				    } else if (moment(dateExpAssurance).isAfter(month)) {
				    	$("#assurance-"+tech).removeAttr("class");
				    	$("#assurance-"+tech).attr("class","table-success");
				    }
				    Notiflix.Notify.Success('Modifié avec succée');
				    //DISABLE SUBMIT BUTTON
				   $("#modifier-tech").prop("disabled", true);
				    $("#modal-modifier").modal("hide");
		  			$.ajax({
			          type: "POST",
			          url: "/services/suivi/edit/"+tech,
			          data: {
						vehicule: vehicule,				
						dateLeasing: $('#dateLeasing').val(),				
						dateExpVisite: $('#dateExpVisite').val(),				
						dateExpAssurance: $('#dateExpAssurance').val()				
						},
			          cache: false,
			          timeout: 800000,
			          success: function (data) {
			              $("#modifier-tech").prop("disabled", false);
			              //Notiflix.Notify.Success('Modifié avec succée');
			          },
			          error: function (e) {
			              $("#modifier-tech").prop("disabled", false);
			              Notiflix.Notify.Error('Veuillez ressayez plus tard');
			          }
			      });
		  		}
		  	});
		  });
		});

// vehicule index

var table3 = $('#table-vehicule').DataTable();

$(document).ready(function () {

 $("#btnSubmit").click(function () {
  	$("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
  		submitSuccess: function($form, event){
  			event.preventDefault();
  			$("#btnSubmit").unbind();
		    var form = $('#myform')[0];

		    var data = new FormData(form);

		    $("#btnSubmit").prop("disabled", true);
  			$.ajax({
	          type: "POST",
	          enctype: 'multipart/form-data',
	          url: "/vehicule",
	          data: data,
	          processData: false,
	          contentType: false,
	          cache: false,
	          timeout: 800000,
	          success: function (data) {
	              $("#btnSubmit").prop("disabled", false);
	              Notiflix.Notify.Info('Véhicule ajouté avec succée');
	              document.getElementById("formV").style.display="none";
	              document.getElementById("row").style.display="block";
	          },
	          error: function (e) {
	              $("#btnSubmit").prop("disabled", false);
	              Notiflix.Notify.Error('Veuillez ressayez plus tard');
	          }
	      });
  		}
  	});
  });
});

function deleteV(id){
	Notiflix.Confirm.Show(
	'Veuillez Confirmer',
	'Etes-vous sur de supprimer cela?',
	'Oui',
	'Non',
	function(){ 
		setTimeout(table3.row('#row-'+id).remove().draw(false), 2000);
		Notiflix.Notify.Warning('Supprimé avec succés');
		$.ajax({
			url: "/vehicule/remove-"+id,
			type: "POST",
			data: {
				etat: etat				
			},
			processData: false,
	        contentType: false,
	        cache: false,
	        timeout: 10000,
			success: function(){
				
			},
			error: function (e) {
              $("#btnSubmit").prop("disabled", false);
              Notiflix.Notify.Error('Veuillez ressayez plus tard');
          }
		});
	},false);
}

$(function() {
    var imagesPreview = function(input, place) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(place);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#images').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});

function show(){
	var form = document.getElementById("formV");
	var row = document.getElementById("row");
	if (form.style.display=="none") {
		form.style.display="block";
		row.style.display="none";
	}else{
		form.style.display="none";
		row.style.display="block";
	}
}

// VEHICULE EDIT
$(document).ready(function () {

 $("#btnEdit-Vehicule").click(function () {
  	$("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
  		submitSuccess: function($form, event){
  			event.preventDefault();

		    var form = $('#myform')[0];

		    var data = new FormData(form);

		    $("#btnEdit-Vehicule").prop("disabled", true);
  			$.ajax({
	          type: "POST",
	          enctype: 'multipart/form-data',
	          url: "/vehicule/edit/{{v.id}}",
	          data: data,
	          processData: false,
	          contentType: false,
	          cache: false,
	          timeout: 800000,
	          success: function (data) {
	              Notiflix.Notify.Success('Véhicule modifié avec succée');
	              location.href="/vehicule";
	          },
	          error: function (e) {
	              $("#btnEdit-Vehicule").prop("disabled", false);
	              Notiflix.Notify.Error('Veuillez ressayez plus tard');
	          }
	      });
  		}
  	});
  });
});

$(function() {
    var imagesPreview = function(input, place) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(place);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#images').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});

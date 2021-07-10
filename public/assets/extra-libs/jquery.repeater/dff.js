var room = 1;

function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = '<div class="row"><div class="col-md-4"><div class="form-group"><label>Nature de Besoin :</label><input type="text" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label>Nombre des Personnes :</label><input type="number" class="form-control"></div></div></div><div class="row"><div class="col-md-4"><div class="form-group"><label>Date de Départ :</label><input type="date" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label>Date de dArriveé :</label><input type="date" class="form-control"></div></div><div class="col-md-2"><div class="form-group"><button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i> </button> </div></div></div>';

    objTo.appendChild(divtest)
}

function remove_education_fields(rid) {
    $('.removeclass' + rid).remove();
}
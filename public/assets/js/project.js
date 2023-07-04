document.addEventListener('DOMContentLoaded', function() {
    initDataTable();
});

const swalInit = swal.mixin({
    buttonsStyling: false,
    customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-light',
        denyButton: 'btn btn-light',
        input: 'form-control'
    }
});

var table = null;

function initDataTable(){
    if (!$().DataTable) {
        console.warn('Warning - datatables.min.js is not loaded.');
        return;
    }



    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span class="me-3">Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
        }
    });

    table = new DataTable('.datatable-html',{
        columnDefs: [{
            orderable: false,
            width: 100
        }]
    });


    // HTML sourced data
    // table = $('.datatable-html').dataTable({
    //     columnDefs: [{
    //         orderable: false,
    //         width: 100
    //     }]
    // });
}

var add = true;
var numberId = "";
var numberGlobal = "";

function editThisNumber (number, projectID){
    var email = $("#email"+number).text();
    var ip = $("#ip"+number).text();
    numberId = $("#_id"+number).val();
    numberGlobal = $("#iteration"+number).text();

    $("#newNumber").val(number).focus();
    $("#newEmail").val(email);
    $("#newIp").val(ip);

    $("#addEditFormName").text('Edit form');

    $("#addButtonText").text('Edit');
    $("#addButtonIcon").removeClass('ph-plus-circle').addClass('ph-pencil-simple');

    add = false;
}

function deleteThisNumber (numberId, projectID, number){

    swalInit.fire({
        title: 'Are you sure?',
        text: 'Are you sure you want to delete this number?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((confirmed) => {
        if (confirmed.isConfirmed) {
            $.ajax({
                type:'GET',
                url:'/deleteNumber',
                data:{
                    numberId: numberId,
                    id: projectID
                },
                success:function(data) {
                    var removingRow = $("#iteration"+number).parent();
                    table.row(removingRow).remove().draw(false);
                    sweetAlert(data[0].msg, "Success", 'success');
                },
                error: function (error){
                    sweetAlert('Some unexpected error happened!', "Error", 'error');
                    console.log(error);
                }
            });
        }
    });


}

function  test(){
    alert('test');
}

function addEdit(){

    var number = $("#newNumber").val();
    var email = $("#newEmail").val();
    var ip = $("#newIp").val();
    var counter = table.rows().count()+1;
    var numberLocal = numberGlobal;
    if(add){
        //add new to the db and datatable
        if(number === ""){
            $("#newNumber").addClass('border-danger');
            return;
        }
        $("#newNumber").removeClass('border-danger');
        $.ajax({
            type:'GET',
            url:'/addNewNumber',
            data:{
                number: number,
                email: email,
                ip: ip,
                id: projectId,
            },
            success:function(data) {
                table.row.add([counter,number,ip,email,`
                    <div class="d-inline-flex">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item text-primary" onclick="editThisNumber('`+number+`', '`+projectId+`')">
                                    <i class="ph-pencil-simple me-2"></i>
                                    Edit
                                </a>
                                <a href="#" class="dropdown-item text-danger" onclick="deleteThisNumber('`+data[0]._id.$oid+`', '`+projectId+`', '`+number+`')">
                                    <i class="ph-x me-2"></i>
                                    Remove
                                </a>
                                <a href="#" class="dropdown-item text-success">
                                    <i class="ph-chart-bar me-2"></i>
                                    Show stats for this number
                                </a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="_id`+number+`" value="`+data[0]._id.$oid+`"/>
                `]).draw(false)
                    .nodes()
                    .to$()
                    .find('td')
                    .each(function(index, element) {
                        switch(index) {
                            case 0:
                                $(this).attr('id', 'iteration'+number  );
                                break;
                            case 1:
                                $(this).attr('id', 'number'+number  );
                                break;
                            case 2:
                                $(this).attr('id', 'ip'+number  );
                                break;
                            case 3:
                                $(this).attr('id', 'email'+number  );
                                break;
                            case 4:
                                $(this).addClass("text-center");
                                break;
                            default:
                                break
                        }
                        // $(this).attr('id', 'tdTEST'  );
                    });

                sweetAlert(data[0].msg, "Success", 'success');
                $("#newNumber").val("");
                $("#newEmail").val("");
                $("#newIp").val("");
            },
            error: function (error){
                sweetAlert('Some unexpected error happened!', "Error", 'error');
                console.log(error);
            }
        });
        add = true;
    }
    else{
        //edit in db and datatable
        if(numberId === "" && numberGlobal === ""){
            sweetAlert('Some unexpected error happened!', "Error", 'error');
            return;
        }

        $.ajax({
            type:'GET',
            url:'/editNumber',
            data:{
                number: number,
                email: email,
                ip: ip,
                id: projectId,
                numberId: numberId
            },
            success:function(data) {
                someId = numberLocal;
                newData = [ someId, number, ip, email, `
                    <div class="d-inline-flex">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item text-primary" onclick="editThisNumber('`+number+`', '`+projectId+`')">
                                    <i class="ph-pencil-simple me-2"></i>
                                    Edit
                                </a>
                                <a href="#" class="dropdown-item text-danger">
                                    <i class="ph-x me-2"></i>
                                    Remove
                                </a>
                                <a href="#" class="dropdown-item text-success">
                                    <i class="ph-chart-bar me-2"></i>
                                    Show stats for this number
                                </a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="_id`+number+`" value="`+data[0].numberId+`"/>
                ` ];
                table.row((someId-1)).data( newData )
                    .draw(false)
                    .nodes()
                    .to$()
                    .find('td')
                    .each(function(index, element) {
                        switch(index) {
                            case 0:
                                $(this).attr('id', 'iteration'+number  );
                                break;
                            case 1:
                                $(this).attr('id', 'number'+number  );
                                break;
                            case 2:
                                $(this).attr('id', 'ip'+number  );
                                break;
                            case 3:
                                $(this).attr('id', 'email'+number  );
                                break;
                            case 4:
                                $(this).addClass("text-center");
                                break;
                            default:
                                break
                        }
                        // $(this).attr('id', 'tdTEST'  );
                    });

                sweetAlert(data[0].msg, "Success", 'success');
                $("#newNumber").val("");
                $("#newEmail").val("");
                $("#newIp").val("");
                numberLocal = "";

                // $("#number"+number).text(number);
                // $("#ip"+number).text(ip);
                // $("#email"+number).text(email);

                // var row = $("#row"+number);
                // table.row( row )
                //     .data([
                //         number,
                //         email,
                //         ip
                //     ])
                //     .draw(false);
                // console.log(row);
            },
            error: function (error){
                sweetAlert('Some unexpected error happened!', "Error", 'error');
                console.log(error);
            }
        });

        numberId = "";
        numberGlobal = "";
    }
    $("#addEditFormName").text('Add form');
    $("#addButtonText").text('Add');
    $("#addButtonIcon").removeClass('ph-pencil-simple').addClass('ph-plus-circle');
    add = true;
}

function sweetAlert(message, title, type){
    if (typeof swal == 'undefined') {
        console.warn('Warning - sweet_alert.min.js is not loaded.');
        alert('Some error happened!');
        return;
    }

    swalInit.fire({
        title: title,
        text: message,
        icon: type,
        showCloseButton: true
    });
}

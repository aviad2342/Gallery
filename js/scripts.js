$(document).ready(function(){

    $('#user_name').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "admin/includes/ajax.php",
                data: 'query',            
                dataType: "json",
                type: "POST",
                success: function (data) {
                    result($.map(data, function (item) {
                        $('#user_id').val(item.id);
                        return item;
                    }));
                }
            });
        }
    });

    $("#checkall").click(function(){
        if ( $( "#checkall" ).prop( "checked" ) ){
            $(".mail-checkbox").prop( "checked", true );
        } else {
            $(".mail-checkbox").prop( "checked", false );
        }   
    });

    $("#delete-message").click(function(){
        var idArr = [];
        $( ".mail-checkbox" ).each(function( i, obj ) {
            //console.log($(this).attr( "data" ));
            if($(this).prop( "checked" )){
                idArr.push( $(this).attr( "data" ));
            }
          }); 
          
          //JSON.stringify(idArr);
          console.log(idArr);
          $.ajax({
            type: "POST",
            url: "admin/includes/ajax.php",
            data: {data : idArr}, 
            cache: false,
            success: function(){
                window.location.replace("inbox.php?");
            }
        });
    });

    $("#mark-read").click(function(){
        var idArr = [];
        $( ".mail-checkbox" ).each(function( i, obj ) {
            //console.log($(this).attr( "data" ));
            if($(this).prop( "checked" )){
                idArr.push( $(this).attr( "data" ));
            }
          }); 
          
          //JSON.stringify(idArr);
          console.log(idArr);
          $.ajax({
            type: "POST",
            url: "admin/includes/ajax.php",
            data: {read : idArr}, 
            cache: false,
            success: function(){
                window.location.replace("inbox.php?");
            }
        });
    });

    $("#filepreview").fileinput({
        theme: "fa",
        deleteUrl: "#",
        showUpload: false
    });
    
});

function readMessage(id) {
    window.location.replace("read_message.php?id=" + id);
}

function filterMails() {
    // Declare variables 
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      } 
    }
  }



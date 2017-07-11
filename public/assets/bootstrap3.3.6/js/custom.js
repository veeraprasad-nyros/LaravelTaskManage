function checkEmailExisted(email,path)
{
    $path = path;
    $path += email;
    //console.log($path);
    $status = true;
    $.ajax({  
        type: "GET" ,  
        url: $path ,
        async: false,  
        //data: {'email':value,'_token':$token},
        success: function(response){
            //console.log(response['status']);
            if(response['status'] == 0)
                $status = true;
            else
                $status = false;
            }
    });
    //console.log($status);
    return $status;
}
function checkTeamExisted(team,path)
{
    $path = path;
    $path += team;
    //console.log($path);
    $status = true;
    $.ajax({  
        type: "GET" ,  
        url: $path ,
        async: false,  
        //data: {'name':team,'_token':$token},
        success: function(response){
           //console.log(response['status']);
           // 1 means team existed
            if(response['status'] == 1)
                $status = true;
            else
                $status = false;
        }
    });
    //console.log($status);
    return $status;
}

function emptyCheck(list)
{
    var errors = {};
    var j = 0;
    for(i in list)
    { 
        //console.log(i,list[i]);
        var val = list[i];
        //console.log(val.length,val);
        if(val.length == 0)
        {
            errors[i] = 'empty';
            j = j+1;
        }
    }
    errors['count'] = j;
    return errors;
}
function getStats(path)
{
    var res = null;
    $.ajax({  
        type: "GET" ,  
        url: path ,
        async: false,  
        //data: {'email':value,'_token':$token},
        success: function(response){
            res = response;        
        }
    });
    return res;
}
$(document).ready(function(){
    $('#ajaxLoader').hide();
    $tbl = $('#teamstable, #memberstable').DataTable();

    $tbl.on( 'order.dt search.dt', function () {
        $tbl.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        
        // Dividing by two centers the modal exactly, but dividing by three 
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    }
    // Reposition when a modal is shown
    $('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
});

setInterval(function() {
    $n1 = Math.trunc(Math.random()*200);
    $n2 = Math.trunc(Math.random()*200);
    $n3 = Math.trunc(Math.random()*200);
    if($n1 > 255)
        $n1 = 0;
    if($n2 > 255)
        $n2 = 0;
    if($n1 > 255)
        $n2 = 0;
    $color = 'rgb('+$n1+','+$n2+','+$n3+')';
    //$bgcolor = 'rgb('+$n3+','+$n2+','+$n1+')';
    //console.log($color);
    $('.colorAnimate').css({'color': $color});
}, 1000);


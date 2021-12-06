$(function ()
{
    get_users();

    $(".testcheckbox").on("click", function ()
    {
        get_users();
    });

});

var actionButton = document.querySelector('.action');
actionButton.addEventListener('click', myFunction);

function get_users()
{

    

    let form = $("#multi-filters");

    $.ajax(
        {
            type: "POST",
            url: "filters.php",
            data: form.serialize(),
            success: function (data)
            {
                $("#filters-result").html("");


                $.each(JSON.parse(data), function(key, User)
                {                  
                    let row = ""+
                        "<tr>" +
                        "<td>"+key+"</td> " +
                        "<td>"+User.autor_1+"</td> " +
                        "<td>"+User.assunto+"</td> " +
                        "<td>"+User.titulo+"</td> " +
                        "<td>"+User.ano_defesa+"</td>"+
                        "<td>  <a href='read.php?id="+key+"' title='Detalhes' class='btn btn-primary' >Detalhes</a> <a href='update.php?id="+key+"' title='Editar' class='btn btn-warning'>Editar</a> <a href='delete.php?id="+key+"' title='Excluir' class='btn btn-danger'>Excluir</a> </td>";
                        "</tr>";        

                    $("#filters-result").append(row);

                
                });

            }
        }
    )
}



var jQuery = jQuery.noConflict();
jQuery(function(){
    var modal = document.getElementById('myModal');
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    
    btn.onclick = function() 
    {
        modal.style.display = "block";
    }

    span.onclick = function() 
    {
        modal.style.display = "none";
    }

    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = "none";
        }
    }
});

function setTextField(ddl) 
{
    document.getElementById('option_text').value = ddl.options[ddl.selectedIndex].text;
}
function show_add_new_cat_form()
{
    document.getElementById('select_post').style.display='none';
    document.getElementById('add_new_category').style.display='block';
}

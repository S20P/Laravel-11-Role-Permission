console.log("Blog js");

$(document).ready(function(e){

    let blog_ajax_url = $("#blog_ajax_url").val();
    console.log("blog_ajax_url",blog_ajax_url);


   // fetch_blog_data();

    $(document).on('click', '.pagination a', function(event){
        console.log("pagination clicked");
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        console.log("page",page);
        fetch_blog_data(page);
    });


     function fetch_blog_data(page)
      {  
        $.ajax({       
                url:blog_ajax_url+"?page="+page,
                method:"POST", 
                dataType: "JSON",   
                data: {
                    "action":"fetchblogaction"
                },
                success:function(res){
                console.log("Ajax RES",res);
                if(res.success){
                    $("#blog_table_data").html(res.blogItemHTML);
                }
                },
                error:function(res){
                    console.log("Ajax error");
                }
                });
     } 

});
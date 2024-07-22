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


    $('.reply-btn').click(function(e) {
        console.log("reply-btn clicked");
        e.preventDefault();
        let cid = $(this).data('id');
        console.log("cid",cid);
        $("#replayForm"+cid).toggle();
    });

    $('#blogSearch').on('keyup',function(e) {
         var search = $(this).val();
         console.log("searchTXT",search);
         let extra_param = {
              "search" : search
         };
         fetch_blog_data(1,extra_param);
    });
    

    $('.replayForm').each(function() {
          $(this).validate({
            rules: {
                name: {
                    required: true,                
                },
                email: {
                    required: true,  
                    email: true              
                },
                comment: {
                    required: true,                
                }
            },
            messages: {
                name: {
                    required: 'The name field is required.'
                },
                email: {
                    required: 'The email field is required.',                
                },
                comment: {
                    required: 'The comment field is required.',                
                }
            },
            errorElement: "span",
            errorClass: "text-danger",
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                console.log("form",form);            
                form.submit();
            },
            errorPlacement: function (error, element) {
                console.log("error",error);
                console.log("element",element);

                error.appendTo(element.parent());
            }
        });
    });

    $("#commentFrom").validate({
        rules: {
            name: {
                required: true,                
            },
            email: {
                required: true,  
                email: true              
            },
            comment: {
                required: true,                
            }
        },
        messages: {
            name: {
                required: 'The name field is required.'
            },
            email: {
                required: 'The email field is required.',                
            },
            comment: {
                required: 'The comment field is required.',                
            }
        },
        errorElement: "span",
        errorClass: "text-danger",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
             console.log("form",form);            
            form.submit();
        },
        errorPlacement: function (error, element) {
            console.log("error",error);
            console.log("element",element);

            error.appendTo(element.parent());
        }
    });

     function fetch_blog_data(page=1,extra_param=[])
      {  

        console.log("extra_param",extra_param);
        var search = null;
        if(extra_param.search){
            search = extra_param.search;
        }
        $.ajax({       
                url:blog_ajax_url+"?page="+page,
                method:"POST", 
                dataType: "JSON",   
                data: {
                    "action":"fetchblogaction",
                    "search" : search
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




    //  Blog Details page js

    var toc = $('#toc');
    var BlogBodyContent = $('#blog-content');

    BlogBodyContent.find('h1, h2, h3, h4, h5, h6').each(function(index) {
        // Get the heading text and level
        var heading = $(this);
        var text = heading.text();
        var level = heading.prop('nodeName').toLowerCase();
        // Generate a unique ID for the heading
        var id = 'heading-' + index;
        heading.attr('id', id);
        // Create a link to the heading
        console.log("text",text);
        var link = $('<a></a>').attr('href', '#' + id).text(text);
        // Create a list item for the TOC
        var listItem = $('<li></li>').addClass(level).append(link);
        // Append the list item to the TOC
        if(text.length > 0){
            toc.append(listItem);
        }
       
    });

});
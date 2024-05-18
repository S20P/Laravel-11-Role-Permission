
    <meta name="title" content="@yield('meta_title','blog')"/>
    <meta name="keywords" content="@yield('meta_keywords','blog')"/>
    <meta name="description" content="@yield('meta_description','blog')"/>
    <meta name="author" content="@yield('meta_author','author')">
    <meta property="url" content="{{ url()->current() }}"/>

    <!--- Open Graph (for Social Media) --->
    <meta property="og:type" content="@yield('meta_og_type','blog')">
    <meta property="og:title" content="@yield('meta_og_title','blog')">  
    <meta property="og:description" content="@yield('meta_og_description','blog')">       
    <meta property="og:image" content="@yield('meta_og_image','http://ia.media-imdb.com/images/rock.jpg')">
    <meta property="og:url" content="{{ url()->current() }}">

    
  
    
    <meta name="title" content="@yield('meta_title',$meta_title) {{$tagline}}"/>
    <meta name="keywords" content="@yield('meta_keywords',$meta_title) {{$tagline}}"/>
    <meta name="description" content="@yield('meta_description',$meta_description) {{$tagline}}"/>
    <meta name="author" content="@yield('meta_author','author') {{$tagline}}">
    <meta property="url" content="{{ url()->current() }}"/>

    <!--- Open Graph (for Social Media) --->
    <meta property="og:type" content="@yield('meta_og_type',$meta_title) {{$tagline}}">
    <meta property="og:title" content="@yield('meta_og_title',$meta_title) {{$tagline}}">  
    <meta property="og:description" content="@yield('meta_og_description',$meta_description) {{$tagline}}">       
    <meta property="og:image" content="@yield('meta_og_image',$site_icon)">
    <meta property="og:url" content="{{ url()->current() }}">
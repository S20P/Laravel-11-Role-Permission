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
    <meta property="og:image:secure_url" content="@yield('meta_og_image',$site_icon)">
    <meta property="og:image:alt" content="@yield('meta_og_type',$meta_title) {{$tagline}}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1688">
    <meta property="og:image:height" content="1024">    
    <meta property="og:site_name" content="{{ url()->current() }}" />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:updated_time" content="{{now()}}" />
    <meta name="twitter:card" content="@yield('meta_og_type',$meta_title) {{$tagline}}">
    <meta name="twitter:title" content="@yield('meta_og_type',$meta_title) {{$tagline}}">
    <meta name="twitter:description" content="@yield('meta_og_description',$meta_description) {{$tagline}}">
    <meta name="twitter:image" content="@yield('meta_og_image',$site_icon)">
    <meta name="twitter:label1" content="Written by">
    <meta name="twitter:data1" content="{{ url()->current() }}">
    <meta name="twitter:label2" content="Time to read">
    <meta name="twitter:data2" content="Less than a minute">
<!-- base_setting_blog_sidebar_block --> 
@if(isset($g_common_settings) && isset($g_common_settings['blog_sidebar_block']))
    @if(!Empty($g_common_settings['blog_sidebar_block']))
        <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Sidebar Block </h5>
        <div class="blog_sidebar_block_section">
            {!! $g_common_settings['blog_sidebar_block'] !!}
        </div>   
    @endif
@endif
<!-- base_setting_blog_sidebar_block :: END--> 
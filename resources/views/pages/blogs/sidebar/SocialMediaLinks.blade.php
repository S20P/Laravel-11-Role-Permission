

@if(isset($g_social_media_settings) && is_array($g_social_media_settings))
@if(count($g_social_media_settings) > 0)
<div class="mb-5 follow">
    <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Follow us</h5>
    @foreach ($g_social_media_settings as $item)
    <a href="{{$item['url']}}" class="text-muted" target="_blank"><i class="{{$item['icon']}}"></i></a>
    @endforeach    
</div>
@endif
@endif


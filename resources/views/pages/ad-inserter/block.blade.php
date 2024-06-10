

@if(isset($pageTypeParam) && isset($position))
@php
    $blocks =  \App\Models\AdInserterSetting::ad_inserter_inject($pageTypeParam,$position);
@endphp
@if(count($blocks) > 0)
<div>
    @foreach ($blocks as $block)
    @if(!empty($block->value))
         <div class="ad_inserter_align_{{$block->alignment}}">
            {{ $block->value }}
         </div>
    @endif     
    @endforeach    
</div>
@endif
@endif
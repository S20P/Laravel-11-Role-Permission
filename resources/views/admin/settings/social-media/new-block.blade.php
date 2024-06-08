
<tr id="row{{$index}}" data-index="{{$index}}">  
    <td><input type="text" name="name[]" placeholder="Enter Name" value="{{$setting['name']??''}}" class="form-control name_list" /></td>  
    <td><input type="text" name="url[]" placeholder="Enter URL" value="{{$setting['url']??''}}" class="form-control name_list" /></td>
    <td width="15%">
        <select name="icon[]" class="form-select icon-select">
            @foreach ($media_icons as $icon)
                   <option value="{{ $icon }}" data-icon="{{ $icon }}" @if(isset($setting['icon']) && $setting['icon']==$icon) selected @endif></option>
            @endforeach
        </select>
    </td>
    <td><input type="number" name="sort_order[]" placeholder="Enter sort order" value="{{$setting['sort_order']??''}}" class="form-control name_list" /></td>
    <td>
        <div class="form-check form-switch">
            <input class="form-check-input" name="status[{{$index}}]" type="checkbox" @if(isset($setting['status']) && $setting['status']==1) value="active" checked @else value="inactive" @endif>
            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
        </div>
    </td>
    <td>
        @if($index==1)
        <button type="button" name="add" id="add_more_media_btn" class="btn btn-success"><i class="bi bi-plus"></i></button>
        @else
        <button type="button" name="remove" id="{{$index}}" class="btn btn-danger btn_remove"><i class="bi bi-x"></i>
        </button>
        @endif
    </td>  
    
    <script>

        $('.icon-select').select2({
            templateResult: formatIcon,
            templateSelection: formatIcon,
            escapeMarkup: function (markup) { return markup; }
        });
    
        $(".form-check-input").on('change', function () {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'active');
            } else {
                $(this).attr('value', 'inactive');
            }
        });
    
        function formatIcon(icon) {
            if (!icon.id) { return icon.text; }
            var iconClass = $(icon.element).data('icon');
            var $icon = $('<span class="icon-preview"><i class="' + iconClass + '"></i> ' + icon.text + '</span>');
            return $icon;
        }
    
    </script>
</tr>  

 {{-- <script src="{{asset('Admin/custom/js/social-media.js')}}"></script> --}}



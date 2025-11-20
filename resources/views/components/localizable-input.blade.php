<div>
    <div class="form-group">
        @if($input['type'] == 'textarea')
            <label class="form-control-label">{{ $input['label'] }}:</label>
            @if(isset($input['note'])) <small>{{ $input['note'] }}</small>@endif
            <textarea name="localizable[{{ $language }}][{{ $input['name'] }}]"
                      @if(isset($input['rows'])) rows="{{ $input['rows'] }}" @endif
                      @if(isset($input['id'])) id="{{ $input['id'] . '_' . uniqid()  }}" @endif
                      class="form-control {{ isset($input['class']) ? $input['class'] : '' }}">{{ isset($item) ? $item->{$input['name'] . '_' .$language }  : old('localizable.' . $language .'.'. $input['name']) }}</textarea>
        @elseif($input['type'] == 'tags')
            <label class="form-control-label">{{ $input['label'] }}:</label>
            @if(isset($input['note'])) <small>{{ $input['note'] }}</small>@endif
            <select name='{{ "localizable[" . $language . "][". $input['name'] . "][]" }}'
                    class="form-control tags-selects" multiple="multiple">
                @if(isset($item) && $options = $item->{$input['name'] . '_' . $language })
                    @foreach($options as $option)
                        <option selected="selected">{{ $option  }}</option>
                    @endforeach
                @endif
            </select>
        @else
            <label class="form-control-label">{{ $input['label'] }}:</label>
            @if(isset($input['note']))<small>{{ $input['note'] }}</small>@endif
            <input name="localizable[{{ $language }}][{{ $input['name'] }}]"
                   @if(isset($input['id'])) id="{{ $input['id'] }}" @endif
                   value="{{ isset($item) ? $item->{$input['name'] . '_' .$language} : old('localizable.' . $language .'.'. $input['name']) }}" type="text"
                   class="form-control">
        @endif
    </div>
</div>

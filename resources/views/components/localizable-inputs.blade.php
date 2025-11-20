<div>

    @isset($item)
        <input type="hidden" name="pk_i_id" value="{{ $item->getKey() }}"/>
    @endisset

    @if(!empty($supportedLanguages))
        <ul class="nav nav-pills">
            @foreach($supportedLanguages as $language)
                <li class="nav-item">
                    <a class="nav-link  @if($loop->first) active @endif" data-toggle="pill"
                       href="#menu{{ $loop->index }}">
                        @lang('general.' . $language)
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($supportedLanguages as $language)
                <div id="menu{{ $loop->index }}" class="tab-pane fade @if($loop->first){{'show active'}}@endif">
                    @foreach($inputs as $input)
                        <x-localizable-input :input="$input" :language="$language" :item="$item"/>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif

</div>

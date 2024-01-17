<select onchange="openLink(this)" class=" rounded-xl text-xs text-slate-600">
    @foreach ($available_locales as $locale_name => $available_locale)
        @if ($available_locale === $current_locale)
            <option selected="selected">{{ $locale_name }}</option>
        @else
            <option value="/language/{{$available_locale}}">{{ $locale_name }}</option>
        @endif
    @endforeach
</select>
<script>
    function openLink(selectElement) {
        var selectedValue = selectElement.value;
        window.location.href = selectedValue;
    }
</script>

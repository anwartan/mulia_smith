@php
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    
    $icon = 'fa-file';
    if ($ext == 'pdf') {
        $icon = 'fa-file-pdf';
    } elseif ($ext == 'word') {
        $icon = 'fa-file-word';
    } elseif (in_array($ext, ['jpeg', 'jpg', 'png'])) {
        $icon = 'fa-file-image';
    }
@endphp
@if (!empty($file))
    <span class="list-attachment">
        <input type="hidden" name="{{ $name }}" value="{{ $file }}" />
        <a target="_blank" href="{{ URL::to('/') . '/files/' . $file }}" class="btn-link text-secondary"><i
                class="far fa-fw {{ $icon }}"></i>
            {{ $file }} </a>
    </span>
@endif

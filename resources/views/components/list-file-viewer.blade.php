<div>

    @foreach ($files as $key => $item)
        <div>
            <x-file-viewer name="{{ $name . '[' . $key . ']' }}" file="{{ $item }}"></x-file-viewer>

            <a href="javascript:void(0)" class="btn-tool btn-del"><i class="fas fa-times"></i></a>
        </div>
    @endforeach
</div>

@once
    @push('js')
        <script>
            $(function() {
                $(".btn-del").click(function() {
                    console.log("hello")
                    var list = $(this).closest("div")
                    console.log(list)
                    list.remove();
                })
            })
        </script>
    @endpush
@endonce

<div id="{{$id}}">
    {{ $slot }}
</div>

<script>
    $(document).ready(() => {
        $(`#{{$id}}`).Gallery({})
    })
</script>
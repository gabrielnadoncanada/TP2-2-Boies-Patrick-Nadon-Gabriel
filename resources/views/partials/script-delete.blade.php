.done(() => {
    @switch($return)
        ...
        @case('home')
            location.replace('/')
            @break
    @endswitch
})

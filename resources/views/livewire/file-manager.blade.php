<div class="w-full h-full">
    <ul class="menu bg-base-200 w-full h-full">
        @foreach($tree as $item)
            @include('file-manager-item', ['item' => $item])
        @endforeach
    </ul>

    <livewire:create-file-dialog :project-name="$projectName"/>
</div>

<dialog wire:ignore.self id="my_modal_2" class="modal" x-data="{ open: $wire.entangle('modalVisible') }" x-init="$watch('open', value => my_modal_2.showModal())">
    <div class="modal-box">
        <form method="dialog">
            <button @click="open = false" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Places</th>
                        <th>Winners</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($winningList)
                        @foreach ($winningList as $i => $winners)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-2">
                                        @for ($w = 1; $w <= $i; $w++)
                                            <button class="btn btn-circle btn-outline btn-secondary">✕</button>
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-ghost badge-lg">{{ $winners }}</span>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button @click="open = false">close</button>
    </form>
</dialog>

<dialog id="my_modal_2" class="modal" x-on:show-modal.window="$wire.winningList = $event.detail.winningListArray; my_modal_2.showModal();">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Hello!</h3>
        <p class="py-4">Press ESC key or click outside to close</p>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Places</th>
                        <th>Winners</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($winningList))
                        @foreach ($winningList as $i => $winners)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-1">
                                        @for ($w = 1; $w <= $i; $w++)
                                            <button class="btn btn-circle btn-outline btn-secondary">X</button>
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-ghost badge-sm">{{ $winningList[$i] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

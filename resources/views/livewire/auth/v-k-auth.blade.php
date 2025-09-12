<div>
    @if(1==2)
        <a
            {{--        wire:click="redirectToVK"--}}
            href="https://oauth.vk.com/authorize?client_id=54139391&redirect_uri=https%3A%2F%2Fmaster.local%2Fauth%2Fvk%2Fcallback&scope=email&response_type=code&state=FNioYtpOITK74h6BBq2ynle9dVMr5O5Hf6rbP97g"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
        >
            Войти через VK
        </a>
    @endif

        @if(1==1)
    <button
        wire:click="redirectToVK"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
    >
        Войти через VK
    </button>
        @endif

    @if (session('error'))
        <div class="mt-4 text-red-600">
            {{ session('error') }}
        </div>
    @endif
</div>

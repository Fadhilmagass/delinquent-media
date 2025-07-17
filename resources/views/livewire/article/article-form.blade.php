<div class="bg-white shadow-xl rounded-2xl">
    <form wire:submit="save">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ is_null($article) ? 'Buat Artikel Baru' : 'Edit Artikel' }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">Isi detail artikel di bawah ini.</p>
        </div>

        <div class="p-6 space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="title" wire:model.blur="title"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Judul artikel yang menarik">
                @error('title')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="category" wire:model.blur="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" wire:model.blur="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach (\App\Enums\Article\Status::cases() as $status)
                            <option value="{{ $status->value }}">{{ ucfirst($status->value) }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700">Kutipan (Excerpt)</label>
                <textarea id="excerpt" wire:model.blur="excerpt" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Ringkasan singkat dari artikel"></textarea>
                @error('excerpt')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Isi Artikel</label>
                <div class="mt-1" wire:ignore>
                    <input id="body" type="hidden" name="content" value="{{ $body }}">
                    <trix-editor input="body"
                        class="trix-content block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        x-data x-on:trix-change="$wire.set('body', $event.target.value)"></trix-editor>
                </div>
                @error('body')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div wire:ignore x-data="{
                tags: @entangle('selectedTags').live,
                init() {
                    new TomSelect(this.$refs.select, {
                        plugins: ['remove_button'],
                        items: this.tags,
                        onChange: (value) => {
                            this.tags = value;
                        }
                    });
                }
            }">
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                <select x-ref="select" multiple>
                    @foreach ($allTags as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            @error('selectedTags')
                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
            @enderror

        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-end items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" wire:navigate
                class="text-sm font-medium text-gray-600 hover:text-gray-900">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <span wire:loading.remove wire:target="save">Simpan Artikel</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>

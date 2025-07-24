<form wire:submit="save">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white dark:bg-slate-800 shadow-md rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-slate-200">Konten Artikel</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Judul</label>
                        <x-text-input type="text" id="title" wire:model.blur="title" class="mt-1 block w-full" placeholder="Judul artikel yang menarik" />
                        @error('title')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Kutipan (Excerpt)</label>
                        <textarea id="excerpt" wire:model.blur="excerpt" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 shadow-sm focus:border-indigo-500 dark:focus:border-sky-500 focus:ring-indigo-500 dark:focus:ring-sky-500 sm:text-sm"
                            placeholder="Ringkasan singkat dari artikel"></textarea>
                        @error('excerpt')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Isi Artikel</label>
                        <div class="mt-1" wire:ignore>
                            <input id="body" type="hidden" name="content" value="{{ $body }}">
                            <trix-editor input="body"
                                class="trix-content block w-full rounded-md border-gray-300 dark:border-slate-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-slate-900 dark:text-slate-200"
                                x-data x-on:trix-change="$wire.set('body', $event.target.value)"></trix-editor>
                        </div>
                        @error('body')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white dark:bg-slate-800 shadow-md rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-slate-200">Metadata</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Kategori</label>
                        <select id="category" wire:model.blur="category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 shadow-sm focus:border-indigo-500 dark:focus:border-sky-500 focus:ring-indigo-500 dark:focus:ring-sky-500 sm:text-sm">
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
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Status</label>
                        <select id="status" wire:model.blur="status"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 shadow-sm focus:border-indigo-500 dark:focus:border-sky-500 focus:ring-indigo-500 dark:focus:ring-sky-500 sm:text-sm">
                            @foreach (\App\Enums\Article\Status::cases() as $status)
                                <option value="{{ $status->value }}">{{ ucfirst($status->value) }}</option>
                            @endforeach
                        </select>
                        @error('status')
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
                        <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Tags</label>
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
            </div>

            <div class="mt-6 flex justify-end items-center gap-4">
                <a href="{{ route('articles.index') }}" wire:navigate
                    class="text-sm font-medium text-gray-600 dark:text-slate-300 hover:text-gray-900 dark:hover:text-white">
                    Batal
                </a>
                <x-primary-button type="submit">
                    <span wire:loading.remove wire:target="save">Simpan Artikel</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </x-primary-button>
            </div>
        </div>
    </div>
</form>
<style>
    .dark .trix-button-group,
    .dark .trix-button {
        background-color: #334155 !important; /* slate-700 */
        border-color: #475569 !important; /* slate-600 */
        color: #e2e8f0 !important; /* slate-200 */
    }
    .dark .trix-button.trix-active {
        background-color: #0f172a !important; /* slate-900 */
    }
    .dark .trix-toolbar {
        background-color: #1e293b !important; /* slate-800 */
    }
    .dark .trix-content {
        background-color: #0f172a !important; /* slate-900 */
    }
</style>

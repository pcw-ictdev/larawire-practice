<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">
        <x-jet-button wire:click="showPostModal">Create</x-jet-button>
    </div>

    {{-- <div>
        <div class="w-full">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                  Title
                </label>
                <input wire:model="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Title">
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                  Body
                </label>
                <input wire:model="body" name="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Body">
              </div>
              <x-jet-button wire:click.prevent="storePost" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Submit
                </x-jet-button>
            </form>
        </div>
    </div> --}}
    <div class="w-96 m-2 p-2">
        <div class="mb-3">
            <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                <input wire:model="search" type="search"
                    class="relative m-0 block w-[1px] min-w-0 flex-auto rounded border border-solid border-dark-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-dark-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-dark-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-dark-600 dark:text-dark-200 dark:placeholder:text-dark-200 dark:focus:border-primary"
                    placeholder="Search" aria-label="Search" aria-describedby="button-addon2" />

                <!--Search icon-->
                <span
                    class="input-group-text flex items-center whitespace-nowrap rounded px-3 py-1.5 text-center text-base font-normal text-dark-700 dark:text-dark-200"
                    id="basic-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
        </div>
    </div>
    <div class="m-2 p-2">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 light:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 light:bg-gray-700 light:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Check
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product Details
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="bg-white border-b light:bg-gray-800 light:border-gray-700">
                            <td class="px-6 py-4">
                                <input type="checkbox">
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->postDetail->post_details }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->body }}
                            </td>
                            <td class="px-6 py-4">
                                CRUD
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
            {{-- {{ $posts->appends(request()->toArray())->links() }} --}}
            {{-- {{ $posts->links('custom-pagination-links-view') }} --}}
        </div>
    </div>
    <div>
        <x-jet-dialog-modal wire:model="showingPostModal">
            <x-slot name="title">Create Post</x-slot>
            <x-slot name="content">
                <div class="w-full">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Title
                                @error('title')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <input wire:model.lazy="title" name="title"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline 
                                @error('title')
                                    border-red-500
                                @enderror"
                                type="text" placeholder="Title">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Body
                                @error('body')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <input wire:model.lazy="body" name="body"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                @error('body')
                                    border-red-500
                                @enderror"
                                type="text" placeholder="Body">
                        </div>
                    </form>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="storePost"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Submit
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>

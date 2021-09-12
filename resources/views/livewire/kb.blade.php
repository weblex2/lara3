<x-slot name="header">
    <h2 class="text-center">Laravel 8 Livewire CRUD Demo</h2>
</x-slot>
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        	<div class="my-4">
        	Search: <input  
        			 type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
        			 id="search" placeholder="Enter Name" wire:model="search">
            
        	</div>
        	<div class="my-4">
        	Pages: <input wire:keydown.enter="setPages($event.target.value)" 
        			 type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
        			 id="rowsPerPage" placeholder="Enter Name" wire:model="rowsPerPage">
            
        	</div> 
           
            
            @if($isModalOpen)
            @include('livewire.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Header</th>
                        <th class="px-4 py-2">Header2</th>
                        <th class="px-4 py-2">Content</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody x-data="{showMore: false}">
                    @foreach($kbs as $kb)
                    <tr wire:click="toggleShowMore()">
                        <td class="border px-4 py-2">{{ $kb->id }}</td>
                        <td class="border px-4 py-2">{{ $kb->header }}</td>
                        <td class="border px-4 py-2">{{ $kb->header2}}</td>
                        <td class="border px-4 py-2">{{ $kb->content}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $kb->id }})"
                                class="flex px-4 py-2 bg-blue-500 text-gray-900 cursor-pointer rounded float-left">Edit</button>
                            
                            <button wire:click="delete({{ $kb->id }})"
                                class="ml-1 flex px-4 py-2 bg-red-600 text-gray-900 cursor-pointer rounded float-left">Delete</button>
                        </td>
                    </tr>
                    <tr x-show="showMore" id="content_{{ $kb->id }}"><td>{{ $kb->content}}</td></tr>
                    @endforeach
                </tbody>
            </table>
           {{ $kbs->links() }}
            <button wire:click="create()"
                class="my-4 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-green-600 text-base font-bold text-white shadow-sm hover:bg-green-700">
                Create Knowledge Base Record
            </button>
             @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            <div id="debug">
            	
            </div>
            
        </div>
    </div>
</div>
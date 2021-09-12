
<div class="menu">

<div class="bg-white shadow w-1/4 float-left h-100 rounded mt-4 border  sm:px-6 lg:px-8">

    <div class="my-4 grid grid-cols-12 gap-1">
    	<div class="col-span-2">Search:</div>
        <div class="col-span-10">
        	<input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
             id="search" placeholder="Enter Name" wire:model="search">
        </div>        
            	
         <div class="col-span-2">Pages: </div>
         <div class="col-span-10">
         	<input wire:keydown.enter="setPages($event.target.value)" 
            type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="rowsPerPage" value="10"  wire:model="rowsPerPage">
    	</div> 
    	
    	</div>
    	
    	<button wire:click="create()"
                class="my-4 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-green-600 text-base font-bold text-white shadow-sm hover:bg-green-700">
                Create Knowledge Base Record
            </button>
    	
</div>

<div class="w-3/4 float-left mt-4 mx-auto sm:px-6 lg:px-8">
    
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        	
           
            
            @if($isModalOpen)
            @include('livewire.create')
            @endif
            
            @if(!$isSelectedId)
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Header</th>
                        <th class="px-4 py-2">Header2</th>
                    </tr>
                </thead>
                <tbody x-data="{showMore: false}">
                    @foreach($kbs as $kb)
                    <tr wire:click="toggleShowMore()">
                        <td class="border px-4 py-2">{{ $kb->id }}</td>
                        <td class="border px-4 py-2"><a href="javascript:void(0)" wire:click="$set('isSelectedId', {{ $kb->id }})" class="text-blue-500">{{ $kb->header }}</a></td>
                        <td class="border px-4 py-2">{{ $kb->header2}}</td>
                        <!--  td class="border px-4 py-2">
                            <button wire:click="edit({{ $kb->id }})"
                                class="flex px-4 py-2 bg-blue-500 text-gray-900 cursor-pointer rounded float-left">Edit</button>
                            
                            <button wire:click="delete({{ $kb->id }})"
                                class="ml-1 flex px-4 py-2 bg-red-600 text-gray-900 cursor-pointer rounded float-left">Delete</button>
                        </td-->
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
           {{ $kbs->links() }}
            
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
            
            @endif
            
            
            @if($isSelectedId)
            	<div>
            	<div class="w-100">
            	<button wire:click="$set('isSelectedId', null)"
                		class="flex px-4 py-2 bg-green-500 text-gray-900 cursor-pointer rounded float-left">
               			 Back
           		 </button>
           		 
           		 <button wire:click="edit({{ $kbs[0]->id }})"
                        class="ml-1 flex px-4 py-2 bg-blue-500 text-gray-900 cursor-pointer rounded float-left">
                        Edit
                 </button>
                 
                 <button wire:click="delete({{ $kbs[0]->id }})"
                 		class="ml-1 flex px-4 py-2 bg-red-600 text-gray-900 cursor-pointer rounded float-left">
                 		Delete
                 </button>
                 <br/><br/>
                 <div></div>
                 </div>
                 
                 <div class="float-none">
            		{!! nl2br(e($kbs[0]->content)) !!}
            	 </div>
            	
            	
            	<button wire:click="$set('isSelectedId', null)"
                		class="flex px-4 py-2 bg-green-500 text-gray-900 cursor-pointer rounded float-left">
               			 Back
           		 </button>
           		 
           		 <button wire:click="edit({{ $kbs[0]->id }})"
                        class="ml-1 flex px-4 py-2 bg-blue-500 text-gray-900 cursor-pointer rounded float-left">
                        Edit
                 </button>
                 
                 <button wire:click="delete({{ $kbs[0]->id }})"
                 		class="ml-1 flex px-4 py-2 bg-red-600 text-gray-900 cursor-pointer rounded float-left">
                 		Delete
                 </button>
                 </div>
            @endif
            
            
        </div>
    </div>
</div>
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kb;

class Kbs extends Component
{
    
    use WithPagination;
    public $header, $header2, $content, $kb_id, $search, $showMore, $rowsPerPage=10, $isSelectedId;
    public $isModalOpen = 0;
    
    
    public function render()
    {
        $search = '%'.$this->search.'%';
        $rowsPerPage = $this->rowsPerPage;
        $isSelectedId = $this->isSelectedId;
        if ($rowsPerPage=="") $rowsPerPage = 4;
        
        // get all
        if ($isSelectedId==null) {
            $this->kbs = KB::where('header', 'like', $search)->paginate($rowsPerPage);
        }
        
        // User clicked in Entry
        else{
            $this->kbs = KB::where('id', $isSelectedId)->paginate(1);
        }
        
        foreach ($this->kbs as $key => $row){
            $this->kbs[$key]['content'] = $row['content'];
        }
        
        return view('livewire.kb', ['kbs' => $this->kbs]);
        
    }
    
    
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    
    private function resetCreateForm(){
        $this->header = '';
        $this->header2 = '';
        $this->content = '';
    }
    
    public function store()
    {
        $this->validate([
            'header' => 'required',
            'header2' => 'required',
            'content' => 'required',
        ]);
        
        Kb::updateOrCreate(['id' => $this->kb_id], [
            'header' => $this->header,
            'header2' => $this->header2,
            'content' => $this->content,
        ]);
        
        session()->flash('message', $this->id ? 'Student updated.' : 'Student created.');
        
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    
    public function edit($id)
    {
        $student = Kb::findOrFail($id);
        $this->kb_id = $id;
        $this->header = $student->header;
        $this->header2 = $student->header2;
        $this->content = $student->content;
        
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Kb::find($id)->delete();
        session()->flash('message', 'Content deleted.');
    }
    
    public function toggleShowMore()
    {
        $this->showMore = !$this->showMore;
    }
    
    
    
    public function setPages($rowsPerPage)
    {
        $this->rowsPerPage = $rowsPerPage;
    }
    
}

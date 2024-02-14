<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $name;
    public $email;
    public $hiddenId;
    //public $allData = [];
    protected $rules = [
        'name' =>'required|min:3|max:20',
        'email' =>'required|email'
    ];
    public function render()
    {
        $allData = User::paginate(5);
        return view('livewire.dashboard', ['allData' => $allData]);
    }

    public function submit()
    {
        $validateData = $this->validate();
        $updateId = $this->hiddenId;
        if ($updateId>0) {
            $updateArray = array(
                'name'=>$validateData['name'],
                'email'=>$validateData['email']
            );
            DB::table('users')->where('id', $updateId)->update($updateArray);
        } else {
            User::create($validateData);
        }

        session()->flash('success', 'Form is submitted');
    }
    public function addForm()
    {
        $this->name= '';
        $this->email = '';
        $this->hiddenId ='';
    }
    public function editForm($id)
    {
        $singleData = User::find($id);
        $this->name= $singleData->name;
        $this->email = $singleData->email;
        $this->hiddenId = $singleData->id;
    }
    public function deleteForm($id)
    {
        DB::table('users')->where('id', $id)->delete();
        session()->flash('success', 'Users Deleted');
    }
}

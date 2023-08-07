<?php

namespace App\Http\Livewire;

use App\Models\Customer;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserCrud extends Component
{
    public Customer $newCustomer;
    public Customer $updateCustomer;
    public $allCustomers;
    public $updateMode = false;
    public $searchQuery = "";

    protected $rules = [
        "newCustomer.phone" => "required|unique:customers,phone",
        "newCustomer.email" => "required|unique:customers,email",
        "newCustomer.name" => "required|unique:customers,name",
        "newCustomer.is_chief" => "",
        "updateCustomer.phone" => "",
        "updateCustomer.email" => "",
        "updateCustomer.name" => "",
        "updateCustomer.is_chief" => "",

    ];

    public function updatedSearchQuery($val){
        if (empty($val)){
            $this->getAllCustomers();
        }else{
            $this->allCustomers = Customer::query()
                ->where("name", "LIKE", "%{$val}%")
                ->orWhere("phone", "LIKE", "%{$val}%")
                ->orWhere("email", "LIKE", "%{$val}%")
                ->where("admin_id", Auth::user()->id)
                ->get();
        }
    }

    public function setForEdit($id){
        $this->updateCustomer = Customer::find($id);
        $this->updateMode = true;
        $this->dispatchBrowserEvent("open-update-customer-modal");
    }

    public function saveCustomer(){

        $this->validate();
        $this->newCustomer->admin_id = Auth::user()->id;
        $this->newCustomer->save();
        $this->getAllCustomers();
        $this->initParams();
        session()->flash('alert-type', 'success');
        session()->flash('alert-message', 'Customer Added Successfully');
        $this->dispatchBrowserEvent("close-new-customer-modal");



    }

    public function updateCustomer(){
        $this->validate([
            "updateCustomer.phone" => "required",
            "updateCustomer.email" => "required",
            "updateCustomer.name" => "required",
            "updateCustomer.is_chief" => "required",
            "updateCustomer.admin_id" => "required",
        ]);
        $this->updateCustomer->save();
        $this->getAllCustomers();
        $this->initParams();
        session()->flash('alert-type', 'info');
        session()->flash('alert-message', 'Customer Updated Successfully');
        $this->dispatchBrowserEvent("close-update-customer-modal");
    }

    public function setForDelete($id){
        $this->updateCustomer = Customer::find($id);
        $this->dispatchBrowserEvent("show-delete-modal");
    }

    public function deleteUser(){
        $this->updateCustomer->delete();
        session()->flash('alert-type', 'warning');
        session()->flash('alert-message', 'Customer Removed Successfully');
        $this->getAllCustomers();
        $this->initParams();
        $this->dispatchBrowserEvent("close-delete-modal");

    }


    private function getAllCustomers(){
        $this->allCustomers = Customer::where("admin_id",Auth::user()->id)->get();
    }

    private function  initParams(){
        $this->newCustomer = new Customer();
        $this->updateCustomer = new Customer();
        $this->newCustomer->is_chief = "n";
}


    public function render()
    {
        return view('livewire.user-crud');
    }

    public function mount(){
        $this->getAllCustomers();
        $this->initParams();
    }
}

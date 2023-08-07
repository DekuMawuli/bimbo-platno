<div>
    <div class="row mt-5 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm" style="height: 90vh; overflow-y: auto">
                <div class="card-body">
                    <div class="d-flex justify-content-md-between mb-2">
                        <h4 class="card-title">Registered Customers</h4>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#userCrudModal">
                            &plus; Add New Customer
                        </button>
                    </div>
                    @include("partials.alerts_inc")
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.debounce.500ms="searchQuery" placeholder="Search Customer Name, Phone">
                    </div>
                    <table class="table table-striped table-inverse table-responsive-sm">
                        <thead class="thead-inverse">
                        <tr>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($allCustomers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        @if($customer->is_chief == 'y')
                                            <span class="badge badge-pill badge-success">Regular Customer</span>
                                        @else
                                            <span class="badge badge-pill badge-dark">Occasional Customer</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button wire:click="setForEdit({{ $customer->id }})" class="btn btn-sm btn-info">Edit</button>
                                        <button wire:click="setForDelete({{ $customer->id }})" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    {{--  ADD CUSTOMER MODAL  --}}
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="userCrudModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveCustomer">
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control"  wire:model.lazy="newCustomer.name">
                            @error("newCustomer.name")<small id="helpId" class="form-text text-muted">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" wire:model.lazy="newCustomer.phone" >
                            @error("newCustomer.phone")<small id="helpId" class="form-text text-muted">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" wire:model.lazy="newCustomer.email">
                            @error("newCustomer.email")<small id="helpId" class="form-text text-muted">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control" wire:model.lazy="newCustomer.is_chief">
                                <option value="y">Yes</option>
                                <option value="n">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block" type="submit">Save Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- UPDATE CUSTOMER MODAL  --}}
     <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="updateDetails" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateCustomer">
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control"  wire:model.lazy="updateCustomer.name">
                            @error("updateCustomer.name")<small id="helpId" class="form-text text-muted">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="number" class="form-control" wire:model.lazy="updateCustomer.phone" >
                            @error("updateCustomer.phone")<small id="helpId" class="form-text text-muted">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" wire:model.lazy="updateCustomer.email">
                            @error("updateCustomer.email")<small id="helpId" class="form-text text-muted">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control" wire:model.lazy="updateCustomer.is_chief">
                                <option value="y">Yes</option>
                                <option value="n">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-block" type="submit">Update Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete `<b>{{ $updateCustomer->name }}</b>`
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="deleteUser" class="btn btn-danger">Yes, proceed</button>
                </div>
            </div>
        </div>
    </div>


</div>

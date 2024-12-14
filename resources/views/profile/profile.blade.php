@extends('components.app')
@section('content')

{{-- Title Header --}}
<div class="card bg-dark shadow-none mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <i class='bx bxs-user-detail text-white' style="font-size: 24px;">&nbsp;</i>
            <h4 class="text-white mb-0">Profile</h4>
        </div>
    </div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Update Profile Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-md">
                <label for="defaultFormControlInput" class="form-label">First Name</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp" />
            </div>
            <div class="col-md">
                <label for="defaultFormControlInput" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md">
                <label for="defaultFormControlInput" class="form-label">Email</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
          <div class="row">
            <div class="col-md">
                <label for="defaultFormControlInput" class="form-label">New Password</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp" />
            </div>
            <div class="col-md">
                <label for="defaultFormControlInput" class="form-label">Re-ype Password</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-dark">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<div class="row ">
    <div class="col-md d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-body">
                <div class="d-flex gap-2">
                    <i class='bx bxs-user-circle text-dark fs-1'></i>
                    <h2 class="fw-bold text-dark">John Doe</h2>
                    {{-- <div>John Doe</div> --}}
                    {{-- <div>{{ $user->name }}</div> --}}
                </div>
                <div class="divider divider-secondary">
                    <div class="divider-text">
                        <i class='bx bx-detail text-secondary' ></i>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <i class='bx bxs-envelope' ></i>
                    <div class="fw-bold">Email:</div>
                    <div>JohnDoe@gmail.com</div>
                </div>
                <div class="d-flex gap-2">
                    <i class='bx bxs-badge' ></i>
                    <div class="fw-bold">Team:</div>
                    <div>QWERTY</div>
                </div>
                <div class="d-flex gap-2">
                    <i class='bx bxs-user-badge'></i>
                    <div class="fw-bold">Position:</div>
                    <div>Agent</div>
                </div>
                <div class="row">
                    <div class="col-md d-flex justify-content-end">
                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#updateProfileModal">Update Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('components.specific_page_scripts')

@endsection
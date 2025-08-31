 <div class="modal fade addAddressModal" id="addAddressModal">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body">
                 <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>

                 <div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">
                        <h2 class="modal-title fs-5 mb-3" style="color: #006633;">{{ localize('Add New Address') }}</h2>
                     <div class="row align-items-center g-4 mt-3">
                         <form action="{{ route('address.store') }}" method="POST">
                             @csrf
                             <div class="row g-4">
                                 <div class="col-sm-6">
                                     <div class="w-100 label-input-field">
                                         <label style="color: #198754;">{{ localize('Country') }}</label>
                                         <select class="select2Address" name="country_id" required>
                                             <option value="">{{ localize('Select Country') }}</option>
                                             @foreach ($countries as $country)
                                                 <option value="{{ $country->id }}">{{ $country->name }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="w-100 label-input-field">
                                         <label style="color: #198754;">{{ localize('State') }}</label>
                                         <select class="select2Address" required name="state_id">
                                             <option value="">{{ localize('Select State') }}</option>

                                         </select>
                                     </div>
                                 </div>

                                 <div class="col-sm-6">
                                     <div class="w-100 label-input-field">
                                          <label style="color: #198754;">{{ localize('City') }}</label>
                                         <select class="select2Address" required name="city_id">
                                             <option value="">{{ localize('Select City') }}</option>

                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="w-100 label-input-field">
                                         <label style="color: #198754;">{{ localize('Default Address?') }}</label>
                                         <select class="select2Address" name="is_default">
                                             <option value="0">{{ localize('No') }}</option>
                                             <option value="1">{{ localize('Set Default') }}</option>
                                         </select>
                                     </div>
                                 </div>

                                 <div class="col-sm-6">
                                     <div class="w-100 label-input-field">
                                          <label style="color: #198754;">{{ localize('Address Type') }}</label>
                                         <select class="select2Address" name="address_type">
                                             <option value="billing">{{ localize('Billing') }}</option>
                                             <option value="shipping">{{ localize('Shipping') }}</option>
                                         </select>
                                     </div>
                                 </div>

                                 <div class="col-sm-12">
                                     <div class="label-input-field">
                                         <label style="color: #198754;">{{ localize('Address') }}</label>
                                         <textarea rows="4" placeholder="{{ localize('Samakhusi, Kathmandu, Bagmati, Nepal') }}" name="address" required></textarea>
                                     </div>
                                 </div>

                             </div>
                             <div class="mt-6 d-flex">
                                 <button type="submit"
                                     class="btn btn-secondary btn-md me-3">{{ localize('Save') }}</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade editAddressModal" id="editAddressModal">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body">
                 <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                 <div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">
                     <h2 class="modal-title fs-5 mb-3">{{ localize('Update Address') }}</h2>

                     <div class="spinner pt-6 pb-8 d-none">
                         <div class="row align-items-center g-4 mt-3">
                             <div class="d-flex justify-content-center">
                                 <div class="spinner-border" role="status">
                                     <span class="visually-hidden">Loading...</span>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="edit-address d-none">

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade deleteAddressModal" id="deleteAddressModal">
     <div class="modal-dialog address-delete-modal modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body">
                 <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                 <div class="bg-white rounded-3 py-6 px-4">
                     <h2 class="modal-title fs-5 mb-3">{{ localize('Delete Address') }}</h2>
                     <div class="pt-6 pb-8 text-center">
                         <h6>{{ localize('Want to delete this address?') }}</h6>
                     </div>
                     <div class="text-center">
                         <a href="" class="btn btn-secondary delete-address-link">{{ localize('Delete') }}</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 @section('scripts')
     <script>
         "use strict";

         var parent = '.addAddressModal';

         // runs when the document is ready --> for media files
         $(document).ready(function() {
             if ($("input[name='shipping_address_id']").is(':checked')) {
                 let city_id = $("input[name='shipping_address_id']:checked").data('city_id');
                 getLogistics(city_id);
             }
         });


         //  new address
         function addNewAddress() {
             // Remove any existing modal backdrops
             $('.modal-backdrop').remove();
             $('body').removeClass('modal-open');
             $('body').css('overflow', '');
             $('body').css('padding-right', '');

             // Show the modal
             $('#addAddressModal').modal('show');

             // Ensure the modal is visible and on top
             setTimeout(function() {
                 // Make sure backdrop doesn't block interaction
                 $('.modal-backdrop').css('z-index', '1040');
                 $('#addAddressModal').css('z-index', '1050');
             }, 100);

             parent = '.addAddressModal';
             addressModalSelect2(parent);
         }

         //  edit address
         function editAddress(addressId) {
             // Remove any existing modal backdrops
             $('.modal-backdrop').remove();
             $('body').removeClass('modal-open');
             $('body').css('overflow', '');
             $('body').css('padding-right', '');

             // Show the modal
             $('#editAddressModal').modal('show');
             $('.spinner').removeClass('d-none');
             $('.edit-address').addClass('d-none');

             // Ensure the modal is visible and on top
             setTimeout(function() {
                 // Make sure backdrop doesn't block interaction
                 $('.modal-backdrop').css('z-index', '1040');
                 $('#editAddressModal').css('z-index', '1050');
             }, 100);

             parent = '.editAddressModal';
             getAddress(addressId);
         }

         //  delete address
         function deleteAddress(thisAnchorTag) {
             // Remove any existing modal backdrops
             $('.modal-backdrop').remove();
             $('body').removeClass('modal-open');
             $('body').css('overflow', '');
             $('body').css('padding-right', '');

             // Show the modal
             $('#deleteAddressModal').modal('show');
             $('.delete-address-link').prop('href', $(thisAnchorTag).data('url'));

             // Ensure the modal is visible and on top
             setTimeout(function() {
                 // Make sure backdrop doesn't block interaction
                 $('.modal-backdrop').css('z-index', '1040');
                 $('#deleteAddressModal').css('z-index', '1050');
             }, 100);
         }

         //  get states on country change
         $(document).on('change', '[name=country_id]', function() {
             var country_id = $(this).val();
             getStates(country_id);
         });

         //  get states
         function getStates(country_id) {
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 url: "{{ route('address.getStates') }}",
                 type: 'POST',
                 data: {
                     country_id: country_id
                 },
                 success: function(response) {
                     $('[name="state_id"]').html("");
                     $('[name="state_id"]').html(JSON.parse(response));
                     addressModalSelect2(parent);
                 }
             });
         }

         //  get cities on state change
         $(document).on('change', '[name=state_id]', function() {
             var state_id = $(this).val();
             getCities(state_id);
         });

         //  get cities
         function getCities(state_id) {
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 url: "{{ route('address.getCities') }}",
                 type: 'POST',
                 data: {
                     state_id: state_id
                 },
                 success: function(response) {
                     $('[name="city_id"]').html("");
                     $('[name="city_id"]').html(JSON.parse(response));
                     addressModalSelect2(parent);
                 }
             });
         }

         //  get edit address
         function getAddress(addressId) {
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 url: "{{ route('address.edit') }}",
                 type: 'POST',
                 data: {
                     addressId: addressId
                 },
                 success: function(response) {
                     $('.spinner').addClass('d-none');
                     $('.edit-address').html(response);
                     $('.edit-address').removeClass('d-none');
                     addressModalSelect2(parent);
                 }
             });
         }
     </script>
 @endsection

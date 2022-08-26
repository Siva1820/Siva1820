@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Customer Details</h4>
      <div class="page-header-actions">
         <a href="{{url('/customer')}}" class="btn btn-primary">All Customers</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <form name="customer_form" id="customer_form" novalidate="true" autocomplete="off">
               <input type="hidden" name="id" id="id" value="{{request()->id}}">
               <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Customer Category</label>
                        <select name="category" id="category" class="form-control select2" required>
                           <option value="">Select</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Address 1</label>
                        <textarea name="address1" id="address1" class="form-control" required></textarea>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Pincode</label>
                        <input type="number" name="pincode" id="pincode" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="number" name="mobile" id="mobile" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="">
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <h4>Coordinate Detail</h4>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" name="latitude" id="latitude" class="form-control" value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" name="langtidute" id="langtidute" class="form-control" value="">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <a href="{{url('/customer')}}" class="btn btn-danger">Cancel</a>
                  </div>
                  <div class="col-6" align="right">
                     <a href="javascript:void(0)" class="btn btn-primary" onclick="save_customer_data()">Save</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">

   $(document).ready(function () {
      getCustomerOptions();
   });
   
   let request       = 0;

   function save_customer_data() {
      if (is_form_valid('customer_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#customer_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-customer')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Customer Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/customer')}}";
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Customer Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/customer')}}";
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Customer Already Available",
                        type: "warning",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {});
                  } else {
                     swal({
                        title: "Process failed",
                        text: "",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {});
                  }
                  request = 0;
               }
            });
         }
      } else {
         swal({
            title: "Please Enter",
            text: "Valid Details",
            type: "warning",
            showCancelButton: false,
            confirmButtonClass: "btn-success",
            confirmButtonText: "OK",
            closeOnConfirm: true
         }, function () {
   
         });
      }
   }

   function getCustomerOptions()
   {
      var id = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-customer-options')}}",
         data: {'_token' : '{{ csrf_token() }}','id' : id},
         dataType: 'json',
         success: function (msg) 
         {
            var category   = '<option value="">Select</option>';

            for (var i = 0; i < msg.data.length; i++) 
            {
               var value = msg.data[i];
               category   += '<option value="'+value.id+'">'+value.customercategory+'</option>';
            }
            $("#category").html(category);
            getcustomerDetails();
         }
      });
   }

   function getcustomerDetails()
   {
      var ref = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-customer-details')}}",
         data: {'_token' : '{{ csrf_token() }}','ref' : ref},
         dataType: 'json',
         success: function (msg) 
         {
            if(msg.code==200)
            {
               if(msg.data.length>0)
               {
                  var value = msg.data[0];

                  $("#category").val(value.category);
                  $("#customer_name").val(value.customer_name);
                  $("#address1").val(value.address1);
                  $("#city").val(value.city);
                  $("#pincode").val(value.pincode);
                  $("#mobile").val(value.mobile);
                  $("#email").val(value.email);
                  $("#latitude").val(value.latitude);
                  $("#langtidute").val(value.langtidute);
                  $("#category").select2('val',[value.category]);
               }
            }
         }
      });
   }
</script>
@endpush
@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Supplier Details</h4>
      <div class="page-header-actions">
         <a href="{{url('/supplier')}}" class="btn btn-primary">All Suppliers</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <form name="supplier_form" id="supplier_form" novalidate="true" autocomplete="off">
               <input type="hidden" name="id" id="id" value="{{request()->id}}">
               <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" required value="">
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
                     <a href="{{url('/supplier')}}" class="btn btn-danger">Cancel</a>
                  </div>
                  <div class="col-6" align="right">
                     <a href="javascript:void(0)" class="btn btn-primary" onclick="save_supplier_data()">Save</a>
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
      getsupplierDetails();
   });
   
   let request       = 0;

   function save_supplier_data() {
      if (is_form_valid('supplier_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#supplier_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
   
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-supplier')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Supplier Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/supplier')}}";
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Supplier Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/supplier')}}";
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Supplier Already Available",
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
   
   function getsupplierDetails()
   {
      var ref = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-supplier-details')}}",
         data: {'_token' : '{{ csrf_token() }}','ref' : ref},
         dataType: 'json',
         success: function (msg) 
         {
            if(msg.code==200)
            {
               if(msg.data.length>0)
               {
                  var value = msg.data[0];

                  $("#supplier_name").val(value.supplier_name);
                  $("#address1").val(value.address1);
                  $("#city").val(value.city);
                  $("#pincode").val(value.pincode);
                  $("#mobile").val(value.mobile);
                  $("#email").val(value.email);
                  $("#latitude").val(value.latitude);
                  $("#langtidute").val(value.langtidute);
               }
            }
         }
      });
   }
</script>
@endpush
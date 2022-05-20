@extends("admin.layouts.master")
@section("content")
<?php
$page = (isset($_GET['page']) && $_GET['page']!='')?$_GET['page']:0; 
?>
<div class="content">
   <div class="card">

      <h2 class="mb-4">
         Gift Voucher Import Excel & CSV File
     </h2>
     <form action="{{ route('report.voucher-import') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group mb-4">
             <div class="custom-file text-left">
                 <input type="file" name="file" class="form-control-file" id="customFile">
             </div>
         </div>
         <button class="btn btn-primary">Import</button>
     </form>
   </div>
</div>



@endsection




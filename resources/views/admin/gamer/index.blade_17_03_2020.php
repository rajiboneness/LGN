@extends("admin.layouts.master")
@section("content")
<?php
$page = (isset($_GET['page']) && $_GET['page']!='')?$_GET['page']:0; 
?>
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Gamer Details</h5>
         @php @endphp
         <div class="header-elements">
            @can('Gamer-Create')
            <div class="list-icons">
               <a href="{{route('gamers.create')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i> Add Gamer 
               <i class="mi-add-box"></i></a>
            </div>
            @endcan
         </div>
      </div>
      <div class="table-responsive">
         <table  class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th>Name</th>
                  <!-- <th>Image</th> -->
                  <th>Email</th>
                  <th>Mobile </th>
                  <th>User Type</th>
                  <th>Creation Date</th>
                  @can('Gamer-Edit')
                  <th>Status</th>
                  @endcan
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               if($page!=0){
                   $slno = (($page-1)*100)+1;
               }else{
                   $slno = 1;
               }
               
               ?>
               @if($gamer)
               @foreach($gamer as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->fname}} {{$data->lname}}</td>
                  <!-- <td><img src="{{URL::asset($data->image)}}" style="width:50px; height:50px; float:left; 
                     border-radius:50%; margin-right:25px;"></td> -->
                  <td> {{$data->email}}</td>
                  <td> {{$data->mobile}}</td>
                  <td>
                     <?php
                     if($data->gamer_type==1){
                        echo "Gamer";
                     }else{
                        echo "Team Captain";
                     }
                     ?>
                  </td>
                  <td>{{date("d-M-Y h:i a",strtotime($data->created_at))}}</td>
                  @can('Gamer-Edit') 
                  <td> 
                     @if($data->is_active == 0)
                     <a class="badge bg-danger" href="{{ URL::to('gamers/change-status/'.$data->id) }}">Inactive</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('gamers/change-status/'.$data->id) }}">Active</a>
                  </td>
                  @endif  @endcan
                  <td>
                     <div class="list-icons">
                        @can('Gamer-Read')
                        <a class="badge bg-success" href="{{route('gamers.show',$data->id)}}">Show</a>
                        @endcan
                        @can('Gamer-Edit')
                        <a class="badge bg-primary"href="{{ route('gamers.edit',$data->id) }}">Edit</a>                                            
                        @endcan
                        @can('Gamer-Delete')
                        <a href="#" data-toggle="modal" data-target="#confirm-delete{{$data->id}}" class="badge bg-danger">Delete</a>
                     </div>
                     <div class="modal fade" id="confirm-delete{{$data->id}}" role="dialog" style="text-align: left;">
                        <div class="modal-dialog" style="width: 35%;">
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Confirm Delete</h4>
                              </div>
                              <div class="modal-body">
                                 <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                                 <p>Do you want to proceed?</p>
                              </div>
                              <div class="modal-footer">
                                 {!! Form::open(['method' => 'delete','route' => ['gamers.destroy', $data->id],'style'=>'display:inline']) !!}
                                 {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-fill btn-sm']) !!}
                                 <button type="button" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Cancel</button>
                                 {!! Form::close() !!}
                              </div>
                           </div>
                        </div>
                     </div>
                     @endcan
                  </td>
               </tr>
               <?php $slno = $slno + 1; ?>    
               @endforeach
               @endif               
            </tbody>
         </table>
          {{ $gamer->links() }}
         <div>
        </div>
      </div>
   </div>
</div>
@endsection


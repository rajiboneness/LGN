@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Teams Tournaments  </h5>
         <div class="header-elements">
            @can('Tournaments-Create')
            <div class="list-icons">
              <a class="btn bg-teal-400 text-uppercase" href="{{route('teamstournament.create')}}"><i class="fas fa-plus mr-1"></i>Teams Tournament</a>
            </div>
            @endcan
         </div>
      </div>
      <div class="table-responsive">
        <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th >Team Name</th>
                  <th >Tournament</th>
                  <th>PSN Id</th>
                  @can('Tournaments-Edit')
                  <th>Status</th>
                  @endcan
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($teamstournament)
               @foreach($teamstournament as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->teams}}</td>
                  <td>{{$data->tournaments}}</td>
                  <td>{{$data->in_game_id}}</td>
                  <td>{{$data->in_game_id}}</td>
                  @can('Tournaments-Edit')
                  <td>  
                     @if($data->is_active == 0)
                     <a class="badge bg-danger" href="{{ URL::to('teamstournament/change-status/'.$data->ttid) }}">Inactive</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('teamstournament/change-status/'.$data->ttid) }}">Active</a>
                  </td>
                  @endif @endcan
                  <td>
                     <div class="list-icons">
                        @can('Tournaments-Read')
                        <a class="badge bg-success" href="{{route('teamstournament.show',$data->ttid)}}">Show</a>
                        @endcan
                        <a href="#" data-toggle="modal" data-target="#myModal{{$data->id}}" class="badge bg-success">Show Team Member</a>
                        <!-- Modal -->
                     <div id="myModal{{$data->id}}" class="modal fade show_team_member" role="dialog">
                        <div class="modal-dialog">
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h4 class="modal-title">Team Memeber</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>   
                              </div>
                              <div class="modal-body">
                                 <table  class="table table-striped datatable-responsive">
                                     <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>email</th>
                                       <th>Mobile</th>
                                       <th>In Game Name</th>
                                       <th>In Game Id</th>
                                    </tr>
                                    </thead>
                                    <tbody>                                     
                                      @if($teamsplayers)
                                     @foreach($teamsplayers as $teamsplayer)
                                      @if($data->team_id == $teamsplayer->team_id)
                                    <tr>                                     
                                       <td> {{$teamsplayer->name}}</td>
                                       <td> {{$teamsplayer->email}}</td>
                                       <td> {{$teamsplayer->phone_no}}</td>
                                       <td> {{$teamsplayer->ingame_name}}</td>
                                       <td> {{$teamsplayer->ingame_id}}</td>
                                    </tr>
                                    @endif
                                     </tbody>                                     
                                     
                                       @endforeach
                                       @endif  
                                  </table>  
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                        @can('Tournaments-Edit')
                        <a class="badge bg-primary"href="{{ route('teamstournament.edit',$data->ttid) }}">Edit</a>   
                        @endcan
                        @can('Tournaments-Delete')                                         
                        <a href="#" data-toggle="modal" data-target="#confirm-delete{{$data->ttid}}" class="badge bg-danger">Delete</a>
                     </div>
                     <div class="modal fade" id="confirm-delete{{$data->ttid}}" role="dialog" style="text-align: left;">
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
                                 {!! Form::open(['method' => 'delete','route' => ['teamstournament.destroy', $data->ttid],'style'=>'display:inline']) !!}
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
         <div>
         </div>
      </div>
   </div>
</div>
@endsection


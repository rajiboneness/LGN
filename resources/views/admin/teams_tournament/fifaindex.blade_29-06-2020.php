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
              <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Set Room Password</a>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#myModals1" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Send Email</a>
              
               <button class="btn bg-teal-400 text-uppercase" id="sendEmail"><i class="fas fa-plus mr-1"></i>Send Email</button>

            </div>

            @endcan

         </div>

      </div>

      <div class="table-responsive">

        <table id="example1" class="table table-striped datatable-responsive">

            <thead>

               <tr class="bg-teal-400">
					<th><input type="checkbox" id="checkAll">Check All Gamers</th>
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

                  <td><input type="checkbox" class="chkService" id="customCheck{{$data->id}}" value="{{$data->email}}"></td>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header"> 
               
           <h4 class="modal-title">Set Room Password</h4>           
         <button type="button" class="close" data-dismiss="modal">&times;</button>    
         </div>
         <div class="modal-body">
            <form action="{{route('teamroomSchedule')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
            @csrf 
               <div class="row">           
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Select Room : <em>*</em></label> <br>
                      <select name="room_code" id="room_code" class="form-control" autocomplete="off" required="required">
                        <option value="">Select Room</option>
                        @foreach($tournamentrooms as $room)
                        <option value="{{$room->room_code}}">{{$room->room_code}}</option>
                        @endforeach
                     </select>
                      
                    </div>
                  </div>
               </div>
               <div class="row">           
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Password : <em>*</em></label> <br>
                      <input type="text" name="password" id="password" class="form-control" autocomplete="off" required="required">
                      @if($errors->has('password'))
                      <span class="roy-vali-error"><small>{{$errors->first('password')}}</small></span>
                      @endif
                    </div>
                  </div>
               </div>
               <div class="row">           
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Start date : <em>*</em></label> <br>
                      <input type="date" name="start_date" id="start_date" class="form-control" autocomplete="off" required="required">
                      
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>End date : <em>*</em></label> <br>
                      <input type="date" name="end_date" id="end_date" class="form-control" autocomplete="off" required="required">
                      
                    </div>
                  </div>
               </div>

              <div class="row">           
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Start time : <em>*</em></label> <br>
                      <input type="time" name="start_time" id="start_time" class="form-control" autocomplete="off" required="required">
                      
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>End time : <em>*</em></label> <br>
                      <input type="time" name="end_time" id="end_time" class="form-control" autocomplete="off" required="required">
                    </div>
                  </div>
                </div>
                 <div class="row">           
                      <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div id="myModals1" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">          
           <h4 class="modal-title">Send Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{route('teamsendMail')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
            @csrf 
               <div class="row">           
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Subject : <em>*</em></label> <br>
                      <input type="text" name="subject" id="subject" class="form-control" autocomplete="off" required="required">
                    </div>
                  </div>
               </div>
               <div class="row">           
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Message : <em>*</em></label> <br>
                      <textarea class="form-control" name="message" id="message" autocomplete="off" required="required"></textarea>
                    </div>
                  </div>
               </div>
                 <div class="row">           
                      <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div id="myModals2" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">          
           <h4 class="modal-title">Send Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{route('sendallgameremail')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
              
            @csrf 
               <div class="row">           
                <div class="col-md-12">
                  <div class="form-group">
                      <label>To : <em>*</em></label> <br>
                      <textarea class="form-control" name="to" id="to" autocomplete="off" required="required"></textarea>
                    </div>
                  </div>
               </div>
               <div class="row">           
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Subject : <em>*</em></label> <br>
                      <input type="text" name="subject" id="subject" class="form-control" autocomplete="off" required="required">
                    </div>
                  </div>
               </div>
               <div class="row">           
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Message : <em>*</em></label> <br>
                      <textarea class="form-control" name="message1" id="message1" autocomplete="off" required="required"></textarea>
                    </div>
                  </div>
               </div>
                 <div class="row">           
                      <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
  CKEDITOR.replace('message');
   CKEDITOR.replace ('message1');
 
</script>

<script type="text/javascript">
   var emailArr = [];
   var allEmails = '';
   $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
   });

   $('#sendEmail').click(function() {
      emailArr = [];
      allEmails = '';
      total = 0;
      var $boxes = $('input[type="checkbox"]:checked');

      $boxes.each(function(){
          // Do stuff here with this
          emailArr.push({"email":$(this).val()});
          if(allEmails==''){
            if($(this).val()!='on' && $(this).val()!=''){
               allEmails += $(this).val();
            }
          }else{
            if($(this).val()!='on' && $(this).val()!=''){
               allEmails += ','+$(this).val();
            }
          }
      });

      $('#to').val(allEmails);
      console.log("arr>"+JSON.stringify(emailArr));
      $('#myModals2').modal('show');
   })
</script>
@endsection




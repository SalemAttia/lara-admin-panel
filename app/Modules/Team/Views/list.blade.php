@extends('Dashboard::base.table')
@section('tableTitle', 'Team')


   @section('table')
       <thead>
       <tr>
            <th>Id</th>
           <th>title</th>
			

           <th>Action</th>
       </tr>
       </thead>

       <tbody id="firstbody">
         @php $i = 1; @endphp
       @foreach($data as $val)
       <tr>
            <td>{{ $i++ }}</td>
            <td> {{  $val->title }} </td>
			

           <td>
               @include('Dashboard::base.actions', ['id' => $val->id, 'route' => 'admin.Team' ])
           </td>
       </tr>
       @endforeach
       </tbody>
        <tbody v-if="loading" v-cloak id="secondbody">

                 <tr v-for="(index,val) in data">
                                <td>@{{index+1}}</td>
                    <td> @{{  val.title }} </td>
			

                      <td>
                          @if(getCurrentAdminRoles()->hasOneAction(['admin.Team.show', 'admin.Team.edit', 'admin.Team.destroy']))
                              <div class="dropdown">
                                  <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a>
                                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                      @if(getCurrentAdminRoles()->hasAction('admin.Team.show'))
                                          <li><a class="dropdown-item viewsale"  href="/dashboard/Team/@{{val.id}}"><i class="la la-eye"></i> View</a></li>
                                      @endif


                                          @if(getCurrentAdminRoles()->hasAction('admin.Team.edit'))
                                              <li><a class="dropdown-item editsale" href="/dashboard/Team/@{{val.id}}/edit"><i class="la la-edit"></i> Edit</a></li>
                                          @endif

                                      @if(getCurrentAdminRoles()->hasAction('admin.Team.destroy'))
                                          <li><a class="dropdown-item " href="#"  v-on:click="showModel(val.id)"><i class="la la-trash"></i> Delete</a></li>
                                      @endif
                                  </ul>

                              </div>
                          @endif
                      </td>
                  </tr>

              </tbody>
              <script>
                  var url = 'Team';
              </script>
   @endsection
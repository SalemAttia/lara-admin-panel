@extends('Dashboard::base.table')
@section('tableTitle', 'User')


   @section('table')
       <thead>
       <tr>
           <th>Id</th>
           <th>name</th>
           <th>email</th>
           <th>Action</th>
       </tr>
       </thead>

       <tbody id="firstbody">
         @php $i = 1; @endphp
       @foreach($data as $val)
       <tr>
           <td>{{ $i++ }}</td>
           <td>{{ $val->name }}</td>
           <td>{{ $val->email }}</td>
           <td>
               @include('Dashboard::base.actions', ['id' => $val->id, 'route' => 'admin.User' ])
           </td>
       </tr>
       @endforeach
       </tbody>
        <tbody v-if="loading" v-cloak id="secondbody">

                 <tr v-for="(index,val) in data">
                     <td>@{{index+1}}</td>
                     <td>@{{ val.name }}</td>
                     <td>@{{ val.email }}</td>


                      <td>
                          @if(getCurrentAdminRoles()->hasOneAction(['admin.User.show', 'admin.User.edit', 'admin.User.destroy']))
                              <div class="dropdown">
                                  <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a>
                                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                      @if(getCurrentAdminRoles()->hasAction('admin.User.show'))
                                          <li><a class="dropdown-item viewsale"  href="/dashboard/User/@{{val.id}}"><i class="la la-eye"></i> View</a></li>
                                      @endif


                                          @if(getCurrentAdminRoles()->hasAction('admin.User.edit'))
                                              <li><a class="dropdown-item editsale" href="/dashboard/User/@{{val.id}}/edit"><i class="la la-edit"></i> Edit</a></li>
                                          @endif

                                      @if(getCurrentAdminRoles()->hasAction('admin.User.destroy'))
                                          <li><a class="dropdown-item " href="#"  v-on:click="showModel(val.id)"><i class="la la-trash"></i> Delete</a></li>
                                      @endif
                                  </ul>

                              </div>
                          @endif
                      </td>
                  </tr>

              </tbody>
              <script>
                  var url = 'User';
              </script>
   @endsection
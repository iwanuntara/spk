<style type="text/css">
.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}
</style>
@extends('layouts.master')

@section('content')
<div class="container">
      <div class="row">
     <br />
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   		
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{ $user->nama_lengkap }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-9 col-lg-9 "> 
                  <table id="dynamic-table" class="table table-user-information">
                    <tbody>
                       <tr>
                          <td><strong>Data Password Pengguna</stong></td>
                        <td><input type="hidden" name="id" value="{{ $user->id }}"> </td>
                      </tr>                      
                      <tr>
                        <td>Nama Lengkap</td>
                        <td>{{ $user->name }}</td>
                      </tr> 
                    </tbody>
                  </table> 
                  <form role="form" id="changePassword" method="post" enctype="multipart/form-data" action="{{ url('change-password') }}">
                    {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Password Lama</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-eye-slash" id="current"></i></div>
                        </div>
                        <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Input Password Lama" required>
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Password Baru</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-eye-slash" id="passwords"></i></div>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Input Min 6 karakter">
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Confirm Password</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-eye-slash" id="confirm"></i></div>
                        </div>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Input konfirmasi Password">
                      </div>
                    </div>
                  </div>
                  <br />
                  <div class="btn-profil">
                    <button type="submit" class="btn btn-success"> Update Password </button>
                  </div>
                </div>   
              </form>            
              </div>
            </div>
             <div class="panel-footer">                        
            </div>            
          </div>
        </div>
      </div>
    </div>
    @endsection
    @section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $(function(){
      $('#current').click(function(){
            if($(this).hasClass('fa-eye-slash')){
              $(this).removeClass('fa-eye-slash');
              $(this).addClass('fa-eye');
              $('#current_password').attr('type','text');
            }else{
              $(this).removeClass('fa-eye');
              $(this).addClass('fa-eye-slash'); 
              $('#current_password').attr('type','password');
            }
        });
        $('#passwords').click(function(){
            if($(this).hasClass('fa-eye-slash')){
              $(this).removeClass('fa-eye-slash');
              $(this).addClass('fa-eye');
              $('#password').attr('type','text');
            }else{
              $(this).removeClass('fa-eye');
              $(this).addClass('fa-eye-slash'); 
              $('#password').attr('type','password');
            }
        });
        $('#confirm').click(function(){
            if($(this).hasClass('fa-eye-slash')){
              $(this).removeClass('fa-eye-slash');
              $(this).addClass('fa-eye');
              $('#password_confirmation').attr('type','text');
            }else{
              $(this).removeClass('fa-eye');
              $(this).addClass('fa-eye-slash'); 
              $('#password_confirmation').attr('type','password');
            }
        });
        $('#changePassword').validate({ 
          errorElement: 'div',
          errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
          },
          rules: {
            current_password: {
                  required: true
              },
              password: {
                  required: true,
                  minlength: 6
              },
              password_confirmation: {
                  required: true,
                  equalTo: "#password"
              },
            },
            messages: {
              current_password: {
                required: "Password Lama Harus di Isi"
              },
              password: {
                required: "Password Harus di Isi",
                minlength: "Password Baru Min 6 Karakter"
              },
              password_confirmation: {
                required: "Confirm Password Harus di Isi",
                equalTo: "Confirm tidak sama dengan password"
              },
            }
          })
        });
    });
  </script>
    @endsection
  
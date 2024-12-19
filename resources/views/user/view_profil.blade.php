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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   		
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{ $user->nama_lengkap }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-6 col-lg-6"> 
                  <table id="dynamic-table" class="table table-user-information">
                    <tbody>
                       <tr>
                          <td><strong>Data Pengguna</stong></td>
                        <td><input type="hidden" name="id" value="{{ $user->id }}"> </td>
                      </tr>  
                    </tbody>
                  </table> 
                  <form role="form" method="post" enctype="multipart/form-data" action="{{ url('change-profil') }}">
                    {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" value="{{ $user->name }}" placeholder="Input Nama Lengkap">
                      <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" name="email" class="form-control" value="{{ $user->email }}"  placeholder="Input Email">
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                  </div>
                  <div class="btn-profil">
                    <button type="submit" class="btn btn-success"> Update Data Profile </button>
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
<script type="text/javascript">

  </script>
  
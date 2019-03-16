@extends('layout.admin')

@section('title','用户密码修改')

@section('content')
  <div class="mws-panel grid_8">
      <div class="mws-panel-header">
          <span>修改密码</span>
        </div>
        <div class="mws-panel-body no-padding">
          <form action="/admin/user/password" method='post' enctype='multipart/form-data' class="mws-form">
      
      @if (count($errors) > 0)
         <div class="mws-form-message error">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li style='font-size:17px;list-style:none'>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

            <div class="mws-form-inline">
              <div class="mws-form-row">
                <label class="mws-form-label">用户名:</label>
                <div class="mws-form-item">
                  <input type="text" class="small" name='username' value="{{$res->username}}">
                </div>
              </div>

              <div class="mws-form-row">
                <label class="mws-form-label">原密码:</label>
                <div class="mws-form-item">
                  <input type="password" class="small" name='old' value="">
                </div>
              </div>

              <div class="mws-form-row">
                <label class="mws-form-label">修改密码:</label>
                <div class="mws-form-item">
                  <input type="password" class="small" name='password' value="">
                </div>
              </div>
              <div class="mws-form-row">
                <label class="mws-form-label">再次密码:</label>
                <div class="mws-form-item">
                  <input type="password" class="small" name='re' value="">
                </div>
              </div>
            </div>
            <div class="mws-button-row">
              <input type="submit" class="btn btn-success btn-lg" value="修改">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{$res->id}}">
              <input type="reset" class="btn btn-warning" value="重置">
            </div>
          </form>
        </div>      
    </div>
@endsection
@section('js')
  <script type="text/javascript">
  setTimeout(function(){
    $('.mws-form-message').slideUp(2000);
  },3000)
  </script>

@endsection
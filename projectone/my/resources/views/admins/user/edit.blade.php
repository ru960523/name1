@extends('layout.admin')

@section('title','用户修改')

@section('content')
  <div class="mws-panel grid_8">
      <div class="mws-panel-header">
          <span>用户的修改</span>
        </div>
        <div class="mws-panel-body no-padding">
          <form action="/admin/user/update" method='post' enctype='multipart/form-data' class="mws-form">
              @if (session('info'))
                            <div class="mws-form-message info">
                                {{session('info')}}
                            </div>
                            @endif
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
                  <input type="text" class="small" name='username' value="{{$res->username}}" disabled>
                </div>
              </div>

              <div class="mws-form-row">
                <label class="mws-form-label">邮箱:</label>
                <div class="mws-form-item">
                  <input type="text" class="small" name='email' value="{{$res->email}}">
                </div>
              </div>

              <div class="mws-form-row">
                <label class="mws-form-label">手机号:</label>
                <div class="mws-form-item">
                  <input type="text" class="small" name='phone' value="{{$res->phone}}">
                </div>
              </div>
              <div class="mws-form-row">
                <label class="mws-form-label">文件上传:</label>
                <div class="mws-form-item">
                  <img src="{{$res->profile}}" alt="" width="100" height="100">
                  <input type="file" class="small" name='profile'>
                </div>
              </div>

              <!-- <div class="mws-form-row">
                    <img src="{{$res->profile}}" alt="" width="100" height="100">
                      <label class="mws-form-label">文件上传:</label>
                      <div class="mws-form-item">
                          <div style="position: relative;" class="fileinput-holder"><input type="file" readonly="readonly" class="small"  name='profile' placeholder="No file selected..."><span style="display:block; overflow: hidden; position: absolute; top: 0; right: 0; cursor: pointer;" type="button" class="fileinput-btn btn">Browse...</span></div>
                        </div>
                    </div> -->
                   <div class="mws-form-row">
                        <label class="mws-form-label">用户状态</label>
                        <div class="mws-form-item clearfix">
                             <ul class="mws-form-list inline">
                                <li><input type="radio" name="status" value="0" @if($res->status == '0') checked @endif><label>禁止</label></li>
                                <li><input type="radio" name="status" value="1" @if($res->status == '1') checked @endif> <label>启用</label></li>
                             </ul>
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
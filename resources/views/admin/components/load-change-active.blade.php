@if($data->active==1)
<a class="btn btn-sm btn-success lb-active" data-value="{{$data->active}}" data-type="{{$type?$type:''}}"  style="width:50px;">Hiện</a>
@elseif($data->active == 2)
<a class="btn btn-sm btn-warning lb-active" data-value="{{$data->active}}" data-type="{{$type?$type:''}}"  style="width:50px;">Nháp</a>
@elseif($data->active == 0)
<a class="btn btn-sm btn-info lb-active" data-value="{{$data->active}}" data-type="{{$type?$type:''}}"  style="width:50px;">Ẩn</a>
@endif


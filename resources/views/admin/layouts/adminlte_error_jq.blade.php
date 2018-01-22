{{-- jq 处理错误 --}}
@if (count($errors) > 0)
    @foreach($errors->toArray() as $key => $error)
        @if(count($error) == 1)
        <script>
            var ele =$('#{{$key}}');
            ele.after("<span class='help-block' style='color: #dd4b39;'><strong>{{$error[0]}}</strong></span>");
            ele.parent().addClass('has-error');
        </script>
        @endif
    @endforeach
@endif
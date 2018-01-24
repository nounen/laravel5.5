@extends('admin.layouts.app')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Form Example</h3>
    </div>

    <form role="form" class="form-horizontal" method="POST" action="{{ url('admin/form_example') }}">
        {{ csrf_field() }}

        <div class="box-body">
            {{--text--}}
            <div class="form-group">
                <label for="text" class="col-sm-2">Text</label>
                <div class="col-sm-10">
                    <input type="text" name="text" id="text" class="form-control" placeholder="Enter text">
                </div>
            </div>

            {{--textarea--}}
            <div class="form-group">
                <label for="textarea" class="col-sm-2">Textarea</label>
                <div class="col-sm-10">
                    <textarea name="textarea" id="textarea" class="form-control" placeholder="Enter ..."></textarea>
                </div>
            </div>

            {{-- TODO: 单选 多选 的 id 无法放在 input 元素上 --}}
            {{--radio--}}
            <div class="form-group">
                <label for="radio" class="col-sm-2">Radio</label>
                <div class="radio col-sm-10" id="radio">
                    <label>
                        <input type="radio" name="raido" value="option1" required="required"> Radio 1
                    </label>

                    <label>
                        <input type="radio" name="raido" value="option2" required="required" checked="checked"> Radio 2
                    </label>
                </div>
            </div>

            {{--checkbox--}}
            <div class="form-group">
                <label for="checkbox" class="col-sm-2">Checkbox</label>
                <div class="checkbox col-sm-10" id="checkbox">
                    <label>
                        <input type="checkbox" name="checkbox[]" value="checkout1"> Checkbox 1
                    </label>
                    <label>
                        <input type="checkbox" name="checkbox[]" value="checkout2" checked="checked"> Checkbox 2
                    </label>
                </div>
            </div>

            {{--select--}}
            <div class="form-group">
                <label for="select" class="col-sm-2">Select (多选 multiple="multiple")</label>
                <div class="col-sm-10">
                    <select class="form-control" name="select[]" id="select" checked="checked">
                        <option value="option1">Option 1</option>
                        <option value="option2" selected="selected">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

<pre>
form 属性的列表:
    属性	                    描述
    accept-charset	        规定在被提交表单中使用的字符集（默认：页面字符集）。
    action	                规定向何处提交表单的地址（URL）（提交页面）。
    autocomplete	        规定浏览器应该自动完成表单（默认：开启）。
    enctype	                规定被提交数据的编码（默认：url-encoded）。
    method	                规定在提交表单时所用的 HTTP 方法（默认：GET）。
    name	                规定识别表单的名称（对于 DOM 使用：document.forms.name）。
    novalidate	                规定浏览器不验证表单。
    target	                规定 action 属性中地址的目标（默认：_self）。


所有 HTML 表单元素:
    input 元素:
        type 属性: text / password / submit / radio / checkbox / button / hidden / file / image / reset
        HTML5 输入类型: color / date / datetime / datetime-local / email / month / number / range / search / tel / time / url / week (注释：老式 web 浏览器不支持的输入类型，会被视为输入类型 text。)
    select 元素:
    textarea 元素:
    button 元素:

    HTML5 表单元素:
        datalist:
        keygen:
        output:


输入限制属性:
    属性	                描述
    value	            规定输入字段的默认值。
    required	        规定输入字段是必需的（必需填写）。
    readonly	        规定输入字段为只读（无法修改）。
    disabled	        规定输入字段应该被禁用。
    size	            规定输入字段的宽度（以字符计）。
    maxlength	        规定输入字段的最大字符数。


HTML5 输入限制属性:
    属性                      描述
    autocomplete                规定表单或输入字段是否应该自动完成(值: on / off)
    autofocus                   规定当页面加载时 input 元素应该自动获得焦点(值: 布尔值)
    form
    formaction
    formenctype
    formmethod
    formnovalidate
    formtarget
    height 和 width
    list
    min / max                   规定 input 元素的最小值和最大值(数值, 时间日期 都能限制) eg: `min="2000-01-02"`
    multiple                    规定允许用户在 input 元素中输入一个以上的值(值: 布尔值) eg: 比如上传多个文件, 下拉框多选 等
    pattern (regexp)            规定通过其检查输入值的正则表达式: eg `pattern="\d{11}"`
    placeholder                 规定用以描述输入字段预期值的提示
    required                    规定在提交表单之前必须填写输入字段(值: 布尔值)
    step                        规定 input 元素的合法数字间隔 eg: '0.1' 小数支持(包含位数)
    novalidate                  规定在提交表单时不对表单数据进行验证(form 的属性)
</pre>
</div>
@endsection
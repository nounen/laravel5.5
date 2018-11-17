<div class="row">
    <form role="form" method="get">
        @foreach($filters as $key => $filter)
            @switch($filter['element'])
                {{-- 下拉 --}}
                @case ('select')
                <div class="col-xs-2">
                    <select id="{{ $key }}"
                            name="equal[{{ $key }}]"
                            class="form-control"
                            type="select">
                        {{--<option value="" disabled selected hidden>选择栏目</option>--}}
                        <option value="">{{ $filter['name'] }}</option>

                        @foreach($filter['options']() as $option)
                        <option value="{{ $option['value'] }}"
                                {{ getSelectResult($option['value'], $filter['default']) }}>
                            {{ $option['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @break

                {{-- 日期区间 --}}
                @case('date-range')
                <div class="col-xs-2">
                    <div class="form-group">
                        <div class="input-group date" id="{{ $key }}_start">
                            <input type="text"
                                   id="{{ $key }}_start_input"
                                   class="form-control"
                                   name="between[{{ $key }}][]"
                                   value="{{ $filter['date_start']['default'] }}"
                                   placeholder="{{ $filter['date_start']['placeholder'] }}"/>

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-2">
                    <div class="form-group">
                        <div class="input-group date" id="{{ $key }}_end">
                            <input type="text"
                                   id="{{ $key }}_end_input"
                                   class="form-control"
                                   name="between[{{ $key }}][]"
                                   value="{{ $filter['date_end']['default'] }}"
                                   placeholder="{{ $filter['date_end']['placeholder'] }}"/>

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                             </span>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $(function () {
                        var formatStr = "{{ $filter['format'] }}";

                        // 初始化
                        $("#{{ $key }}_start").datetimepicker({
                            format: formatStr,
                        });
                        $("#{{ $key }}_end").datetimepicker({
                            useCurrent: false,
                            format: formatStr,
                        });

                        // 点击时间监听
                        $("#{{ $key }}_start").on("dp.change", function (e) {
                            $("#{{ $key }}_end").data("DateTimePicker").minDate(e.date);
                            $("#{{ $key }}_start_input").val(e.date.format(formatStr));
                        });

                        $("#{{ $key }}_end").on("dp.change", function (e) {
                            $("#{{ $key }}_start").data("DateTimePicker").maxDate(e.date);
                            $("#{{ $key}}_end_input").val(e.date.format(formatStr));
                        });
                    });
                </script>
                @break

                {{-- 文本搜索 --}}
                @case('dropdown')
                <div class="col-xs-2">
                    <div class="input-group">
                        <div class="input-group-btn">
                            {{-- 下拉按钮 --}}
                            <button type="button"
                                    id="dropdownBtn"
                                    class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                {{ $filter['name'] }}
                            </button>

                            {{-- 下拉项 --}}
                            <ul class="dropdown-menu" style="font-size: small">
                                @foreach($filter['options'] as $option)
                                <li>
                                    <a data-key="{{ $option['key'] }}"
                                       data-name="{{ $option['name'] }}">
                                        {{ $option['name'] }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- 搜索使用的值 --}}
                        <input id="dropdownValue"
                               name="like[{{ $filter['default_key'] }}]"
                               value="{{ $filter['default_value'] }}"
                               type="text"
                               class="form-control">

                        {{-- 辅助字段，用于显示当前下拉文本 --}}
                        <input id="optionKey"
                               name="option_key"
                               value="{{ $filter['default_key'] }}"
                               type="text"
                               class="form-control hidden">

                        <input id="optionName"
                               name="option_name"
                               value="{{ $filter['name'] }}"
                               type="text"
                               class="form-control hidden">

                        <input id="optionValue"
                               name="option_value"
                               value="{{ $filter['default_value'] }}"
                               type="text"
                               class="form-control hidden">

                    </div>

                    <script>
                    $(function() {
                        $('.dropdown-menu li a').click(function() {
                            // 下拉切换变更显示文字
                            var optionKey = $(this).data('key').trim();
                            var optionName = $(this).data('name').trim();

                            $("#dropdownBtn").text(optionName);
                            $("#optionKey").val(optionKey);
                            $("#optionName").val(optionName);

                            // 下拉切换变更 input 框的 name 属性
                            $('#dropdownValue').attr('name', 'like[' + optionKey + ']')
                        });

                        $('#dropdownValue').change(function() {
                            var dropdownValue = $(this).val().trim();
                            $("#optionValue").val(dropdownValue);
                        });
                    });
                    </script>
                </div>
                @break
            @endswitch
        @endforeach

        {{-- 搜索|重置 --}}
        <div class="col-xs-2 text-center">
            <button type="submit"
                    id="search_event"
                    class="btn btn-flat btn-primary">
                搜索
            </button>&nbsp;

            <a href="{{ $base_url }}">
                <button type="button"
                        id="search_reset"
                        class="btn btn-flat btn-warning">
                    重置
                </button>
            </a>
        </div>
    </form>
</div>

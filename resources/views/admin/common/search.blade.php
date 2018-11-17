<div class="row">
    <form role="form" method="get">
        {{-- 下拉 --}}
        <div class="col-xs-2">
            <select id="category_id" name="equal[category_id]" class="form-control" type="select" style="font-size: small">
                {{--<option value="" disabled selected hidden>选择栏目</option>--}}
                <option value="">选择栏目</option>
                <option value="1">linux</option>
                <option value="2">math</option>
                <option value="3">好文</option>
            </select>
        </div>

        {{-- 日期区间 --}}
        <div class="col-xs-2">
            <div class="form-group">
                <div class="input-group date" id="create_at_start">
                    <input type="text"
                           id="created_at_start_input"
                           class="form-control"
                           placeholder="开始时间"
                           name="between[created_at][]"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <div class="input-group date" id="created_at_end">
                    <input type="text"
                           id="created_at_end_input"
                           class="form-control"
                           placeholder="结束时间"
                           name="between[created_at][]"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>

            <script type="text/javascript">
            $(function () {
                var formatStr = "YYYY-MM-DD HH:mm:ss";

                $("#create_at_start").datetimepicker({
                    format: formatStr,
                });

                $("#created_at_end").datetimepicker({
                    useCurrent: false,
                    format: formatStr,
                });

                $("#create_at_start").on("dp.change", function (e) {
                    $("#created_at_end").data("DateTimePicker").minDate(e.date);
                    $("#created_at_start_input").val(e.date.format(formatStr));
                });

                $("#created_at_end").on("dp.change", function (e) {
                    $("#create_at_start").data("DateTimePicker").maxDate(e.date);
                    $("#created_at_end_input").val(e.date.format(formatStr));
                });
            });
            </script>
        </div>

        {{-- 文本搜索 --}}
        <div class="col-xs-2">
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button"
                            id="dropdown-btn"
                            class="btn btn-default dropdown-toggle"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        请选择&nbsp;&nbsp;
                    </button>
                    <ul class="dropdown-menu" style="font-size: small">
                        <li><a data-name="like[title]">标题</a></li>
                        <li><a data-name="like[description]">简介</a></li>
                    </ul>
                </div>
                <input id="inputValue" type="text" class="form-control">
            </div>

            <script>
            $(function() {
                $(".dropdown-menu li a").click(function() {
                    // 下拉切换变更显示文字
                    $("#dropdown-btn").text($(this).text());
                    $("#dropdown-btn").val($(this).text());

                    // 下拉切换变更 input 框的 name 属性
                    $('#inputValue').attr('name', $(this).data('name'))
                });
            });
            </script>
        </div>

        <div class="col-xs-2 text-center">
            <button type="submit" class="btn btn-flat btn-primary" id="search_event">搜索</button>
            &nbsp;
            <a href="{{ $base_url }}">
                <button type="button" class="btn btn-flat btn-warning" id="search_reset">重置</button>
            </a>
        </div>
    </form>
</div>

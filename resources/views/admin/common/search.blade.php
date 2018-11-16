<div class="row">
    <form role="form" method="get">
        <div class="col-xs-2">
            <select id="category_id" name="equal[category_id]" class="form-control" type="select">
                <option selected disabled>栏目</option>
                <option value="1">linux</option>
                <option value="2">math</option>
                <option value="3">好文</option>
            </select>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <div class="input-group date" id="create_at_start">
                    <input type="text" class="form-control"
                           name="between[created_at][]" id="created_at_start_input"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <div class="input-group date" id="created_at_end">
                    <input type="text" class="form-control"
                           name="between[created_at][]" id="created_at_end_input"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
        </div>

        <script type="text/javascript">
        $(function () {
            var formatStr = "YYYY-MM-DD HH:mm:ss";

            $("#create_at_start").datetimepicker({
                format: formatStr,
            });

            $("#created_at_end").datetimepicker({
                useCurrent: false, //Important! See issue #1075
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

        <div class="col-xs-2">
            <button type="submit" class="btn btn-flat btn-primary" id="create_event">提交</button>
        </div>
    </form>
</div>

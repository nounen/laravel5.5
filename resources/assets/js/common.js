$( document ).ready(function() {
    console.log( "common.js ready!" );

    $("#sidebar-click").click(function() {
        setSidebarCollapse();
    });

    // 从cookie获取左侧菜单状态设
    $("#sidebar-effect").addClass(docCookies.getItem("sidebar-collapse"));
});

// 左侧菜单状态设置到 cookie
function setSidebarCollapse() {
    var sidebarCollapse = !$("#sidebar-effect").hasClass("sidebar-collapse");

    if (sidebarCollapse)  {
        docCookies.setItem('sidebar-collapse', 'sidebar-collapse');
    } else {
        docCookies.setItem('sidebar-collapse', '');
    }
}

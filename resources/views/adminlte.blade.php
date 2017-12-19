@extends('layouts.adminlte_app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Default Box Example</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="label label-primary">Label</span>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                The body of the box
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                The footer of the box
            </div>
            <!-- box-footer -->
        </div>
    </div>
    <!-- /.box -->

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">...</div>
            <div class="box box-primary">...</div>
            <div class="box box-info">...</div>
            <div class="box box-warning">...</div>
            <div class="box box-success">...</div>
            <div class="box box-danger">...</div>
        </div>

        <div class="col-md-6">
            <div class="box box-solid box-default">...</div>
            <div class="box box-solid box-primary">...</div>
            <div class="box box-solid box-info">...</div>
            <div class="box box-solid box-warning">...</div>
            <div class="box box-solid box-success">...</div>
            <div class="box box-solid box-danger">...</div>
        </div>
    </div>

    <div class="row">
        <div class="box box-default" data-widget="box-widget">
            <div class="box-header">
                <h3 class="box-title">Box Tools</h3>
                <div class="box-tools">
                    <!-- This will cause the box to be removed when clicked -->
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    <!-- This will cause the box to collapse when clicked -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">93,139</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <!-- /.info-box -->

        <div class="col-md-6">
            <!-- Apply any bg-* class to to the info-box to color it -->
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                    <!-- The progress section is optional -->
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">70% Increase in 30 Days</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Construct the box with style you want. Here we are using box-danger -->
        <!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
        <!-- The contextual class should match the box, so we are using direct-chat-danger -->
        <div class="box box-danger direct-chat direct-chat-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Direct Chat</h3>
                <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-red">3</span>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!-- In box-tools add this button if you intend to use the contacts pane -->
                    <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">Alexander Pierce</span>
                            <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            Is this template really for free? That's unbelievable!
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">Sarah Bullock</span>
                            <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            You better believe it!
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="Contact Avatar">
                                <div class="contacts-list-info">
              <span class="contacts-list-name">
                Count Dracula
                <small class="contacts-list-date pull-right">2/28/2015</small>
                </span>
                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                    </ul>
                    <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-btn">
                <button type="button" class="btn btn-danger btn-flat">Send</button>
                </span>
                </div>
            </div>
            <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
    </div>


    <div class="row">
        <ul data-widget="tree">
            <li><a href="#">One Level</a></li>
            <li class="treeview">
                <a href="#">Multilevel</a>
                <ul class="treeview-menu">
                    <li><a href="#">Level 2</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Collapsible Box Example</h3>
                <div class="box-tools pull-right">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                The body of the box
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                The footer of the box
            </div>
            <!-- box-footer -->
        </div>
        <!-- /.box -->
    </div>
@endsection
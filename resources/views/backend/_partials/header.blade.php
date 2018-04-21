<div class="row border-bottom hidden-print">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>@if ($countNotification = count($me->notificationReceiverNotRead)) <span class="label label-primary">{{$countNotification}}</span> @endif
            </a>
            @if ($countNotification)
            <ul class="dropdown-menu dropdown-alerts">
                @foreach ($me->notificationReceiverNotRead->take(5) as $notification)
                <li>
                    <a class="update-notification" href="{{$notification->url}}" title="{{$notification->text}}" data-id="{{$notification->id}}">
                        <div>
                            <i class="fa {{$notification->icon}} fa-fw"></i> {{str_limit($notification->text,20)}}
                            <span class="pull-right text-muted small">{{$notification->created_at->diffForHumans()}}</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                @endforeach
                <li>
                    <div class="text-center link-block"></div>
                </li>
            </ul>
            @endif
        </li>
        <li>
            <a class="m-r-sm text-muted welcome-message" href="/" target="_blank"><i class="fa fa-desktop"></i> Xem Trang chủ</a>
        </li>
        <li>
            <a href="/logout"><i class="fa fa-sign-out"></i> Log out </a>
        </li>
    </ul>
    </nav>
</div>

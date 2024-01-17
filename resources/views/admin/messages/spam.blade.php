@extends('admin.layouts.master')
@section('Starter Page', 'Control Panel')
@section('title', 'Messages')
@section('content')

    <!-- Main content -->
    {{-- @include('admin.messages.sidebar') --}}
    <!-- /.col -->
    <div class="px-3">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Inbox</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search Mail">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-tools -->
            </div>

            @if (isset($messages) && !empty($messages))
                <!-- الشريط العلوي -->
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                    <div class="float-right">
                        1-50/200
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i
                                    class="fas fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.float-right -->
                </div>
                <!-- الرسالة -->
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>

                                @foreach ($messages as $message)
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check14">
                                                <label for="check14"></label>
                                            </div>
                                        </td>
                                        </td>
                                        @if ($message->status != 'Read')
                                            <td class="mailbox-name"><a
                                                    href="{{ route('messages.show', $message->id) }}"><b>
                                                        {{ $message->name }}</b></a>
                                            @else
                                            <td class="mailbox-name"><a
                                                    href="{{ route('messages.show', $message->id) }}">{{ $message->name }}</a>
                                        @endif
                                        <td class="mailbox-subject">{{ Str::limit($message->message, 50) }}</td>
                                        {{-- <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td> --}}
                                        <td class="mailbox-date">{{ $message->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- الشريط السفلي -->
                <div class="card-footer p-0">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                        <div class="float-right">
                            1-50/200
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i
                                        class="fas fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm"><i
                                        class="fas fa-chevron-right"></i></button>
                            </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.float-right -->
                    </div>
                </div>
            @else
                <div class="h-80 w-full flex justify-center items-center"><img class="h-36 w-36"
                        src="{{ asset('assets/admin/dist/img/mailbox_empty.png') }}" alt=""></div>
            @endif






        </div>
    </div>
    <!-- /.card -->
    <!-- /.col -->
    <!-- /.row -->
    <!-- /.content -->




@endsection

@section('script')

@endsection

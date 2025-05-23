@extends('layouts.tabler.app')
@section('title', 'Chat')
@section('css')
    <link href="{{ URL::asset('build/libs/simplebar/simplebar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="chat-wrapper d-lg-flex gap-1 mx-n1 mt-n1 p-1">
                        <div class="chat-leftsidebar">
                            <div class="px-4 pt-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-4">Chats</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Add Contact">
                                            <button type="button" class="btn btn-soft-success btn-sm">
                                                <i class="ri-add-line align-bottom"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-box">
                                    <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                                    <i class="ri-search-2-line search-icon"></i>
                                </div>
                            </div>

                            <div class="chat-room-list" data-simplebar>
                                <div class="d-flex align-items-center px-4 mb-2">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-0 fs-11 text-muted text-uppercase">Direct Messages</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-sm btn-soft-success">New</button>
                                    </div>
                                </div>

                                <div class="chat-message-list">
                                    <ul class="list-unstyled chat-list chat-user-list" id="userList">
                                        <!-- Users will be loaded here by chat.init.js -->
                                    </ul>
                                </div>

                                <div class="d-flex align-items-center px-4 mt-4 mb-2">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-0 fs-11 text-muted text-uppercase">Channels</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-sm btn-soft-success">Create</button>
                                    </div>
                                </div>

                                <div class="chat-message-list">
                                    <ul class="list-unstyled chat-list chat-user-list mb-0" id="channelList">
                                        <!-- Channels will be loaded here by chat.init.js -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="user-chat w-100 overflow-hidden">
                            <div class="chat-content d-lg-flex">
                                <div class="w-100 overflow-hidden position-relative">
                                    <div class="position-relative">
                                        <div class="p-3 user-chat-topbar">
                                            <div class="row align-items-center">
                                                <div class="col-sm-4 col-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                            <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1">
                                                                <i class="ri-arrow-left-s-line align-bottom"></i>
                                                            </a>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                    <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" class="rounded-circle avatar-xs" alt="">
                                                                    <span class="user-status"></span>
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate mb-0 fs-16">
                                                                        <a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                                            Lisa Parker
                                                                        </a>
                                                                    </h5>
                                                                    <p class="text-truncate text-muted fs-14 mb-0 userStatus">
                                                                        <small>Online</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-4">
                                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="search" class="icon-sm"></i>
                                                                </button>
                                                                <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                    <div class="p-2">
                                                                        <div class="search-box">
                                                                            <input type="text" class="form-control bg-light border-light" placeholder="Search here..." onkeyup="searchMessages()" id="searchMessage">
                                                                            <i class="ri-search-2-line search-icon"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                            <button type="button" class="btn btn-ghost-secondary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                                <i data-feather="info" class="icon-sm"></i>
                                                            </button>
                                                        </li>

                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="more-vertical" class="icon-sm"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="ri-inbox-archive-line fs-16 align-middle me-2"></i>Archive</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="ri-mic-off-line fs-16 align-middle me-2"></i>Muted</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line fs-16 align-middle me-2"></i>Delete</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="position-relative" id="users-chat">
                                            <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar>
                                                <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                                    <!-- Chat messages will be loaded here by chat.init.js -->
                                                </ul>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show" id="copyClipBoard" role="alert">
                                                Message copied
                                            </div>
                                        </div>

                                        <div class="position-relative" id="channel-chat" style="display: none;">
                                            <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar>
                                                <ul class="list-unstyled chat-conversation-list" id="channel-conversation">
                                                    <!-- Channel messages will be loaded here by chat.init.js -->
                                                </ul>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show" id="copyClipBoardChannel" role="alert">
                                                Message copied
                                            </div>
                                        </div>

                                        <div class="chat-input-section p-3 p-lg-4">
                                            <form id="chatinput-form" enctype="multipart/form-data">
                                                <div class="row g-0 align-items-center">
                                                    <!-- Emoji button removed because the emoji picker functionality is disabled -->
                                                    <!-- <div class="col-auto">
                                                        <div class="chat-input-links me-2">
                                                            <div class="links-list-item">
                                                                <button type="button" class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                                                                    <i class="bx bx-smile align-middle"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div> -->

                                                    <div class="col">
                                                        <div class="chat-input-feedback">
                                                            Please Enter a Message
                                                        </div>
                                                        <input type="text" class="form-control chat-input bg-light border-light" id="chat-input" placeholder="Type your message..." autocomplete="off">
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="chat-input-links ms-2">
                                                            <div class="links-list-item">
                                                                <button type="submit" class="btn btn-success chat-send waves-effect waves-light">
                                                                    <i class="ri-send-plane-2-fill align-bottom"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="replyCard">
                                            <div class="card mb-0">
                                                <div class="card-body py-3">
                                                    <div class="replymessage-block mb-0 d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <h5 class="conversation-name"></h5>
                                                            <p class="mb-0"></p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <button type="button" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                                                                <i class="bx bx-x align-middle"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/chat.init.js') }}"></script>
@endsection

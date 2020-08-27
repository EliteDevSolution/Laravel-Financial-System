<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" 
        content="width=device-width, 
        initial-scale=1.0, 
        user-scalable=no" />
  <title>KSBIN Clients</title>
  <style>
  .navbar {
    	background-image: linear-gradient(to right, rgba(25, 75, 147, 0.9) 0%, rgba(33, 91, 176, 0.9) 100%);
    	/*position: absolute;
    	width: 100%;*/
    }
    .navbar-dark .navbar-brand {
        color: #fff;
    }
    #container {
      width: 100%;
      background-color: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      touch-action: none;
    }
    #item {
          width: 20px;
    height: 20px;
    /* background-color: rgb(245, 230, 99); */
    border-left: 10px solid rgba(136, 136, 136, .5);
    border-radius: 50%;
    touch-action: none;
    user-select: none;
    left: 23px !important;
    top: 60px !important;
    border-width: 20px;
    background: url(http://client.ksbin.com/img/sign-bg.png);
    background-size: 20px 20px;
    background-position: 100% 100%;
    border-top: 4px solid rgba(136, 136, 136, .5);
    }
    #item:active {
      background-color: rgba(168, 218, 220, 1.00);
    }
    #item:hover {
      cursor: pointer;
    }
    .main-heading {
      color: #fff;
      padding: 10px;
      border-radius: 5px;
      background-image: linear-gradient(110deg, rgba(99, 134, 183, 0.9) 0%, rgba(18, 70, 148, 0.9) 100%);
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
      margin: 0 auto;
      font-size: 18px;
    }
    .btn-info {
      color: #fff;
    }
  </style>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" 
        content="width=device-width, 
        initial-scale=1.0, 
        user-scalable=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>KSBIN Clients</title>
        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap.css') }}">
        
</head>

@php
    if (Auth::user()->role->name == "admin") {
        echo '<script>window.location = "/admin";</script>';
    }
@endphp

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-white shadow">
                <div class="container">
                    
                    <a class="navbar-brand" href="{{ url('/') }}">
                        K.S. BILLING & ASSOCIATES INC.
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            @if (Route::currentRouteName() != 'user.edit')
                                {{-- expr --}}
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item border-bottom" href="/">My Account</a>
                                    <a class="dropdown-item border-bottom" href="{{ route('user.edit', Auth::user()->id) }}">Change Password</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            @else

                                <li class="nav-item">
                                    <a class="nav-link" href="/">Return</a>
                                </li>

                            @endif
                            
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
<div id="profile-page">
    
    <div id="contract">
        <div class="container">
            <div class="row text-center">
                <h1 class="d-inline-block mt-3 mb-1 text-capitalize main-heading">Document Uploaded, You Can Sign It Now</h1>
            </div>
            {{-- <div class="row">
                <object data="{{ asset('storage/invoices/17V7XELxFnXXnRpGdan560ZkJDsAShuvbFTuV9Zn.pdf') }}" type=”application/pdf” width=”100%” height=”100%”>
            </div> --}}
            
            <div class="row mb-5">
                <div class="col-md-12 mt-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @if($errors->has('user-signature'))
                                <li>Signature Is Required</li>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-md-6" id="change-the-order">

                    @if ($claim->signed == 0)
                        <h3>Ready To Sign?</h3>
                    @else
                        <div class="alert alert-success disabled mb-3">
                            Contract Signed Already!
                        </div>
                    @endif
                    <b>Name : </b> {{ $user->name }} <br>
                    <b>Email : </b> {{ $user->email }} <br>
                    <b>Policy Number : </b> {{ $user->policy_number }} <br>
                    <b>Document : </b> {{ $claim->name }} <br>
                    
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible pr-2">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4><b>Instructions:</b></h4>
                        <ul class="pl-2">
                            <li>Click Any Where In The Box To Open Signing Panel.</li>
                            <li>Press & Hold <i class="fa fa-arrows" aria-hidden="true" id="moving-arrow2"></i> to drag the signs on the <b>Contract</b></li>
                            <li>Press Confirm Sign When You Are Sure You Have The Sign In The Right Place.</li>
                        </ul>
                    </div>
                </div>
                <script>
                    function doCapture() {
                        
                        // if (screen.width <= 500) {
                        window.scrollTo(0, 0);
                        $('#signing-pdf').fadeIn('slow', function() {
                            setTimeout("$('#signing-pdf').fadeOut('slow');", 2000);
                        });
                        $("#confirmation-form").delay(3000).fadeIn(000);
                            $("img").css({"border": "none"});
                            $("#moving-arrow").css({"display": "none"});
                            $(".confirm-sign-btn").css({"display": "none"});
                            $("#draggable").css({"pointer-events": "none"});
                            $("#draggable").css({"background": "transparent"});
                            // $("#confirmation-form").css({"display": "flex"});
                            $("#confirmation-form-none").css({"display": "none"});
                            $("#item").css({"background-color": "transparent"});
                            $("#item").css({"border-color": "transparent"});
                            $("#item").css({"left": "15px"});
                            $("#item").css({"top": "15px"});
                            $("#item").css({"background": "none"});
                            $("img").css({"background": "transparent"});
                            var getSignature = document.getElementById("txt").value;
                    
                        // }
                
                    // window.scrollTo(0, 0);
                        html2canvas(document.getElementById("container")).then(function (canvas) {
                            // document.getElementById("myImg").src = canvas.toDataURL("image/jpeg", 0.9);
                            var theContract = canvas.toDataURL("image/jpeg", 0.9);
                            document.getElementById("myFile").value = theContract;
                            document.getElementById("myDiv").innerHTML = "Contract Signed";
                            document.getElementById("txt2").value = theContract;
                            console.log(theContract);
                        });
                    }
                </script>
                <div class="col-md-12 contract-box">
                    <div class="row mb-3">
                        <div class="col-md-6" id="confirmation-form-none">
                            @if ($claim->signed == 0) 
                             <button onclick="doCapture();" class="btn btn-primary">Sign Now</button>
                             
                             <button onclick="enableCanvas();" class="btn btn-primary open-sign-box" style="display: none;">Open Sign Box</button>
                             <button type="button" class="btn btn-success btn-instructions" style="display: none;" data-toggle="modal" data-target="#exampleModal">
                              Instructions
                            </button>
                             <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <ul class="pl-2">
                                        <li>Click Any Where In The Box To Open Signing Panel.</li>
                                        <li>Press & Hold <i class="fa fa-arrows" aria-hidden="true" id="moving-arrow2"></i> to drag the signs on the <b>File</b></li>
                                        <li>Press Confirm Sign When You Are Sure You Have The Sign In The Right Place.</li>
                                    </ul>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
   
                            @else
                                Redirecting...
                                <script type="text/javascript">
                                    window.location = "/";
                                </script>
                            @endif
                        </div>
                        <div class="col-md-6" style="display:none;" id="signing-pdf">
                            <img src="{{ asset('img/loading.gif') }}" width="40px">
                        </div>
                        <div class="col-md-6" style="display: none;" id="confirmation-form">
                            <div>
                                
                                <button onClick="window.location.reload();" class="btn btn-outline-primary">⇐ Sign Again</button>
                            </div>
                            <div>
                                <form action="/user/claim/signed/{{ $user->id }}/{{ $claim->id }}" style="position: absolute;left: 33%;top:0" method="POST">
                                    @csrf
                                    <input type="hidden" value="" id="myFile" name="user-claim">
                                    <input type="hidden" value="" id="txt2" style="border-radius: 5px;" name="user-signature">
                                    <input type="submit" class="btn btn-success confirm-sign-btn float-right d-block" value="Confirm Signing ⇒">
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    

                    @if ($claim->signed == 0)    
                    
                    {{-- USER SIGNATURE --}}
                      <div class="panel panel-default">
                        <div class="panel-body">
                            <script src="{{ asset('js/html2canvas.js') }}"></script> 
                            
                            <div class="container">
                              <div class="row">
                                  
                                  <div id="container" class="contract-here p-0 m-0 border">
                                      <form id="item" style="position:absolute;background-color: rgba(0,0,0,0.2);">
                                        @csrf
                                        <input type="text" id="txt" style="border-radius: 5px;">
                                        <!--<i class="fa fa-arrows" aria-hidden="true" id="moving-arrow" data-toggle="tooltip" data-placement="top" title="Drag Sign"></i>-->
                                      </form>
                                      <img src="{{ asset('storage/claims/'.$claim->claim.'') }} " class="w-100">
                                  </div>
                                  
                              </div>
                          </div>
                        </div>
                      </div>
                      <div id="myDiv"></div>
{{-- 
                      @else

                        <img src="{{ asset('storage/signs/'.$claim->userSign.'') }}" alt="" width="300px"> --}}

                      @endif
                    
                </div>
            </div>
            
        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    if (screen.width <= 500) {
        $( "#change-the-order" ).addClass( "order-2" );
    }
</script>
  <script>
    var dragItem = document.querySelector("#item");
    var container = document.querySelector("#container");

    var active = false;
    var currentX;
    var currentY;
    var initialX;
    var initialY;
    var xOffset = 0;
    var yOffset = 0;

    container.addEventListener("touchstart", dragStart, false);
    container.addEventListener("touchend", dragEnd, false);
    container.addEventListener("touchmove", drag, false);

    container.addEventListener("mousedown", dragStart, false);
    container.addEventListener("mouseup", dragEnd, false);
    container.addEventListener("mousemove", drag, false);

    function dragStart(e) {
      if (e.type === "touchstart") {
        initialX = e.touches[0].clientX - xOffset;
        initialY = e.touches[0].clientY - yOffset;
      } else {
        initialX = e.clientX - xOffset;
        initialY = e.clientY - yOffset;
      }

      if (e.target === dragItem) {
        active = true;
      }
    }

    function dragEnd(e) {
      initialX = currentX;
      initialY = currentY;

      active = false;
    }

    function drag(e) {
      if (active) {
      
        e.preventDefault();
      
        if (e.type === "touchmove") {
          currentX = e.touches[0].clientX - initialX;
          currentY = e.touches[0].clientY - initialY;
        } else {
          currentX = e.clientX - initialX;
          currentY = e.clientY - initialY;
        }

        xOffset = currentX;
        yOffset = currentY;

        setTranslate(currentX, currentY, dragItem);
      }
    }

    function setTranslate(xPos, yPos, el) {
      el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
    }
  </script>
  <script>
    // window.onload = function() {
    //     if(!window.location.hash) {
    //         window.location = window.location + '#loaded';
    //         window.location.reload();
    //     }
    // }
</script>
<style>
    body {
        background: url({{ asset('img/square.png') }}) repeat;
    }
    
    #moving-arrow {
        background: #000;
        padding: 5px;
        border-radius: 50%;
        color: #fff;
        position: absolute;
        right: -10px;
        top: -10px;
    }
    #moving-arrow:hover {
        cursor: grab;
    }
    #moving-arrow:active {
        cursor: grabbing;
    }
    #moving-arrow2{
        background: #000;
        padding: 5px;
        border-radius: 50%;
        color: #fff;
    }
    #moving-arrow2:hover {
        cursor: grab;
    }
    #moving-arrow2:active {
        cursor: grabbing;
    }
    .confirm-sign-btn {
        position: absolute;
        top: 99% !important;
        left: 30% !important;
    }
    #signPadBig {
        z-index: 999;
    }
    .btn-instructions {
        display:;
    }
    @media only screen and (max-width: 600px) {
        .btn-instructions {
            display: inline-block !important;
        }
        #container .w-100 {
            width: 98% !important;
            margin-right: auto;
        }
    }
</style>
<script>
//add a very big pad
var big_pad = $('#signPadBig');
var back_drop = $('#signPadBigBackDrop');
    //sketch lib
(function () {
    var __slice = [].slice;

    (function ($) {
        var Sketch;
        $.fn.sketch = function () {
            var args, key, sketch;
            key = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            if (this.length > 1) {
                $.error('Sketch.js can only be called on one element at a time.');
            }
            sketch = this.data('sketch');
            if (typeof key === 'string' && sketch) {
                if (sketch[key]) {
                    if (typeof sketch[key] === 'function') {
                        return sketch[key].apply(sketch, args);
                    } else if (args.length === 0) {
                        return sketch[key];
                    } else if (args.length === 1) {
                        return sketch[key] = args[0];
                    }
                } else {
                    return $.error('Sketch.js did not recognize the given command.');
                }
            } else if (sketch) {
                return sketch;
            } else {
                this.data('sketch', new Sketch(this.get(0), key));
                return this;
            }
        };
        Sketch = (function () {

            function Sketch(el, opts) {
                this.el = el;
                this.canvas = $(el);
                this.context = el.getContext('2d');
                this.options = $.extend({
                    toolLinks: true,
                    defaultTool: 'marker',
                    defaultColor: '#000000',
                    defaultSize: 2
                }, opts);
                this.painting = false;
                this.color = this.options.defaultColor;
                this.size = this.options.defaultSize;
                this.tool = this.options.defaultTool;
                this.actions = [];
                this.action = [];
                this.canvas.bind('click mousedown mouseup mousemove mouseleave mouseout touchstart touchmove touchend touchcancel', this.onEvent);
                if (this.options.toolLinks) {
                    $('body').delegate("a[href=\"#" + (this.canvas.attr('id')) + "\"]", 'click', function (e) {
                        var $canvas, $this, key, sketch, _i, _len, _ref;
                        $this = $(this);
                        $canvas = $($this.attr('href'));
                        sketch = $canvas.data('sketch');
                        _ref = ['color', 'size', 'tool'];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            key = _ref[_i];
                            if ($this.attr("data-" + key)) {
                                sketch.set(key, $(this).attr("data-" + key));
                            }
                        }
                        if ($(this).attr('data-download')) {
                            sketch.download($(this).attr('data-download'));
                        }
                        return false;
                    });
                }
            }

            Sketch.prototype.download = function (format) {
                var mime;
                format || (format = "png");
                if (format === "jpg") {
                    format = "jpeg";
                }
                mime = "image/" + format;
                return window.open(this.el.toDataURL(mime));
            };

            Sketch.prototype.set = function (key, value) {
                this[key] = value;
                return this.canvas.trigger("sketch.change" + key, value);
            };

            Sketch.prototype.startPainting = function () {
                this.painting = true;
                return this.action = {
                    tool: this.tool,
                    color: this.color,
                    size: parseFloat(this.size),
                    events: []
                };
            };


            Sketch.prototype.stopPainting = function () {
                if (this.action) {
                    this.actions.push(this.action);
                }
                this.painting = false;
                this.action = null;
                return this.redraw();
            };

            Sketch.prototype.onEvent = function (e) {
                if (e.originalEvent && e.originalEvent.targetTouches) {
                    e.pageX = e.originalEvent.targetTouches[0].pageX;
                    e.pageY = e.originalEvent.targetTouches[0].pageY;
                }
                $.sketch.tools[$(this).data('sketch').tool].onEvent.call($(this).data('sketch'), e);
                e.preventDefault();
                return false;
            };

            Sketch.prototype.redraw = function () {
                var sketch;
                //this.el.width = this.canvas.width();
                this.context = this.el.getContext('2d');
                sketch = this;
                $.each(this.actions, function () {
                    if (this.tool) {
                        return $.sketch.tools[this.tool].draw.call(sketch, this);
                    }
                });
                if (this.painting && this.action) {
                    return $.sketch.tools[this.action.tool].draw.call(sketch, this.action);
                }
            };

            return Sketch;

        })();
        $.sketch = {
            tools: {}
        };
        $.sketch.tools.marker = {
            onEvent: function (e) {
                switch (e.type) {
                    case 'mousedown':
                    case 'touchstart':
                        if (this.painting) {
                            this.stopPainting();
                        }
                        this.startPainting();
                        break;
                    case 'mouseup':
                        //return this.context.globalCompositeOperation = oldcomposite;
                    case 'mouseout':
                    case 'mouseleave':
                    case 'touchend':
                        //this.stopPainting();
                    case 'touchcancel':
                        this.stopPainting();
                }
                if (this.painting) {
                    this.action.events.push({
                        x: e.pageX - this.canvas.offset().left,
                        y: e.pageY - this.canvas.offset().top,
                        event: e.type
                    });
                    return this.redraw();
                }
            },
            draw: function (action) {
                var event, previous, _i, _len, _ref;
                this.context.lineJoin = "round";
                this.context.lineCap = "round";
                this.context.beginPath();
                this.context.moveTo(action.events[0].x, action.events[0].y);
                _ref = action.events;
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    event = _ref[_i];
                    this.context.lineTo(event.x, event.y);
                    previous = event;
                }
                this.context.strokeStyle = action.color;
                this.context.lineWidth = action.size;
                return this.context.stroke();
            }
        };
        return $.sketch.tools.eraser = {
            onEvent: function (e) {
                return $.sketch.tools.marker.onEvent.call(this, e);
            },
            draw: function (action) {
                var oldcomposite;
                oldcomposite = this.context.globalCompositeOperation;
                this.context.globalCompositeOperation = "destination-out";
                action.color = "rgba(0,0,0,1)";
                $.sketch.tools.marker.draw.call(this, action);
                return this.context.globalCompositeOperation = oldcomposite;
            }
        };
    })(jQuery);

}).call(this);


(function ($) {
    $.fn.SignaturePad = function (options) {

        //update the settings
        var settings = $.extend({
            allowToSign: true,
            img64: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
            border: '1px solid #c7c8c9',
            width: '300px',
            height: '150px',
            callback: function () {
                return true;
            }
        }, options);

        //control should be a textbox
        //loop all the controls
        var id = 0;

        
        var canvas = undefined;
        if (big_pad.length == 0) {

            back_drop = $('<div>')
            back_drop.css('position', 'fixed');
            back_drop.css('top', '0');
            back_drop.css('right', '0');
            back_drop.css('bottom', '0');
            back_drop.css('left', '0');
            back_drop.css('z-index', '1040 !important');
            back_drop.css('background-color', '#000');
            back_drop.css('display', 'none');
            back_drop.css('filter', 'alpha(opacity=50)');
            back_drop.css('opacity', '0.5');
            $('body').append(back_drop);

            big_pad = $('<div>');
            big_pad.css('display', 'none');
            big_pad.css('position', 'fixed');
            big_pad.css('margin', '0 auto');
            big_pad.css('top', '0');
            big_pad.css('bottom', '0');
            big_pad.css('right', '0');
            big_pad.css('left', '0');
            big_pad.css('z-index', '1000002 !important');
            big_pad.css('overflow', 'hidden');
            big_pad.css('outline', '0');
            big_pad.css('-webkit-overflow-scrolling', 'touch');

            big_pad.css('right', '0');
            big_pad.css('border', '1px solid #c8c8c8');
            big_pad.css('padding', '15px');
            big_pad.css('background-color', 'white');
            big_pad.css('margin-top', '15px');
            big_pad.css('width', '95%');
            big_pad.css('height', '90%');
            big_pad.css('border-radius', '10px');
            big_pad.attr('id', 'signPadBig');
            $('body').append(big_pad);

            var update_canvas_size = function () {
                var w = big_pad.width() //* 0.95;
                var h = big_pad.height() - 55;

                canvas.attr('width', w);
                canvas.attr('height', h);
            }


            canvas = $('<canvas>');
            canvas.css('display', 'block');
            canvas.css('margin', '0 auto');
            canvas.css('border', '1px solid #c8c8c8');
            canvas.css('border-radius', '10px');
            //canvas.css('width', '90%');
            //canvas.css('height', '80%');
            big_pad.append(canvas);

            update_canvas_size();
            $(window).on('resize', function () {
                update_canvas_size();
            });

            var clearCanvas = function () {
                canvas.sketch().action = null;
                canvas.sketch().actions = [];       // this line empties the actions. 
                var ctx = canvas[0].getContext("2d");
                ctx.clearRect(0, 0, canvas[0].width, canvas[0].height);
                return true
            }

            var _get_base64_value = function () {
                var text_control = $.data(big_pad[0], 'control');  //settings.control; // $('#' + big_pad.attr('id'));
                return $(text_control).val();
            }

            var copyCanvas = function () {
                //get data from bigger pad
                var sigData = canvas[0].toDataURL("image/png");

                var _img = new Image;
                _img.onload = resizeImage;
                _img.src = sigData;

                var targetWidth = canvas.width();
                var targetHeight = canvas.height();

                function resizeImage() {
                    var imageToDataUri = function (img, width, height) {

                        // create an off-screen canvas
                        var canvas = document.createElement('canvas'),
                            ctx = canvas.getContext('2d');

                        // set its dimension to target size
                        canvas.width = width;
                        canvas.height = height;

                        // draw source image into the off-screen canvas:
                        ctx.drawImage(img, 0, 0, width, height);

                        // encode image to data-uri with base64 version of compressed image
                        return canvas.toDataURL();
                    }

                    var newDataUri = imageToDataUri(this, targetWidth, targetHeight);
                    var control_img = $.data(big_pad[0], 'img');
                    if (control_img)
                        $(control_img).attr("src", newDataUri);

                    var text_control = $.data(big_pad[0], 'control');  //settings.control; // $('#' + big_pad.attr('id'));
                    if (text_control)
                        $(text_control).val(newDataUri);
                }
            }

            var buttons = [
                 {
                     title: 'Close',
                     callback: function () {
                         clearCanvas();
                         big_pad.slideToggle(function () {
                             back_drop.hide('fade');
                         });

                     }
                 },
                 {
                     title: 'Clear',
                     callback: function () {
                         clearCanvas();
                         if (settings.callback)
                             settings.callback(_get_base64_value(), 'clear');
                     }
                 },
                 {
                     title: 'Accept',
                     callback: function () {
                         copyCanvas();
                         clearCanvas();
                         big_pad.slideToggle(function () {
                             back_drop.hide('fade', function () {
                                 if (settings.callback)
                                     settings.callback(_get_base64_value(), 'accept');
                             });
                         });
                     }
                 }].forEach(function (e) {
                     var btn = $('<button>');
                     btn.attr('type', 'button');
                     btn.css('border', '1px solid #c8c8c8');
                     btn.css('background-color', 'white');
                     btn.css('padding', '10px');
                     btn.css('display', 'block');
                     btn.css('margin-top', '15px');
                     btn.css('margin-right', '5px');
                     btn.css('cursor', 'pointer');
                     btn.css('border-radius', '5px');
                     btn.css('float', 'right');
                     btn.css('height', '40px');
                     btn.text(e.title);
                     btn.on('click', function () {
                         e.callback(e.title);
                     })
                     big_pad.append(btn);

                 });

        }
        else {
            canvas = big_pad.find('canvas')[0];
        }

        //init the signpad
        if (canvas) {
            var sign1big = $(canvas).sketch({ defaultColor: "#000", defaultSize: 5 });
        }

        //for each control
        return this.each(function () {

            var control = $(this);
            control.hide();

            //get the control parent
            var wrapper = control.parent();
            var img = $('<img>');

            //style it
            img.css("cursor", "pointer");
            img.css("border", settings.border);
            img.css("height", settings.height);
            img.css("width", settings.width);
            img.css('border-radius', '5px');
            img.css('background-color', 'rgba(0,0,0,0.2)');
            img.attr("src", settings.img64);

            if (typeof (wrapper) == 'object') {
                wrapper.append(img);
            }




            //init the big sign pad
            if (settings.allowToSign == true) {
                //click to the pad bigger
                img.on('click', function () {
                    //show the pad
                    back_drop.show();
                    big_pad.slideToggle();

                    //save control to use later
                    $.data(big_pad[0], 'img', img);
                    $.data(big_pad[0], 'control', control);

                    //settings.control = control;
                    //settings.img = img;
                });
            }
        });
    };


})(jQuery);


</script>
<script>
  $(document).ready(function () {
      
    if (screen.width <= 500) {  
        var sign = $('#txt').SignaturePad({
            allowToSign: true,
            img64: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
            border: '1px solid #c7c8c9',
            width: '150px',
            height: '100px',
            background: 'rgba(0,0,0,0.2)',
            callback: function (data, action) {
                console.log(data);
            }
        });
    } else {
        var sign = $('#txt').SignaturePad({
            allowToSign: true,
            img64: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
            border: '1px solid #c7c8c9',
            width: '250px',
            height: '150px',
            background: 'rgba(0,0,0,0.2)',
            callback: function (data, action) {
                console.log(data);
            }
        });
    }

  })
    
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

</body>

</html>
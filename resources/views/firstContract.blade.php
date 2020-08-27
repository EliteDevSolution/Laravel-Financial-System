<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KSBIN Clients</title>
    <!-- Scripts -->
    {{--
    <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    {{--
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.20/r-2.2.3/datatables.min.css" />
    <style type="text/css" media="all">
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        
        a {
            color: #0087C3;
            text-decoration: none;
        }
        
        body {
            position: relative;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-size: 14px;
        }
        
        header {
            padding: 10px 0;
        }
        
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
        }
        
        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }
        
        table tr {
            border: 1px solid #ddd;
            padding: .35em;
        }
        
        table tr:nth-child(even) {
            background: #fff;
        }
        
        table th,
        table td {
            padding: .625em;
            text-align: left;
        }
        
        table th {
            background: #0d0d0d;
            color: #fff;
            font-size: 1em;
            letter-spacing: .1em;
            text-transform: uppercase;
            text-align: center;
        }
        
        table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .center-text {
            text-align: center;
        }
        
        .border-all {
            border: 1px solid gray
        }
        
        .small-row th {
            font-size: 10px;
        }
        .name {
            fonts-size: 24px;
            font-weight: bold;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
$(function(){
var sPositions = localStorage.positions || "{}",
    positions = JSON.parse(sPositions);
$.each(positions, function (id, pos) {
    $("#" + id).css(pos)
})
$("#draggable").draggable({
    scroll: false,
    stop: function (event, ui) {
        positions[this.id] = ui.position
        localStorage.positions = JSON.stringify(positions)
    }
});
});
</script>
    

        <h2 class="name center-text">VOLUNTARY BROKER OF RECORD CHANGE</h2>
        <p class="center-text">
            ATIC 010807
        </p>

    
    <table>
        <thead>
            <tr>
                <th scope="col">PRODUCER</th>
                <th scope="col">INSURANCE COMPANY NAME</th>
            </tr>
        </thead>
    </table>
    <table style="margin-top: 25px;">
        <tbody>
            <tr>
                <td scope="row" class="border-all"></td>
                <td class="border-all" style="line-height: 15px;padding-bottom: 35px;">AMERICAN TRANSIT INSURANCE COMPANY, INC.
                    <br> (033) 330 WEST 34<sup>TH</sup>. STREET
                    <br>NEW YORK, NY 10001</td>
            </tr>
        </tbody>
    </table>
    <table style="width: 50%; margin-top: 25px;">
        <thead>
            <tr>
                <th scope="col" class="border-all" style="width: 30%;">CODE</th>
                <td scope="col" class="border-all" style="width: 69%;"></td>
            </tr>
        </thead>
    </table>
    <table style="margin-top: 25px;" class="small-row">
        <thead>
            <tr>
                <th scope="col" class="border-all center-text" colspan="4">POLICY NUMBER</th>
                <th scope="col" class="border-all center-text" colspan="4">INSURED</th>
                <th scope="col" class="border-all center-text" colspan="4">MED/PLATE#</th>
                <th scope="col" class="border-all center-text" colspan="3">EFF. DATE</th>
                <th scope="col" class="border-all center-text" colspan="3">EXP. DATE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row" class="border-all" colspan="4" height="15"><img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Empty.png" width="50px"></td>
                <td scope="row" class="border-all" colspan="4"></td>
                <td scope="row" class="border-all" colspan="4"></td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
            </tr>
        </tbody>
    </table>
    <p style="margin-top: 25px;font-weight: bold;">Statment Of Insured:</p>
    <p>I ___________________________, hereby request American Transit Insurance Company, Inc. to recognize my Producer of record _______________________ effective as __/__/____ .</p>
    <p>This authorization replaces any other authorization that may have been previously completed for any other Insurance Representative for the stated line of Business.</p>
    <table style="margin-top: 25px;" class="small-row">
        <thead>
            <tr>
                <th scope="col" class="border-all center-text" colspan="8">INSURED'S SIGNATURE</th>
                <th scope="col" class="border-all center-text" colspan="3">DATE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row" class="border-all center-text" colspan="8" height="15">
                    @if ($contract->userSign == '0' || $contract->userSign == '')
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Empty.png" width="50px">
                    @else
                        @php
                            $imageName = $contract->userSign;
                        @endphp
                            <img src="{{ asset('storage/signs/'.$imageName.'') }}" width="100px;" id="draggable">
                        
                    @endif
                    
                </td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 25px;" class="small-row">
        <thead>
            <tr>
                <th scope="col" class="border-all center-text" colspan="8">PRODUCERS'S SIGNATURE</th>
                <th scope="col" class="border-all center-text" colspan="3">DATE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row" class="border-all center-text" colspan="8" height="15">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Empty.png" width="50px">
                </td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
                <td scope="row" class="border-all"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
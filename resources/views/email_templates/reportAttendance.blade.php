<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- So that mobile will display zoomed in -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- enable media queries for windows phone 8 -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- disable auto telephone linking in iOS -->
        <meta name="format-detection" content="telephone=no">

        <title> Sample Email </title>

        <style>
            /*--------- main ---------*/
                body {
                    font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
                    box-sizing:border-box;
                    background-color:#f8fafc;
                    color:#74787e;
                    height:100%;
                    line-height:1.4;
                    margin:0;
                    width:100%!important;
                }

                div.body{
                    word-break:break-word;
                }

                table.main{
                    box-sizing:border-box;
                    background-color:#f8fafc;
                    margin:0;
                    padding:0;
                    width:100%;
                }

                .main > tbody > tr > td {
                    text-align: center;
                }
            /*------------------------*/

            /*---------header---------*/
                img.header{
                    height:auto;
                    display:block;
                    margin-left:auto;
                    margin-right:auto;
                    widht:100%;
                }
            /*------------------------*/

            /*---------body-----------*/
                .main-body{
                    box-sizing:border-box;
                    background-color:#ffffff;
                    border-bottom:1px solid #edeff2;
                    border-top:1px solid #edeff2;
                    margin:0;
                    padding:0;
                    width:100%;
                }

                .main-body > table {
                    box-sizing:border-box;
                    background-color:#ffffff;
                    margin:0 auto;
                    padding:0;
                    width:570px;
                }

                .main-body > table > tbody > td {
                    box-sizing:border-box;
                    padding:35px;
                }
            /*------------------------*/

            /* ----- font color ----- */

                .logo-link{
                    font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
                    box-sizing:border-box;
                    color:#bbbfc3;
                    font-size:19px;
                    font-weight:bold;
                    text-decoration:none;
                }

                .grey{
                    color: #888888;
                }

                h1.table-header{
                    box-sizing:border-box;
                    color:#3d4852;
                    font-size:19px;
                    font-weight:bold;
                    margin-top:25px;
                    text-align:center;
                }

                i.do-not-reply{
                    box-sizing:border-box;
                }
            /*------------------------*/

            /* ------ spacing  -------*/
                .mb-1{
                    margin-bottom:5px;
                }

                .mb-2{
                    margin-bottom:15px;
                }

                .mb-3{
                    margin-bottom:30px;
                }

                .pt-1{
                    padding-top:5px;
                }

                .pt-2{
                    padding-top:15px;
                }

                .pt-3{
                    padding-top:30px;
                }

                .pb-1{
                    padding-bottom:5px;
                }

                .pb-2{
                    padding-bottom:15px;
                }

                .pb-3{
                    padding-bottom:30px;
                }
            /*------------------------*/
        </style>
    </head>
    <body>
        <div class="body">
            <table class="main" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tbody>
                    <tr>
                        <td align="center" >
                            <font color="#888888">
                            </font>
                            <font color="#888888">
                            </font>
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tbody>
                                    {{-- header logo and title ---}}
                                    <tr>
                                        <td class="pt-2 pb-2">
                                            <a href="{{ URL::to('/') }}"
                                                target="_blank" class="logo-link"
                                                data-saferedirecturl="{{ URL::to('/') }}">
                                                <img src="{{  $message->embed(public_path() . "/images/misc/unijayalogo.png") }}" alt="Logo Syarikat Unijaya Resources"
                                                width="150" ><br>
                                                {{--- Title here ---}}
                                                Unijaya Resources Sdn. Bhd.
                                            </a>
                                        </td>
                                    </tr>

                                    {{------- main body ------}}

                                    <tr>
                                        <td width="100%" cellpadding="0" cellspacing="0" class="main-body">
                                            <table align="center" width="570" cellpadding="0" cellspacing="0"role="presentation">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h1 class="table-header">
                                                                Attendance Report Team - {{$reportAttendance->month_type->name}} {{$reportAttendance->year}}
                                                            </h1>

                                                            <br>
                                                                Below are the attachment for attendance report for {{$reportAttendance->month_type->name}} {{$reportAttendance->year}}
                                                            <br>
                                                            <br>

                                                            <i class="do-not-reply">
                                                                * This is an auto-generated email, please do not reply to this email.
                                                            </i>

                                                            <br>
                                                            <br>
                                                                Thank you
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                    {{------- footer --------}}

                                    <tr>
                                        <td>
                                            <table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" style="box-sizing:border-box;padding:35px">
                                                            <p style="box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">
                                                                © {{ Carbon\Carbon::parse(Carbon::now())->format('Y') }} Unijaya Resources Sdn.Bhd. All rights reserved.
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>

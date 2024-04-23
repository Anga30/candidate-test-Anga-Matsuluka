<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="/css/bootstrap.css" rel="stylesheet"/>
        <link href="/css/style.css" rel="stylesheet"/>
        <style>
            #sidebar {
                border: none;
                height: 100vh;
                box-shadow: 1px 0px 9px;
                padding: 10px;
                overflow-y: auto;
            }
            #content-view {
                height: 100vh;
                border: none;
            }

            #sidebar, #content-view {
                background: #e3e3e3;
                padding: 15px;
            }

            body {
                margin: 0;
                background: #1d1d1d;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row align-items-end">
                <iframe id="sidebar" class="col-3" src="/sidebar/left" name="sidebar">
                </iframe>
                <iframe id="content-view" class="col-9" src="/sidebar/right" name="sugar">
                </iframe>
            </div>
        </div>
    </body>
</html>
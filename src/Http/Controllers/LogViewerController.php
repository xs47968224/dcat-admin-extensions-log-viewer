<?php

namespace Dcat\Admin\Extension\LogViewer\Http\Controllers;

use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Dcat\Admin\Extension\LogViewer\LogViewer;
class LogViewerController extends Controller
{
    public function index($file = null, Request $request)
    {
        return Admin::content(function (Content $content) use ($file, $request) {

            $offset = $request->get('offset');

            $viewer = new LogViewer($file);
            $content->body(view('log-viewer::index', [
                'logs'      => $viewer->fetch($offset),
                'logFiles'  => $viewer->getLogFiles(),
                'fileName'  => $viewer->file,
                'end'       => $viewer->getFilesize(),
                'tailPath'  => route('log-viewer-tail', ['file' => $viewer->file]),
                'prevUrl'   => $viewer->getPrevPageUrl(),
                'nextUrl'   => $viewer->getNextPageUrl(),
                'filePath'  => $viewer->getFilePath(),
                'size'      => static::bytesToHuman($viewer->getFilesize())
            ]));

            $content->header($viewer->getFilePath());

        });
    }

    public function tail($file, Request $request)
    {
        $offset = $request->get('offset');

        $viewer = new LogViewer($file);

        list($pos, $logs) = $viewer->tail($offset);

        return compact('pos', 'logs');
    }

    protected static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
<?php

namespace App\Http\Controllers;

use App\GDrive\GoogleD;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    private $_drive;

    public function __construct()
    {
           $this->middleware(function ($request, $next) {
                   $this->_client = GoogleD::getInstance()->getClient();
                $this->_client->setAccessToken(session()->get('user.token'));
                $this->_drive = GoogleD::getInstance()->googleDrive();

                return $next($request);
            });
    }

    public function index(Request $request)
    {
        $files = $this->getUserDriveFiles($request);
        return view('dashboard', compact('files'));
    }

    protected function getUserDriveFiles($request)
    {
        $result    = array();
        $pageToken = null;

        $three_months_ago = Carbon::now()->subMonths(3)->toRfc3339String();

        $parameters = [
            'q' => "viewedByMeTime >= '$three_months_ago' or modifiedTime >= '$three_months_ago'",
            'orderBy' => 'modifiedTime',
            'fields' => 'nextPageToken, files(id, name, modifiedTime, iconLink, webViewLink, webContentLink)',
        ];

        do {
            try {
                if ($pageToken) {
                    $parameters['pageToken'] = $pageToken;
                }
                if ($request->has('query')) {
                    $query = $request->get('query');
                    $parameters = [
                        'q' => "name contains '$query'",
                        'fields' => 'files(id, name, modifiedTime, iconLink, webViewLink, webContentLink)',
                    ];
                }
                $files = $this->_drive->files->listFiles($parameters);

                $result    = array_merge($result, $files->files);
                $pageToken = $files->getNextPageToken();
            } catch (Exception $e) {
                print "An error occurred: " . $e->getMessage();
                $pageToken = null;
            }
        } while ($pageToken);
        return $result;

    }



}

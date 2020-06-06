<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class DropboxController extends BaseController
{
    public function uploadToDropbox(){
        return 'happy dropbox';
    }
}

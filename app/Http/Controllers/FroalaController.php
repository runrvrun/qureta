<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;
use Image;

class FroalaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        //
	}
	public function test_upload() {
		return view('test_upload');
    }

    
    public function upload_image(Request $request) {
        // Include the editor SDK.
		//require '../public/froala/lib/FroalaEditor.php';

		// Store the image.
		try {
			//$response = FroalaEditor_Image::upload('/uploads/post/inline/');			
			if ($request->hasFile('file')) {
				$uploadPath = public_path('/uploads/post/inline/');

				$extension = 'jpg';
				$fileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME).rand(11111, 99999) . '.' . $extension;

				$file = $request->file('file');            
				//$file->move($uploadPath, $fileName);
				Image::make($file->getRealPath())->resize(653, null, function ($constraint) {
                $constraint->aspectRatio();
				})->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();
			}
			$completePath = '/uploads/post/inline/'.$fileName;
			 return stripslashes(response()->json(['link' => $completePath])->content());
			//echo stripslashes(json_encode($response));
		}
		catch (Exception $e) {
			http_response_code(404);
		}
    }

}

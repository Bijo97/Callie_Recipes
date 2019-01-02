<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Collection;
use League\Csv\Writer;
use Schema;
use SplTempFileObject;


use App\Http\Requests;
use App\Post;
use App\User;

use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {   
        

        // if ($file = $request->file('image_post')){
        //     $name = $file->getClientOriginalName();
        //     $file->move('img', $name);
        //
        //     echo "good";
        // } else {
        //     echo "bad";
        // }
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function checkImage($image){
        
        if($image){
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(250, 250);
            $img_name = "img/".$filename;
            $image_resize->save($img_name);
           
            // $image_pixelate = Image::make($image->getRealPath()); 
            // $image_pixelate->resize(250, 250);
            // $image_pixelate->pixelate(12);
            // $image_pixelate->save('img/'."pixelate_".$filename);
            return $img_name;   
        }
    }


    public function edit_author($id_user)
    {
        $id = Auth::id();

        if ($id != null){
            $res = User::where('id', $id_user)->first();
            return view('edit-author')->with('res', $res);
        } else {
            return redirect('login');
        }
    }

    public function update_author(Request $request, $id)
    {   
        // $a = $request->file('image_user');
        // $img_name = checkImage($a);

        if($image = $request->file('image_user')){
            
            // $filename = $image->getClientOriginalName();
           $filename = uniqid().'.png';
           $watermark =  Image::make('img/logo.png');
            $image_resize = Image::make($image->getRealPath())->encode('png', 100);  
            // $img = File::get(url('img/logo.png'));
            $image_resize->resize(100, 100);
            
            //#1
            $watermarkSize = $image_resize->width() - 5; //size of the image minus 20 margins
            //#2
            $watermarkSize = $image_resize->width() / 2; //half of the image size
            //#3
            $resizePercentage = 10;//10% less then an actual image (play with this value)
            $watermarkSize = round($image_resize->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image

            // resize watermark width keep height auto
            $watermark->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            //insert resized watermark to image center aligned
            $image_resize->insert($watermark, 'center');
            $width = $image_resize->getWidth();
            $height = $image_resize->getHeight();
            $mask = Image::canvas($width,$height); 
            
            $mask->circle($width, $width/2, $height/2, function ($draw) {
                $draw->background('#fff');
            });

            $name_circle = 'circle_'.$filename;
            //$image_resize->mask($mask, false);
           
            $image_resize->save('img/'.$name_circle);

            $row = User::where('id', $id)->update(['name' => $request->input('name'), 'email' => $request->input('email'),'image_user'=>$name_circle]);
        }
    }

    private function createCsv(Collection $modelCollection, $tableName){

        $csv = Writer::createFromFileObject(new SplTempFileObject());
    
        // This creates header columns in the CSV file - probably not needed in some cases.
        $csv->insertOne(Schema::getColumnListing($tableName));
    
        foreach ($modelCollection as $data){
            $csv->insertOne($data->toArray());
        }
    
        $csv->output($tableName . '.csv');
    
    }

    public function getMainMetaData(){

        $mainMeta = User::all();
    
        // Note: $mainMeta is a Collection object 
        //(returning a 'collection' of data from using 'all()' function), 
        //so can be passed in below.
        $this->createCsv($mainMeta, 'users');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
    }

    public function delete_author($id)
    {
        $row = User::where('id', $id)->delete();
    }

    /**
     * @SWG\Delete(
     *   path="/delete-user/{id}",
     *   description="Delete selected author's data",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Author ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function delete_user_rest($id)
    {
        $row = User::where('id', $id)->delete();

        return response()->json($row, 204);
    }

    /**
     * @SWG\Put(
     *   path="/update-author/{id}",
     *   description="Update selected author's data",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Author ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="Author",
     *     in="body",
     *     description="Author's Data",
     *     required=true,
     *     type="string",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="name", type="string"),
     *         @SWG\Property(property="email", type="string")
     *     )
     *   ),
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function update_author_rest(Request $request,$id){
        $row = User::where('id', $id)->update(['name' => $request->input('name'), 'email' => $request->input('email'),'image_user'=>"da"]);

        return response()->json($row, 200);
    }

    /**
     * @SWG\Get(
     *   path="/edit-author-rest/{id}",
     *   description="Return edit admin page view",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Author ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function edit_author_rest($id_user){
        $res = User::where('id', $id_user)->first();
        return view('rest.edit-author-rest')->with('res', $res);
    }

    /**
     * @SWG\Get(
     *   path="/admin-rest",
     *   description="Return admin page view",
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function show_admin_rest(){
        $res = User::all();
        return response()->json($res, 200);
    }
}

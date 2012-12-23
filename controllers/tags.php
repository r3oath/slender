<?php

class Slender_Tags_Controller extends Base_Controller {
    public $restful = true;

    public function get_index(){
        return Response::eloquent(Slendertag::order_by('name', 'asc')->get());
    }

    public function post_index(){
        
    }

    public function get_show($id){
        $tag = Slendertag::find($id);
        if($tag !== null)
            return Response::eloquent($tag);
        else
            return Response::json(array('error' => 'The tag with an ID of ' . $id . ' could not be found.'));
    }

    public function get_edit(){
        return Redirect::to('slender/dash');
    }

    public function get_new(){
        
    }

    public function put_update($id){
        $tag = Slendertag::find($id);
        $input = Input::json();
        if($tag !== null)
        {
            $tag->contents = $input->contents;
            $tag->enabled = $input->enabled;
            $tag->alt = $input->alt;
            $tag->save();
        }
        else
            return;
    }

    public function delete_destroy($id){
        $tag = Slendertag::find($id);
        if($tag !== null)
            $tag->delete();
        else
            return;
    }
}
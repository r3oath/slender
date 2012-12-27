<?php

/**
* Slender Tags Controller
*
* @uses     Base_Controller
*
* @category Controller
* @package  Slender
* @author   Tristan Strathearn <r3oath@gmail.com>
* @license  MIT.
*/
class Slender_Tags_Controller extends Base_Controller {
    /**
     * $restful
     *
     * @var mixed
     *
     * @access public
     */
    public $restful = true;

    /**
     * Return all stored tags.
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function get_index(){
        return Response::eloquent(Slendertag::order_by('name', 'asc')->get());
    }

    public function post_index(){ /* Not used. */ }

    /**
     * Return a specific tag by ID.
     * 
     * @param mixed $id The ID.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function get_show($id){
        $tag = Slendertag::find($id);
        if($tag !== null)
            return Response::eloquent($tag);
        else
            return Response::json(array('error' => 'The tag with an ID of ' . $id . ' could not be found.'));
    }

    /**
     * Not used, but if navigated to, redirects to the dashboard.
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function get_edit(){
        return Redirect::to('slender/dash');
    }

    public function get_new(){ /* Not used. */ }

    /**
     * Update the specific tag by ID
     * 
     * @param mixed $id The ID.
     *
     * @access public
     *
     * @return mixed Value.
     */
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

    /**
     * Destroy the specific tag by ID.
     * 
     * @param mixed $id The ID.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function delete_destroy($id){
        $tag = Slendertag::find($id);
        if($tag !== null)
            $tag->delete();
        else
            return;
    }
}
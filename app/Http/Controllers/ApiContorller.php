<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commitee;
use App\Member;

class ApiContorller extends Controller
{
    public function get_committee()
    {
        $comm_arr = [];
        $all_children_mem=[];
        $commitee = Commitee::where('status',1)->where('parent_id',0)->with('members','children','children.members')->orderBy('sort_order','ASC')->get();
        foreach ($commitee as $ckey => $cvalue) {
          $comm_arr[] = $cvalue->toArray();
        }
        $sortedArr = collect($comm_arr[0]['members'])->sortBy('sort_order')->all();
        $comm_arr[0]['members']=$sortedArr;

        foreach ($comm_arr[1]['children'] as $key => $value) {
          $memArr = collect($value['members'])->sortBy('sort_order')->all();
          array_push( $all_children_mem,$memArr);
        }

        foreach ($all_children_mem as $memskey => $value) {
          $comm_arr[1]['children'][$memskey]['members']=$value;
        }


        $commitee = json_encode($comm_arr,JSON_FORCE_OBJECT);
        echo $commitee;
    }
}

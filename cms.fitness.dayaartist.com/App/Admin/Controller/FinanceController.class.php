<?php
namespace Admin\Controller;
use Think\Controller;

class FinanceController extends PublicController{
	//***********************************
	// iframe式显示菜单和index页
	//**********************************
	public function index(){
	    $menu="";
	    $index="";
      $menu="<include File='Page/adminusermenu'/>";
      $index="<iframe src='".U('Page/adminindex')."' id='iframe' name='iframe'></iframe>";


       $this->assign('menu',$menu);
       $this->assign('index',$index);
	   $this->display();
	}	
}
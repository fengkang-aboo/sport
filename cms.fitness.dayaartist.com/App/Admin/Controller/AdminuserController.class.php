<?php
namespace Admin\Controller;
use Think\Controller;
class AdminuserController extends PublicController{
	//*************************
	// 管理员的管理
	//*************************
	public function adminuser()
	{
		$id=(int)$_GET['id'];

		$count=M('adminuser')->count();

		$userlist=M('adminuser as a')->field('a.id,a.name,a.addtime,role_name,del')->join('rbac_role as r on a.role_id=r.id')->select();
		//print_r($userlist);die;
		foreach ($userlist as $k => $v) {
			$userlist[$k]['addtime']=date("Y-m-d H:i",$v['addtime']);
		}

		//=============
		//将变量输出
		//=============
		$this->assign('count',$count);
		$this->assign('userlist',$userlist);
		$this->display();	
	}

	//*************************
	// 管理员&商家会员的添加
	//*************************
	public function add()
	{
		//==================
		// GET到的参数集合
		//==================
		$id=(int)$_GET['id'];
		if($_POST['submit']==true){
			if (!$_POST['name']) {
				$this->error('请输入登录账号.'.__LINE__);
				exit();
			}

		    $array = array(
		        'name' => trim($_POST['name']),
				'pwd' => MD5(MD5($_POST['password'])),
				'role_id' => (int)($_POST['role_id']),
				'supplier_id'=>(int)($_POST['supplier_id']),
		    );
			if(intval($_POST['admin_id'])>0){
				//更新
			    //密码为空则去掉unset，防止空置原密码
				if(!$_POST['password']) {unset($array['pwd']);}
				$sql= M('adminuser')->where("id=".intval($_POST['admin_id']))->save($array);
			}else{
				//添加
				/*$check = M('adminuser')->where('name="'.$array['name'].'" AND del=0 AND (qx=5 or qx=4)')->getField('id');*/
				$check = M('adminuser')->where('name="'.$array['name'].'"')->getField('id');
				if ($check) {
					$this->error('账号已存在！');
					exit();
				}
				$array['addtime'] = time();
				$sql= M('adminuser')->add($array);
				$id= $sql;
			}
			
			if($sql){  
				$this->success('保存成功！',U('adminuser/adminuser'));
				exit();
			}else{
				$this->error('保存失败！');
				exit();
			}
		}
		//id>0则为编辑状态
		$adminuserinfo = $id > 0 ? M('adminuser')->where("id=$id")->find():""; 
		$venue = M('ty_venue_branch')->where('pid=0')->select();
		$role = M('rbac_role')->select();
		//=============
		//将变量输出
		//=============
		$this->assign('id',$id);
		$this->assign('role',$role);
		$this->assign('venue',$venue);
		$this->assign('adminuserinfo',$adminuserinfo);
		$this->display();
	}

	public function del()
	{
		$id = intval($_REQUEST['id']);
		$info = M('adminuser')->where('id='.intval($id))->find();
		if (!$info) {
			$this->error('参数错误.'.__LINE__);
			exit();
		}

		if (intval($info['qx'])==4) {
			$this->error('该账号不能删除.'.__LINE__);
			exit();
		}

		if ($info['del']==2) {
			$this->redirect('Adminuser/adminuser',array('page'=>intval($_REQUEST['page'])));
			exit();
		}

		$data=array();
		$data['del'] = 2;
		$up = M('adminuser')->where('id='.intval($id))->save($data);
		if ($up) {
			$this->redirect('Adminuser/adminuser',array('page'=>intval($_REQUEST['page'])));
			exit();
		}else{
			$this->error('操作失败.');
			exit();
		}
	}

	//*************************
	// 角色列表
	//*************************
	public function role()
	{
		$role = M('rbac_role')->select();
		foreach ($role as $key => $value) {
			$role[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
		}
		$this->assign('role',$role);
		$this->display();
	}

	//*************************
	// 添加角色
	//*************************
	public function add_role()
	{	
		if (IS_POST) {
			$data = I('post.');
			$role_data = M('rbac_role')->getField('role_name',true);
			if (in_array($data['role_name'], $role_data)) {
				$this->error('该角色已添加');
			}
			$info = array('role_name'=>$data['role_name'],'status'=>1,'create_time'=>time());
			$res = M('rbac_role')->add($info);
			if ($res) {
				$this->success('添加成功',U('adminuser/role'));
			}else{
				$this->error('添加失败，请重新添加');
			}
		}else{
			$this->display();
		}
	}

	//*************************
	// 分配角色权限
	//*************************
	public function branch_role()
	{
		if (IS_POST) {
			try{
				if ($_POST['submit']==true) {

					$data = I('post.');
					if (!isset($data['auth_id']) || $data['auth_id'] == -1) throw new \Exception('请选择权限');

					//print_r($data);die;
					$role_auth = M('rbac_role_auth');
					//查看一级权限
					$auth_one = $role_auth->where('role_id='.$data['role_id'].' AND auth_id='.$data['auth_pid'])->find();

					if (!$auth_one) {  //是否添加过一级权限
						$auth_array = array('role_id'=>$data['role_id'],'auth_id'=>$data['auth_pid']);
						$auth_one_res = $role_auth->add($auth_array);

						if (!$auth_one_res) {
							throw new \Exception('添加一级权限失败');
						}
					}

					$autn_check = $role_auth->where('role_id='.$data['role_id'].' AND auth_id='.$data['auth_id'])->find();
					if ($auth_check) {
						if (!$auth_one_res) {
							throw new \Exception('该权限已添加');
						}
					}
					$res = $role_auth->add($data);
					
					if ($res) {
						$this->success('保存成功！',U('adminuser/role'));
					}else{

						throw new \Exception('保存失败！');
					}
				}else{

					throw new \Exception('请填写完信息');

				}	
			}catch (\Exception $e) {
                $this->error($e->getMessage());
            }
			
		}else{

			$id = I('get.id');
			$role = M('rbac_role')->where('id='.$id)->find();
			$auth = M('rbac_auth')->where('auth_pid=0')->select();

			$this->assign('role',$role);
			$this->assign('auth',$auth);
			$this->display();

		}
	}

	//*************************
	// 权限列表
	//*************************
	public function auth()
	{
		$auth = M('rbac_auth')->select();
		foreach ($auth as $key => $v) {
			$auth[$key]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			$auth[$key]['auth'] = $v['auth_c'].'/'.$v['auth_a'];
		}
		$this->assign('auth',$auth);
		$this->display();
	}

	//*************************
	// 添加权限
	//*************************
	public function add_auth()
	{
		$rbac_auth = M('rbac_auth');
		if (IS_POST) {
			
			$data = I('post.');
			//print_r($data);die;
			if ($data['auth_pid'] == 0) {

				$where = array('auth_c'=>$data['auth_c'],'auth_pid'=>0);
				$auth_check = $rbac_auth->where($where)->find();

			}else if($data['auth_pid'] > 0){

				$where = array('auth_c'=>$data['auth_c'],'auth_a'=>$data['auth_a']);
				$auth_check = $rbac_auth->where($where)->find();

			}else{
				$this->error('编辑失败');
			}

			if (!empty($auth_check)) $this->error('该权限已存在');

			$add_data = array('auth_name'=>$data['auth_name'],'auth_pid'=>$data['auth_pid'],'auth_c'=>$data['auth_c'],'auth_a'=>$data['auth_a'],'create_time'=>time());


			$res = $rbac_auth->add($add_data);
			if ($res) {
				$this->success('编辑成功',U('adminuser/auth'));
			}else{
				$this->error();
			}
		}else{
			$data = $rbac_auth->where('auth_pid=0')->select();
			foreach ($data as $key => $v) {
				$data[$key]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			}
			$this->assign('data',$data);
			$this->display();
		}
		
	}

	//*************************
	// 二级权限
	//*************************
	public function two_auth()
	{
		$auth_pid = I('get.auth_pid');
		$data = array('data'=>'','message'=>'','status'=>'');
		$auth = M('rbac_auth')->where('auth_pid='.$auth_pid)->select();
		if ($auth) {
			$data = array('data'=>$auth,'message'=>'成功','status'=>1);
		}else{
			$data = array('data'=>'','message'=>'查询失败','status'=>0);
		}
		echo json_encode($data);
	}


}
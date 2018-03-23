<?php

class NewsAction extends CommonAction {

    /**
     * 新闻列表
     * @author zhibin1
     * @version 2016-09-22
     * @return  [type]     [description]
     */
    public function index() {

        $category = D('Category');
        $category_list = $category->getListByOne();
        $this->assign('category', $category_list);

        $where = [];
        $_GET['cid'] && $where['n.cid'] = intval($_GET['cid']);
        $_GET['title'] && $where['n.title'] = htmlspecialchars($_GET['title']);
        $_GET['id'] && $where['n.id'] = intval($_GET['id']);
        $this->assign('search', $_GET);

        $News = D("News");
        $data = $News->listNewsV2($where);

        //dump($data);die;
        $this->assign("page", $data['page']);
        $this->assign("list", $data['list']);
        $this->assign('is_top',NewsModel::$is_top);
        $this->display('index');
    }

    public function category() {
        if (IS_POST) {
            echo json_encode(D("News")->category());
        } else {
            $this->assign("list", D("News")->category());
            $this->display();
        }
    }

    public function add() {
        $News = D('News');
        if (IS_POST) {
            $this->checkToken();
            echo json_encode($News->addNews());
        } else {
            $this->assign("list", $News->category());
            $this->display();
        }
    }

    public function checkNewsTitle() {
        $M = M("News");
        $where = "title='" . $this->_get('title') . "'";
        if (!empty($_GET['id'])) {
            $where.=" And id !=" . (int) $_GET['id'];
        }
        if ($M->where($where)->count() > 0) {
            echo json_encode(array("status" => 0, "info" => "已经存在，请修改标题"));
        } else {
            echo json_encode(array("status" => 1, "info" => "可以使用"));
        }
    }

    public function edit() {

        $News = D("News");
        $id = I('get.id',0,'intval');
        $data = I('post.info');

        if(!$id){
            $this->error("不存在该记录");die;
        }

        if (IS_POST) {
            $this->checkToken();
            echo json_encode($News->edit($id,$data));
            die;
        }

        $info = $News->where(array('id'=>$id))->find();
        $info['content'] = NewsModel::doImage(htmlspecialchars_decode($info['content']));
        $info['content'] = htmlspecialchars($info['content']);
        //var_dump($info['content']);die;

        $this->assign("info", $info);
        $this->assign("list", $News->category());
        $this->display("add");
        
    }

    public function del() {

        $id = I('get.id',0,'intval');
        if(!$id){
            $this->error("删除失败，可能是不存在该ID的记录");die;
        }
        $News = D('News');

        $res = $News->where(array('id'=>$id))->limit(1)->setField('status',NewsModel::STATUS_DEL);
        if ($res) {
            $this->success("成功删除");die;
            //echo json_encode(array("status"=>1,"info"=>""));
        }

        $this->error('删除失败');
    }

    /**
     * 上传图片
     * @author zhibin1
     * @version 2016-09-27
     * @return  [type]     [description]
     */
    public function uploadImg(){
        set_time_limit(300); //设置程序执行时间6分钟
        import('ORG.Net.UploadFile');

        $type = $_FILES['imgFile']['type'];
        if ($type == 'video/mp4') { //视频
            $asset = C('ASSET');
            $save_path = $asset['path'];
            $save_url = $asset['domain'];
        } else { //图片
            $save_path = './Public/Uploads/image/';
            $save_url = C('WEB_ROOT').'Public/Uploads/image/';
        }
        $upload = new UploadFile();// 实例化上传类

        $upload->maxSize  = 100048000 ;// 设置附件上传大小 改为3145728
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','mp4','wmv');// 设置附件上传类型
        $upload->savePath =  $save_path;// 设置附件上传目录

        // $img_url = ;

        $ymd = date("Ymd");
        $upload->savePath .= $ymd . "/";
        // $save_url .= $ymd . "/";
        if (!file_exists($upload->savePath)) {
            mkdir($upload->savePath);
        }

        if(!$upload->upload()) {// 上传错误提示错误信息
            echo json_encode(array('error'=>1,'message'=>$upload->getErrorMsg()));die;
            //$this->error($upload->getErrorMsg());
        }else{// 上传成功 获取上传文件信息

            $info =  $upload->getUploadFileInfo();
            $savePath = $upload->savePath.$info[0]['savename'];
            $save_url = $save_url.$ymd.'/'.$info[0]['savename'];

            //保存表单数据 包括附件数据
            $Im = D('Images'); //

            $data = array(
                'catename' => 'News',
                'savename' => $info[0]['savename'],
                'savepath' => $savePath,
                'add_time' => time(),
                );
            $Im->data($data)->add();
            //echo $Im->_sql();die;

            echo json_encode(array('error'=>0,'url'=>$save_url));
        }

    }
    




}
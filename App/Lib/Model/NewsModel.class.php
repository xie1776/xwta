<?php

class NewsModel extends Model {

    //状态
    const STATUS_NOR = 1;
    const STATUS_DEL = -1;
    const STATUS_DAI = 0;
    static $status = array(
        self::STATUS_NOR => '已审核',
        self::STATUS_DEL => '已删除',
        self::STATUS_DAI => '待审核',
        );

    //置顶
    const IS_TOP = 1;
    const NO_TOP = 0;
    static $is_top = array(
        self::IS_TOP => '置顶',
        self::NO_TOP => '普通',
        );

    public function listNews($firstRow = 0, $listRows = 20) {
        $M = M("News");
        $list = $M->field("`id`,`title`,`status`,`published`,`cid`,`aid`")->order("`published` DESC")->limit("$firstRow , $listRows")->select();
        $statusArr = array("审核状态", "已发布状态");
        $aidArr = M("Admin")->field("`aid`,`email`,`nickname`")->select();
        foreach ($aidArr as $k => $v) {
            $aids[$v['aid']] = $v;
        }
        unset($aidArr);
        $cidArr = M("Category")->field("`cid`,`name`")->select();
        foreach ($cidArr as $k => $v) {
            $cids[$v['cid']] = $v;
        }
        unset($cidArr);
        foreach ($list as $k => $v) {
            $list[$k]['aidName'] =$aids[$v['aid']]['nickname'] == '' ? $aids[$v['aid']]['email'] : $aids[$v['aid']]['nickname'];
            $list[$k]['status'] = $statusArr[$v['status']];
            $list[$k]['cidName'] = $cids[$v['cid']]['name'];
        }
        return $list;
    }
    /**
     * 新闻列表
     * @author zhibin1
     * @version 2016-09-22
     * @return  [type]     [description]
     */
    public function listNewsV2($where=[]){
        $M = M();
        import('ORG.Util.Page');
        $count = $M->table('pa_news n')->where($where)->count();
        $rows = 20;
        $page = new Page($count,$rows);

        
        $data = array();
        $list = $M->table('pa_news n')
                  ->join('pa_admin a on a.aid=n.aid')
                  ->join('pa_category c on c.cid=n.cid')
                  ->where($where)
                  ->field('n.id,n.title,n.status,n.published,a.email,a.nickname,c.name,n.is_top,n.source,n.content')
                  ->limit($page->firstRow.','.$rows)
                  ->order('n.id desc')
                  ->select();
        // echo $M->_sql();die;
        if($list){
            foreach ($list as $key => &$val) {
                $list[$key]['aidName'] = $val['nickname']?$val['nickname']:$val['email'];
                $list[$key]['status'] = self::$status[$val['status']];
                $list[$key]['cidName'] = $val['name'];
                $list[$key]['cidName'] = $val['name'];
                $list[$key]['status_code'] = $val['status'];

                $val['intro'] = mb_substr(0, 20, $val['content'], 'UTF-8');
            }

            $data = array(
                'page' => $page->show(),
                'list' => $list,
                );
        }

        return $data;
    }

    public function category() {
        import("@.ORG.Category");
        if (IS_POST) {
            $act = $_POST[act];
            $data = $_POST['data'];
            $data['name'] = addslashes($data['name']);
            $M = M("Category");
            if ($act == "add") { //添加分类
                unset($data[cid]);
                if ($M->where($data)->count() == 0) {
                    return ($M->add($data)) ? array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功添加到系统中', 'url' => U('News/category', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 添加失败');
                } else {
                    return array('status' => 0, 'info' => '系统中已经存在分类' . $data['name']);
                }
            } else if ($act == "edit") { //修改分类
                if (empty($data['name'])) {
                    unset($data['name']);
                }
                if ($data['pid'] == $data['cid']) {
                    unset($data['pid']);
                }
                return ($M->save($data)) ? array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功更新', 'url' => U('News/category', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 更新失败');
            } else if ($act == "del") { //删除分类
                unset($data['pid'], $data['name']);
                return ($M->where($data)->delete()) ? array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功删除', 'url' => U('News/category', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 删除失败');
            }
        } else {
            
            $cat = new Category('Category', array('cid', 'pid', 'name', 'fullname'));
            return $cat->getList();               //获取分类结构
        }
    }
    /**
     * 新增新闻
     * @Author   zhibin1
     * @DateTime 2017-12-02
     */
    public function addNews() {
        
        $data = $_POST['info'];
        $data['published'] = time();
        $data['aid'] = $_SESSION['my_info']['aid'];
        if (empty($data['summary'])) {
            $data['summary'] = cutStr($data['content'], 200);
        }
        $res = $this->data($data)->add();
        if ($res) {
            return array('status' => 1, 'info' => "已经发布", 'url' => U('News/index'));
        } else {
            return array('status' => 0, 'info' => "发布失败，请刷新页面尝试操作");
        }
    }
    /**
     * 编辑文章
     * @author zhibin1
     * @version 2016-09-22
     */
    public function edit($id,$data=array()) {

        $data['update_time'] = time();
        $res = $this->where(array('id'=>$id))->limit(1)->save($data);
        //echo $this->_sql();die;
        if ($res) {
            return array('status' => 1, 'info' => "已经更新", 'url' => U('News/index'));
        } else {
            return array('status' => 0, 'info' => "更新失败，请刷新页面尝试操作");
        }
    }

    /**
     * 返回第一条已审核的新闻
     * @author zhibin1
     * @version 2016-09-22
     * @return  [type]     [description]
     */
    public function getFirst(){

        $map = array(
            'status' => self::STATUS_NOR,
            );
        $info = $this->field()->where($map)->order('is_top desc,id desc')->find();
        //echo $this->_sql();die;

        return $info;
    }

    /**
     * 获取实况视频
     * @Author   zhibin1
     * @DateTime 2017-12-23
     * @param    [type]     $id [description]
     * @return   [type]         [description]
     */
    public function getWeInfo($id)
    {   
        if(!$id) {
            return [];
        }
        $map = array(
            'status' => self::STATUS_NOR,
            'id' => $id,
            'cid' => 61,
            );

        $info = $this->field()->where($map)->find();
        
        return $info;
    }

    /**
     * 获取实况列表
     * @Author   zhibin1
     * @DateTime 2017-12-23
     * @return   [type]     [description]
     */
    public function getWeList($where=[],$page=1,$limit=12)
    {
        $map = array(
            // 'status' => self::STATUS_NOR,
            // 'id' => $id,
            'cid' => 61,
            );
        $map = array_merge($map,$where);
        import('ORG.Util.Page');
        $count = $this->where($map)->count();
        $page = new Page($count,$limit);

        $list = $this->field()->where($map)->limit($page->firstRow,$limit)->order('id desc')->select();
        // echo $this->_sql();die;
        $page_list = $page->getPageList();
        return ['list'=>$list, 'page'=>$page_list];
    }
    /**
     * 指定一条记录
     * @author zhibin1
     * @version 2016-09-23
     * @return  [type]     [description]
     */
    public function getInfo($id){

        $map = array(
            // 'status' => self::STATUS_NOR,
            'id' => $id,
            );

        $info = $this->field()->where($map)->find();

        if (empty($info)) {
          $info = $this->field()->order('id desc')->find();
        }
        
        return $info;
    }

    /**
     * 处理图片
     * @author zhibin1
     * @version 2016-09-26
     * @return  [type]     [description]
     */
    static function doImage($content=''){
        if($_SERVER['SERVER_NAME']!='laijiemi.cn'){
            $url = 'http://laijiemi.cn';
            return preg_replace('/src="(\/Public\/Uploads\/image\/\w+)/', 'src="'.$url."$1", $content);
        }

        return $content;
    }

    /**
     * 处理内容中的视频标签
     * @author: zhibin1.xie
     * @version 2017-03-15
     * @param   [type]     $content [description]
     * @return  [type]              [description]
     */
    public static function doVideo($content){
        //<embed src="http://xwta.net/Public/Uploads/image/20170314/58c7b232b121c.mp4" type="video/x-ms-asf-plugin" width="550" height="400" autostart="false" loop="true" />
        //<video src="http://xwta.net/Public/Uploads/image/20170314/58c7b232b121c.mp4" width="320" height="240" controls="controls" autoplay="autoplay">
        //Your browser does not support the video tag.
        //</video>

        $arr = array();
        $filter = '/<embed(.*?)\/>/';
        preg_match_all($filter, $content, $arr);
        $c = explode(' ', $arr[1][0]);
        $c = array_filter($c);
        $str = '<video '.$c[1].' '.$c[3].' '.$c[4].' controls="controls" >Your browser does not support the video tag.</video>';
        $news_content = preg_replace($filter, $str, $content);
        return $news_content;die;
    }

    /**
     * 获取文章列表
     * @Author   zhibin1
     * @DateTime 2018-01-07
     * @return   [type]     [description]
     */
    public function getTitleList($where=[],$offset=0,$limit=5)
    {

        $list = $this->field('id,title')->where($where)->order('id desc')->limit($offset,$limit)->select();
        
        return $list;
    }

}

?>

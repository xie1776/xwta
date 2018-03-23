<?php

class ArticleModel extends Model
{
	public function getList(){
        import('ORG.Util.Page');
        $count = $this->where()->count();
        $rows = 20;
        $page = new Page($count,$rows);

        $M = M();
        $data = array();
        $list = $M->table('pa_article n')
                  // ->join('pa_admin a on a.aid=n.aid')
                  // ->join('pa_category c on c.cid=n.cid')
                  ->field('*')
                  ->limit($page->firstRow.','.$rows)
                  ->order('n.add_time desc')
                  ->select();
        // echo $M->_sql();die;
        if($list){
            // foreach ($list as $key => $val) {
            //     $list[$key]['aidName'] = $val['nickname']?$val['nickname']:$val['email'];
            //     $list[$key]['status'] = self::$status[$val['status']];
            //     $list[$key]['cidName'] = $val['name'];
            //     $list[$key]['cidName'] = $val['name'];
            //     $list[$key]['status_code'] = $val['status'];
            // }

            $data = array(
                'page' => $page->show(),
                'list' => $list,
                );
        }

        return $data;
	}
}
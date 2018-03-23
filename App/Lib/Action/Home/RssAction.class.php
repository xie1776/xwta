<?php
    class RssAction extends HomeAction{
            public function index(){
                    $where = array(
                            'status' => ArticleModel::STATUS_SHOW,
                            );
                    $data = M('article')->where($where)->order('id desc')->select();
                    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
                    $xml .= '<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" version="2.0">';
                    $xml .= '<channel>';
                    $xml .= '<title>来揭秘</title>'; //网站标题
                    $xml .= '<link>http://www.laijiemi.cn/</link>'; //网站首页地址
                    $xml .= '<description>揭秘社会现实，力求公平真实</description>'; //描述
                    $xml .= '<pubDate>'.date('D, d M Y H:i:s').' GMT</pubDate>'; // 发布的时间 Thu, 
                    $xml .= '<lastBuildDate>'.date('D, d M Y H:i:s').' GMT</lastBuildDate>'; //最后更新的时间
                    foreach ($data as $key => $val) {
                            # code...
                            $content = trim($val['content']);
                            $content = trim($content,'&nbsp;');
                            $content = strip_tags($content);
                            $content = str_replace('&nbsp;', '', $content);
                            $content = mb_substr($content, 0, 100, 'UTF-8');
                            $timestamp = strtotime($val['add_time']);
                            $xml .= '<item>';
                            $xml .= '<title>'.$val['title'].'</title>'; //标题
                            $xml .= '<link>'.'http://www.laijiemi.cn'.U('Index/art',array('id'=>$val['id'])).'</link>'; //链接地址
                            $xml .= '<description>'.$content.'</description>'; //内容简要描述
                            $xml .= '<pubDate>'.date('D, d M Y H:i:s',$timestamp).' GMT</pubDate>'; //发布时间
                            $xml .= '<guid isPermaLink="false">'.'http://www.laijiemi.cn/'.U('Index/index',array('id'=>$val['id'])).'</guid>';
                            $xml .= '</item>';
                    }
                    $xml .= '</channel>';
                    $xml .= '</rss>';
                    // $file = 'rss.xml';
                    // file_put_contents($file, $xml);
                    // header('location:http://www.laijiemi.cn/'.$file);exit;
                    header('content-type:text/xml;charset=utf-8');
                    echo $xml;
            }
    }
?>
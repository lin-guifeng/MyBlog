<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\Session;
class Common extends Controller
{
    public function _initialize()
    {
        if(session('admin_id')==NULL){
            $this->error('请先登录','admin/login/login');
        }
        if(session('long_time')+36000<time()){
            session('admin_id',NULL);
            session('admin_name',null);
            $this->error('登录超时,请重新登录','admin/login/login');
        }else{
            session('long_time',time());
        }
    }
    public function getHtml(){
        //搜索指定关键词的百度图片并显示
        $keyword = "美女";
        $keyword = urlencode($keyword);
        $url = "https://image.baidu.com/search/index?tn=baiduimage&ipn=r&ct=201326592&cl=2&lm=-1&st=-1&fm=index&fr=&hs=0&xthttps=111111&sf=1&fmq=&pv=&ic=0&nc=1&z=&se=1&showtab=0&fb=0&width=&height=&face=0&istype=2&ie=utf-8&word=%E7%BE%8E%E5%A5%B3&oq=meinv&rsp=0";
        $html = file_get_contents($url);
        preg_match_all("/\"[^\"]*[^0]\.jpg\"/", $html, $text);
        dump($text);
    }
    public function paqu(){
        //搜索指定关键词的百度图片并显示
        $keyword = "风景";
        $keyword = urlencode($keyword);
        $url = "http://image.baidu.com/search/index?tn=baiduimage&word=" . $keyword;
        $html = file_get_contents($url);
        preg_match_all("/\"[^\"]*[^0]\.jpg\"/", $html, $text);
        dump($text);
//        foreach ($text as $key => $value) {
//            foreach ($value as $img) {
//                print "<img src=" . $img . " style='width:30px;'/>";
//            }
//        }


    }


    public function getPicture($keyword,$num){
        $keywords = urlencode($keyword);
        $html = [];
        for ($i=0;$i<$num;$i++){
            $pn = 30+30*$i;
            $gsm = base_convert($pn, 10, 16);
            $url = "https://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=".$keywords."&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=-1&z=&ic=&hd=&latest=&copyright=&word=".$keywords."&s=&se=&tab=&width=&height=&face=0&istype=2&qc=&nc=1&fr=&expermode=&force=&pn=".$pn."&rn=30&gsm=".$gsm;
            $con = file_get_contents($url);
            $con = json_decode($con,true);
            $html = array_merge((array)$html,(array)$con['data']);
            if ($con['bdIsClustered']=='2'){
                break;
            }
        }
        foreach($html as $key=>$value){
            foreach ($value as $keys=>$val){
                if($keys=='middleURL'){
                    $res[$key]['url'] = $value[$keys];
                }
                if($keys=='fromPageTitleEnc'){
                    $res[$key]['title'] = $value[$keys];
                }
                $res[$key]['keyword'] = $keyword;
            }
        }
        return $res;
    }

    public function getTuwan(){
//        $url = "https://api.tuwan.com/apps/Welfare/getMenuList?from=wap&format=jsonp&page=".$i."&callback=jQuery1123009817294954161926_1553681240965&_=1553681240966";
//        $con = file_get_contents($url);
//        $con = substr($con,strpos($con,'(')+1);
//        $con = substr($con, 0, -1);
//        $html = json_decode($con,true);
        $res = [];
        $html = [];
//        foreach($html['data'] as $key=>$value){
        for($i=1;$i<=3000;$i++){
            $key = urlencode($i);
//            $urls = "https://api.tuwan.com/apps/Welfare/detail?type=image&dpr=3&id=".$value['id']."&callback=jQuery112301655331505750104_1553649347144&_=1553649347147";
            $urls = "https://api.tuwan.com/apps/Welfare/detail?type=image&dpr=3&id=".$key."&callback=jQuery112301655331505750104_1553649347144&_=1553649347147";
            $urls = preg_replace("/ /", "%20", $urls);
//            $cons = file_get_contents($urls);
            $html[$i] = get($urls);


//            $cons = substr($cons,strpos($cons,'(')+1);
//            $cons = substr($cons, 0, -1);
//            $cons = json_decode($cons,true);
//            if($cons['error']=='0'){
//                if (isset($cons['pic'])){$res['pic'] = $cons['pic'];}
//                $res['thumb'] = json_encode($cons['thumb']);
//                $res['id'] = $cons['id'];
//                $html = array_merge((array)$html,(array)$res);

//                $html['data'] = json_encode($cons['data']);

//            }
//            $res[$key]['pic'] = $value['pic'];
//            $res[$key]['tags'] = json_encode($cons['tags']);
//            $res[$key]['thumb'] = json_encode($cons['thumb']);
//            $res[$key]['title'] = $cons['title'];
//            $res[$key]['bgm'] = $cons['bgm'];
//            $res[$key]['bgm_name'] = $cons['bgm_name'];
//            $res[$key]['bgm_img'] = $cons['bgm_img'];
//            $res[$key]['pid'] = $cons['id'];
//            $res[$key]['data'] = json_encode($cons['data']);
        }
        return $html;
    }
    public function getTuwans($num){
        $start = ($num-1)*100+1;
        $end = $num*100;
        $html=[];
        for($i=$start;$i<=$end;$i++){
            $urls = "https://api.tuwan.com/apps/Welfare/detail?type=image&dpr=3&id=".$i;
            $html = array_merge((array)$html,(array)get($urls));
        }
        foreach($html as $key=>$value){
            $res[$key]['text'] = $value;
        }
        return $res;
    }



    public function demo1(){
//        $arr = [
//            '腿控','女仆','标准福利','兔女郎','旗袍','动漫类','JK制服','运动体操服','黑丝','御姐','网袜','肉丝','其他服装','萝莉','白丝','比基尼','巨乳','死库水','大福利','保守','游戏类','脚控','吊带袜','轻剧情','洛丽塔','丰满微胖'
//        ];
//        13位时间戳
//        list($t1, $t2) = explode(' ', microtime());
//        $time = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
//        echo "时间戳：".$time;
//        dump($arr);
//        foreach ($arr as $val){
//            $res = db('tuwan_tags')->insert(['name'=>$val]);
//        }
        if ($this->request->isPost()){
            $page = $this->request->post('page');
            $num = 100;
            $start = ($page-1)*$num;
            $data=db('tuwan_url')->limit($start,$num)->select();
            foreach ($data as $key => $val){
                $val['text'] = substr($val['text'],strpos($val['text'],'(')+1);
                $val['text'] = substr($val['text'], 0, -1);
                $val['text'] = json_decode($val['text'],true);
                if($val['text']!=null){
                    if($val['text']['error']!='1'&&$val['text']['thumb']!=null){
//                        $res[$key] = $val['text'];
//                        $res[$key]['pic'] = json_encode($val['text']['pic']);
                        $res[$key]['tags'] = json_encode($val['text']['tags']);
                        $res[$key]['thumb'] = json_encode($val['text']['thumb']);
                        $res[$key]['title'] = $val['text']['title'];
                        $res[$key]['bgm'] = $val['text']['bgm'];
                        $res[$key]['bgm_name'] = $val['text']['bgm_name'];
                        $res[$key]['bgm_img'] = $val['text']['bgm_img'];
                        $res[$key]['pid'] = $val['text']['id'];
                        $res[$key]['data'] = json_encode($val['text']['data']);
                    }
                }
            }
            $tuwan=db('tuwan')->insertAll($res);
//            return $res;
            if($tuwan){
                return ['data'=>$tuwan,'code'=>1,'message'=>'操作完成'];
            }else{
                return ['data'=>$tuwan,'code'=>0,'message'=>'操作失败'];
            }
        }

        return view('test');

    }
}
?>
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

    public function getTuwan($i,$callnum){

        $url = "https://api.tuwan.com/apps/Welfare/getMenuList?from=pc&format=jsonp&page=".$i."&callback=jQuery1123009817294954161926_1553681240965&_=".$callnum;
        $con = file_get_contents($url);
        $con = substr($con,strpos($con,'(')+1);
        $con = substr($con, 0, -1);
        $html = json_decode($con,true);
        $res = $html['data'];
        foreach($html['data'] as $key=>$value){
            $urls = "https://api.tuwan.com/apps/Welfare/detail?type=image&dpr=3&id=".$value['id']."&callback=jQuery112301655331505750104_1553649347144&_=1553649347147";
            $cons = file_get_contents($urls);
            $cons = substr($cons,strpos($cons,'(')+1);
            $cons = substr($cons, 0, -1);
//            $cons = substr($cons, strlen('(')+strpos($cons, '('),(strlen($cons) - strpos($cons, ')'))*(-1));
            $cons = json_decode($cons,true);
            $res[$key]['abc'] = $cons;
//            $res[$key]['tags'] = json_encode($cons['tags']);
//            $res[$key]['thumb'] = json_encode($cons['thumb']);
//            $res[$key]['title'] = $cons['title'];
//            $res[$key]['bgm'] = $cons['bgm'];
//            $res[$key]['bgm_name'] = $cons['bgm_name'];
//            $res[$key]['bgm_img'] = $cons['bgm_img'];
//            $res[$key]['pid'] = $cons['id'];
        }
        return $res;
    }

}
?>
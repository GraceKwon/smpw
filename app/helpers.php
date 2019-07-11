<?php
function set_breadcrumb_array($path_explode) {
	$path = $path_explode[0];                    //서브 path 제거
	$path_count = count($path_explode);             // path 레벨 확인
	$subpage_index = 0;
	if($path_count > 1){                           //서브페이지가 있으면
		$subpage_index = $path_explode[1];
			
		if((int)$subpage_index){   // "0"아닌 숫자면 모두 1로 치환
			$subpage_index = 1;
		}
	}
	$breadcrumb = session('breadcrumb')[$path];     // rending breadcrumb array
	$breadcrumb = array_splice($breadcrumb, 0, $path_count + 1); // $breadcrumb = ['메뉴', '서브메뉴', '서브페이지']
	
	if( isset($breadcrumb[2]) ){
		if( isset($breadcrumb[2]['name'][$subpage_index])){
			$breadcrumb[2]['name'] = $breadcrumb[2]['name'][$subpage_index];
		}
	}
	return $breadcrumb;
}
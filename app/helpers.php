<?php
function setBreadcrumbArray($path_explode) {
	$path = $path_explode[0];                    	//서브 path 제거
	$path_count = count($path_explode);             // path 레벨 확인
	
	$subpage_index = 0;
	if($path_count > 1){                           //서브페이지가 있으면
		$subpage_index = $path_explode[1];
			
		if((int)$subpage_index){   // "0"아닌 숫자면 모두 1로 치환
			$subpage_index = 1;
		}
	}

	// $breadcrumb = [ ['path'=>null,'name'=>'메뉴'], ['path'=>'path','name'=>'서브메뉴'], ['path'=>null,'name'=>['서브페이지']]]
	$breadcrumb = session('breadcrumb')[$path];    
	$breadcrumb = array_splice($breadcrumb, 0, $path_count + 1); 
	
	if( isset($breadcrumb[2]) ){
		if( isset($breadcrumb[2]['name'][$subpage_index])){
			$breadcrumb[2]['name'] = $breadcrumb[2]['name'][$subpage_index];
		}
	}
	return $breadcrumb;
}

function getTopPath() {
	return explode('/', request()->path())[0];
	
}

function getAffectedRows($res) {

	return reset($res)->computed;
	
}
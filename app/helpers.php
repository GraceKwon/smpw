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

		if( gettype( $breadcrumb[2]['name'] ) === 'array'){
			$breadcrumb[2]['name'] = $breadcrumb[2]['name'][$subpage_index];
		}
	}
	return $breadcrumb;
}

function getTopPath() {
	return explode('/', request()->path())[0];

}

function getAffectedRows($res) {
	foreach( reset($res) as $value){
		return (int)$value;
	}

}

function getTotalCnt($res) {
	// dd($res);
	if(empty($res) )return 0;
	return reset($res)->TotalCnt;

}

function setPaginator($paginate, $page, $data, $count = null) {

	if(isset($count)){
		$count = getTotalCnt($count);
	}else{
		$count = count($data);
	}

	// $offSet = ($page * $paginate) - $paginate;
	$offSet = 0;
	$itemsForCurrentPage = array_slice($data, $offSet, $paginate, true);
	$Collection = new Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $count, $paginate, $page);
	$Collection->setPath(request()->path());

	return $Collection;

}

function getMetroName($MetroID = null)
{
	return  DB::table('Metros')->where( 'MetroID', $MetroID ?? session('auth.MetroID') ?? request()->MetroID )->value('MetroName');
}

function getCircuitName($CircuitID = null)
{
	return  DB::table('Circuits')->where( 'CircuitID', $CircuitID ?? session('auth.CircuitID') ?? request()->CircuitID )->value('CircuitName');
}

function getServiceZoneName($ServiceZoneID = null)
{
	return  DB::table('ServiceZones')->where( 'ServiceZoneID', $ServiceZoneID ?? request()->ServiceZoneID )->value('ZoneName');
}

function getServiceTime($ServiceTimeID = null)
{
	return  DB::table('ServiceTimes')->where( 'ServiceTimeID', $ServiceTimeID ?? request()->ServiceTimeID )->value('ServiceTime');
}

function getProductName($ProductID = null)
{
	return  DB::table('Products')->where( 'ProductID', $ProductID ?? request()->ProductID )->value('ProductName');
}

function getProductAlias($ProductID = null)
{
	return  DB::table('Products')->where( 'ProductID', $ProductID ?? request()->ProductID )->value('ProductAlias');
}

function getCongregationName($CongregationID = null)
{
	return  DB::table('Congregations')->where( 'CongregationID', $CongregationID ?? session('auth.CongregationID') )->value('CongregationName');
}

function getMobile()
{
	return  DB::table('Admins')->where( 'AdminID', session('auth.AdminID') )->value('Mobile');
}

function sprintfServiceTime($ServiceTime)
{
	// ex) $ServiceTime = 9
	//     return '09:00~10:00'
	return  sprintf ('%02d', $ServiceTime ) . ':00~' . sprintf("%02d", ($ServiceTime+1) ) . ':00' ;
}

function getItemID($Item, $Separate) {

	return DB::table('ItemCodes')->where([['Item', $Item],['Separate', $Separate]])->value('ID');

 }

 function getItem($ID, $Separate) {

	return DB::table('ItemCodes')->where([['ID', $ID],['Separate', $Separate]])->value('Item');

 }

 function getItemByLocale($ID, $Separate, $Locale)
 {
    if($Locale === 'ko'){
        if($Separate === 'CancelTypeID') {
            return DB::table('ItemCodes')->where([['ID', $ID],['Separate', $Separate]])->value('ItemKOR');
        } else {
            return DB::table('ItemCodes')->where([['ID', $ID],['Separate', $Separate]])->value('Item');
        }
    } else {
        return DB::table('ItemCodes')->where([['ID', $ID],['Separate', $Separate]])->value('ItemEng');
    }
 }

 function getWeekName($w) {

	$weeks = ['일', '월', '화', '수', '목', '금', '토'];
	return $weeks[$w];

 }

 function explodeRequestCreateDate() {

	if(request()->CreateDate){
		request()->CreateDate = explode('~', preg_replace('/\s+/', '', request()->CreateDate));
		request()->StartDate = request()->CreateDate[0];
		request()->EndDate = request()->CreateDate[1];
	}

}

function listNumbering($index, $paginate) {

	return ($index + 1) + ( (request()->input('page', 1)-1) * $paginate ) ;

 }

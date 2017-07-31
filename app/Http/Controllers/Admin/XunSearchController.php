<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XunSearchController extends Controller
{
	protected $xsObj;
	protected $search;

	//索引对象
	protected $index;

	//分词对象
	protected $tokenizer;
	
	public function __construct($projectName='mogo', $prefix = "/usr/local/xunsearch", $charSet='UTF-8')
	{

		// require_once("$prefix/sdk/php/lib/XS.php");

		$this->xsObj = new \XS(config_path(''.$projectName.'.ini'));

		if (empty($this->xsObj)){

			//如果上面的方法失效，那就使用绝对路径的方法试一试了。
			// $this->xsObj = new \XS("$prefix/sdk/php/app/".$projectName.".ini");
			$this->xsObj = new \XS(config_path(''.$projectName.'.ini'));
		}
		
		//设置编码集，防止乱码
		$this->xsObj->defaultCharset = $charSet;

		$this->index = $this->xsObj->index;

		//获得搜索对象
		$this->search = $this->xsObj->getSearch();

		//获得分词对象
		$this->tokenizer = new \XSTokenizerScws();

	}

	/**
	 * @description  负责搜索
	 * @author LiangZhi gzphper@163.com
	 * @query   string  需要搜索的内容
	 * @limit_num int   每页显示条数
	 * @q         string  表单中的搜索域中name值
	 * @fuzzy    boolean   true 开启模糊搜索
	 * @synon    boolean   true 开启同义词查询
	 */
	public function doSearch($query='mogo', $limit_num=2, $q='keyword', $fuzzy=true, $synon=true)
	{


			//设置是否开启模糊查询
			$this->xsObj->search->setFuzzy($fuzzy);

			//设置是否开启同义词查询
			$this->xsObj->search->setAutoSynonyms($synon);

			$this->xsObj->search->setLimit(20);

			$this->xsObj->search->setQuery($query);

			//得到搜索结果(包含权重等信息)
			$docs = $this->xsObj->search->search();
			//获得本次查询的结果总数（这是个估值）
			$total = $this->xsObj->search->getLastCount();

			$url = '/'.MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
			$bu = $_SERVER['SCRIPT_NAME'] .$url.'/'.$q.'/'.$query;

			// 当总条数大于每页显示数，才得到分页
			if ($total > $limit_num) {
				$pb = max($p - 5, 1);
				$pe = min($pb + 10, ceil($total / $limit_num) + 1);
				$pager = '<div class="searchPage"><span>总条数为：'.$total.'</span>';
				
				do {

					$pager .= ($pb == $p) ? '<a style="background:#abc;">' . $p . '</a>' : '<a href=' . $bu . '/p/' . $pb . '>' . $pb . '</a>';

				} while (++$pb < $pe);

				$pager .= '</div>';
			}
			if(count($docs) == 0){

				// 没有找到搜索结果
				return array();

			}else{
					//将结果一一取出
					foreach($docs as $k => $doc){
							if(!empty($doc)){

									//取出搜索结果
									$searchRes[] = $doc->getFields();

									//获取每个词的权重
									$searchRes[$k]['weight'] = $doc->weight();

							}
					}

			}
		
			$searchResult = 	 array(
						'pageBtn'=> @$pager,
						'result' => $searchRes
			);

			return $searchResult;
			
	}
		
	//将新增的数据插入到xunsearch中
	public function addDocumentData( $data = array() )
	{
			if ( empty($data) ) {
				throw new \Exception('请输入插入数据');
			}

			$doc = new \XSDocument;

			$doc->setFields($data);

			//添加索引到xunsearch中
			return $this->index->add($doc);
	}	
			/**
	 * @description 删除xunsearch中的数据
	 * @delData   array/string xunsearch中主键 or 特定字段的索引词
	 * @field    string    字段名，当$field有值就根据特定字段的索引词删除
	 * @example
	 *    deleteDocumentData((array('123', '789', '456')); // 同时删除主键值为 123, 789, 456 的记录
	 *    deleteDocumentData((array('abc', 'def'), 'subject');//删除字段 subject 上带有索引词 abc 或 def 的所有记录
	 */
	public function deleteDocumentData($delData, $field)
	{

			// echo 'aaa';
			// dump($delData);exit;
			if ( empty($delData) ) {
				throw new Exception("请输入删除的数据");

			}

			if ( empty($field) ) {

				return $this->index->del($delData);

			} else {

				$this->index->del($delData, $field);

			}
	}
	
	//清空索引
	public function clean()
	{
		$this->index->clean();
	}
	//开启缓存区
	public function openBuffer($size=4)
	{
		//开启缓冲区，默认 4MB，如 $index->openBuffer(8) 则表示 8MB
		$this->index->openBuffer($size);
	}

	//关闭缓存去
	public function closeBuffer()
	{
		$this->index->closeBuffer(); // 关闭缓冲区，必须和 openBuffer 成对使用
	}

	/**
	 * @description 获取热门搜索词
	 * @total int   设置要返回的词数量上限，默认为 6，最大值为 50
	 * $week  string  指定排序类型，默认为 total(总量)，可选值还有：lastnum(上周) 和 currnum(本周)
	 */
	public function getHotQuery($total=6, $week='total')
	{
		return $this->search->getHotQuery($total, $week);
	}

	/**
	 * @description 获取相关搜索词
	 * @keyword string 返回跟这个搜索语句相关的搜索词，默认为 NULL 使用最近那次 setQuery 的语句
	 * @num  int       置要返回的词数量上限，默认为 6，最大值为 20
	 */
	public function getRelatedQuery($keyword, $num=6)
	{
		return $words = $this->search->getRelatedQuery($keyword, $num);;
	}

	//拼写纠错
	public function getCorrectedQuery($keyword)
	{
		return $this->search->getCorrectedQuery($keyword);
	}

	//搜索建议是指类似百度那样，当用户在搜索框输入少量的字、拼音、声母时提示用户一些相关的 热门关键词列表下拉框供用户选择
	public function getExpandedQuery($keyword)
	{
		return $this->search->getExpandedQuery($keyword);
	}
}

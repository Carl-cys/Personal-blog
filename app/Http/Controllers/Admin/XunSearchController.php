<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XunSearchController extends Controller
{
	protected $xsObj;
	protected $search;

	//��������
	protected $index;

	//�ִʶ���
	protected $tokenizer;
	
	public function __construct($projectName='mogo', $prefix = "/usr/local/xunsearch", $charSet='UTF-8')
	{

		// require_once("$prefix/sdk/php/lib/XS.php");

		$this->xsObj = new \XS(config_path(''.$projectName.'.ini'));

		if (empty($this->xsObj)){

			//�������ķ���ʧЧ���Ǿ�ʹ�þ���·���ķ�����һ���ˡ�
			// $this->xsObj = new \XS("$prefix/sdk/php/app/".$projectName.".ini");
			$this->xsObj = new \XS(config_path(''.$projectName.'.ini'));
		}
		
		//���ñ��뼯����ֹ����
		$this->xsObj->defaultCharset = $charSet;

		$this->index = $this->xsObj->index;

		//�����������
		$this->search = $this->xsObj->getSearch();

		//��÷ִʶ���
		$this->tokenizer = new \XSTokenizerScws();

	}

	/**
	 * @description  ��������
	 * @author LiangZhi gzphper@163.com
	 * @query   string  ��Ҫ����������
	 * @limit_num int   ÿҳ��ʾ����
	 * @q         string  ���е���������nameֵ
	 * @fuzzy    boolean   true ����ģ������
	 * @synon    boolean   true ����ͬ��ʲ�ѯ
	 */
	public function doSearch($query='mogo', $limit_num=2, $q='keyword', $fuzzy=true, $synon=true)
	{


			//�����Ƿ���ģ����ѯ
			$this->xsObj->search->setFuzzy($fuzzy);

			//�����Ƿ���ͬ��ʲ�ѯ
			$this->xsObj->search->setAutoSynonyms($synon);

			$this->xsObj->search->setLimit(20);

			$this->xsObj->search->setQuery($query);

			//�õ��������(����Ȩ�ص���Ϣ)
			$docs = $this->xsObj->search->search();
			//��ñ��β�ѯ�Ľ�����������Ǹ���ֵ��
			$total = $this->xsObj->search->getLastCount();

			$url = '/'.MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
			$bu = $_SERVER['SCRIPT_NAME'] .$url.'/'.$q.'/'.$query;

			// ������������ÿҳ��ʾ�����ŵõ���ҳ
			if ($total > $limit_num) {
				$pb = max($p - 5, 1);
				$pe = min($pb + 10, ceil($total / $limit_num) + 1);
				$pager = '<div class="searchPage"><span>������Ϊ��'.$total.'</span>';
				
				do {

					$pager .= ($pb == $p) ? '<a style="background:#abc;">' . $p . '</a>' : '<a href=' . $bu . '/p/' . $pb . '>' . $pb . '</a>';

				} while (++$pb < $pe);

				$pager .= '</div>';
			}
			if(count($docs) == 0){

				// û���ҵ��������
				return array();

			}else{
					//�����һһȡ��
					foreach($docs as $k => $doc){
							if(!empty($doc)){

									//ȡ���������
									$searchRes[] = $doc->getFields();

									//��ȡÿ���ʵ�Ȩ��
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
		
	//�����������ݲ��뵽xunsearch��
	public function addDocumentData( $data = array() )
	{
			if ( empty($data) ) {
				throw new \Exception('�������������');
			}

			$doc = new \XSDocument;

			$doc->setFields($data);

			//���������xunsearch��
			return $this->index->add($doc);
	}	
			/**
	 * @description ɾ��xunsearch�е�����
	 * @delData   array/string xunsearch������ or �ض��ֶε�������
	 * @field    string    �ֶ�������$field��ֵ�͸����ض��ֶε�������ɾ��
	 * @example
	 *    deleteDocumentData((array('123', '789', '456')); // ͬʱɾ������ֵΪ 123, 789, 456 �ļ�¼
	 *    deleteDocumentData((array('abc', 'def'), 'subject');//ɾ���ֶ� subject �ϴ��������� abc �� def �����м�¼
	 */
	public function deleteDocumentData($delData, $field)
	{

			// echo 'aaa';
			// dump($delData);exit;
			if ( empty($delData) ) {
				throw new Exception("������ɾ��������");

			}

			if ( empty($field) ) {

				return $this->index->del($delData);

			} else {

				$this->index->del($delData, $field);

			}
	}
	
	//�������
	public function clean()
	{
		$this->index->clean();
	}
	//����������
	public function openBuffer($size=4)
	{
		//������������Ĭ�� 4MB���� $index->openBuffer(8) ���ʾ 8MB
		$this->index->openBuffer($size);
	}

	//�رջ���ȥ
	public function closeBuffer()
	{
		$this->index->closeBuffer(); // �رջ������������ openBuffer �ɶ�ʹ��
	}

	/**
	 * @description ��ȡ����������
	 * @total int   ����Ҫ���صĴ��������ޣ�Ĭ��Ϊ 6�����ֵΪ 50
	 * $week  string  ָ���������ͣ�Ĭ��Ϊ total(����)����ѡֵ���У�lastnum(����) �� currnum(����)
	 */
	public function getHotQuery($total=6, $week='total')
	{
		return $this->search->getHotQuery($total, $week);
	}

	/**
	 * @description ��ȡ���������
	 * @keyword string ���ظ�������������ص������ʣ�Ĭ��Ϊ NULL ʹ������Ǵ� setQuery �����
	 * @num  int       ��Ҫ���صĴ��������ޣ�Ĭ��Ϊ 6�����ֵΪ 20
	 */
	public function getRelatedQuery($keyword, $num=6)
	{
		return $words = $this->search->getRelatedQuery($keyword, $num);;
	}

	//ƴд����
	public function getCorrectedQuery($keyword)
	{
		return $this->search->getCorrectedQuery($keyword);
	}

	//����������ָ���ưٶ����������û��������������������֡�ƴ������ĸʱ��ʾ�û�һЩ��ص� ���Źؼ����б��������û�ѡ��
	public function getExpandedQuery($keyword)
	{
		return $this->search->getExpandedQuery($keyword);
	}
}

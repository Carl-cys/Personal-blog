		$(function () {
			
				layui.use('flow', function(){
					var $ = layui.jquery; //���ö������jQuery��flowģ�鱾����������jQuery�ģ�ֱ���ü��ɡ�
					var flow = layui.flow;
					flow.lazyimg();
					flow.load({
						elem: '#flow'
						//ָ���б�����
						,isLazyimg: true
						,isAuto: true,
						end: 'û�и�����',
						mb: 200
						,done: function(page, next){ //�����ٽ�㣨Ĭ�Ϲ�����������������һҳ
							var lis = [];
							var pages;
							var str = '';
							if (page == 1) { //���ݴӵ�2ҳ��ʼ
								next(lis.join(''), page < 999999);
								return;
							}
							//��jQuery��Ajax����Ϊ����������һҳ���ݣ�ע�⣺page�Ǵ�2��ʼ���أ�
							$.ajax({
								type: 'post',
								url : '/home/flow?page='+page,
								data:{ 'currentIndex': page ,'_token':'{{csrf_token()}}'}
								,datatype: 'json'
								,success: function (res){
								
									if( res.flow ){								
										lis.push(res.flow);
										pages = res.data.last_page;
										next(lis.join(''), page < pages);
									} else {
										
										next("û�и�����", 0);
										
									}
								}
							});
						}

					});
				});
		 });
		$(function () {
			
				layui.use('flow', function(){
					var $ = layui.jquery; //不用额外加载jQuery，flow模块本身是有依赖jQuery的，直接用即可。
					var flow = layui.flow;
					flow.lazyimg();
					flow.load({
						elem: '#flow'
						//指定列表容器
						,isLazyimg: true
						,isAuto: true,
						end: '没有更多了',
						mb: 200
						,done: function(page, next){ //到达临界点（默认滚动触发），触发下一页
							var lis = [];
							var pages;
							var str = '';
							if (page == 1) { //数据从第2页开始
								next(lis.join(''), page < 999999);
								return;
							}
							//以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
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
										
										next("没有更多了", 0);
										
									}
								}
							});
						}

					});
				});
		 });
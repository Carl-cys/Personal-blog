
<!--右边悬浮 平板或手机设备显示-->
<div class="category-toggle"><i class="fa fa-chevron-left"></i></div><!--这个div位置不能改，否则需要添加一个div来代替它或者修改样式表-->
<div class="article-category shadow">
    <div class="article-category-title">分类导航</div>
    <!-- 点击分类后的页面和artile.html页面一样，只是数据是某一类别的 -->
    @forelse($cates as $cate)
        <a href="/home/article/category/{{$cate->id}}">{{$cate->cate_name}}</a>
        @empty
    @endforelse
    <div class="clear"></div>
</div>
<div class="blog-module shadow">
    <div class="blog-module-title">推荐文章</div>
    <ul class="fa-ul blog-module-ul">
        @forelse($recommend as $rec)
            <li><i class="fa-li fa fa-hand-o-right"></i> <a href="{{url('/home/detail/'.$rec->id)}}">{{$rec->title}}</a></li>
            @empty
        @endforelse
    </ul>
</div>
<div class="blog-module shadow">
    <div class="blog-module-title">随便看看</div>
    <ul class="fa-ul blog-module-ul">
        @forelse($casual as $cas)
            <li><i class="fa-li fa fa-hand-o-right"></i><a href="{{url('/home/detail/'.$cas->id)}}">{{$cas->title}}</a></li>
        @empty
        @endforelse
    </ul>
</div>

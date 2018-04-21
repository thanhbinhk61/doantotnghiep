<div class="support-icon-right">
<h3><i class="fa fa-hand-o-right"></i><span>inbox Facebook</span></h3>
<div class="online-support">
<div
class="fb-page"
data-href="https://www.facebook.com/umzilagroup/"
data-small-header="true"
data-height="300"
data-width="250"
data-tabs="messages"
data-adapt-container-width="false"
data-hide-cover="false"
data-show-facepile="false"
data-show-posts="false">
</div>
</div>
</div>

<!-- Footer -->
<footer id="footer">
     <div class="container">
            <!-- introduce-box -->
            <div id="introduce-box" class="row hidden-xs">
                <div class="col-lg-3 col-md-6 col-sm-6 border-right-height">
                    <div id="address-box">
                        <a href="/"><img src="{{asset($configs->logo)}}" alt="Logo"></a>
                        <div id="address-list">
                            <div class="tit-name">Địa chỉ:</div>
                            <div class="tit-contain">{{$configs->address}}</div>
                            <div class="tit-name">Điện thoại:</div>
                            <div class="tit-contain">{{$configs->phone}}</div>
                            <div class="tit-name">Email:</div>
                            <div class="tit-contain">{{$configs->email}}</div>
                            <div class="tit-name">Mở cửa:</div>
                            <div class="tit-contain">{{$configs->timework}}</div>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-6 border-right-height hidden-sm hidden-md">
                    <div class="row">
                        @foreach($menuFooter->take(3) as $mfooter)
                        <div class="col-sm-4 border-right-height">
                            <div class="introduce-title">{{$mfooter->name}}</div>
                            @if (count($mfooter->children))
                             <ul id="introduce-company" class="introduce-list">
                                @foreach($mfooter->children->take(7) as $mfooter2)
                                <?php
                                    switch ($mfooter2->type) {
                                    case 'pages':
                                        $url2 = route('page.show',isset($mfooter2->page->slug)? $mfooter2->page->slug : '');
                                        break;
                                    case 'category-product':
                                        $url2 = route('product.category',isset($mfooter2->category->slug)? $mfooter2->category->slug : '');
                                        break;
                                    case 'category-post':
                                        $url2 = route('post.category',isset($mfooter2->category->slug)? $mfooter2->category->slug : '');
                                        break;
                                    case 'link':
                                        $url2 = $mfooter2->link;
                                        break;
                                  }
                                ?>
                                 <li><a href="{{$url2}}">{{$mfooter2->name}}</a></li>
                                 @endforeach
                             </ul>
                             @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div id="contact-box">
                        <div class="introduce-title">Được chứng nhận</div>
                        <div class="social-link">
                            <a target="_blank" href="http://www.online.gov.vn/WebsiteDisplay.aspx?DocId=22365"><img src="/assets/frontend/images/bo-cong-thuong.da-dang-ky.png"></a>
                        </div>
                        <div class="introduce-title">Giới thiệu</div>
                        {!!$configs->intro!!}
                    </div>
                </div>
                <div class="col-lg-9 hidden-sm hidden-md">
                    <ul id="trademark-list">
                        <li id="payment-methods"> Đăng ký nhận bản tin</li>
                        <li>
                            <div class="form-newsletter">
                                {!! Form::open(['url' => route('contact.store'),'autocomplete'=>'off']) !!}
                                <input placeholder="Điền email đăng ký" name="email" class="form-newsletter-input" type="email">
                                <button type="submit" class="form-newsletter-button">Đăng ký</button>
                                {!! Form::close() !!}
                            </div>
                        </li>
                    </ul> 
                </div>

            </div><!-- /#introduce-box -->
        
            <!-- #trademark-text-box -->
            <div id="trademark-text-box" class="row hidden-sm hidden-xs hidden-md">
            @foreach($categoryRoots as $category)
                <div class="col-sm-12">
                    <ul id="trademark-search-list" class="trademark-list">
                        <li class="trademark-text-tit">{{$category->name}}:</li>
                        <?php 
                            $tags = explode(',',$category->keywords);
                            if(count($category->children)) {
                                $childrenTags = explode(',', $category->children->first()->keywords);
                                if (count($childrenTags)) {
                                    $tags = array_merge($tags, $childrenTags);
                                }
                            }
                        ?>
                        @if (count($tags))
                        @foreach($tags as $tag)
                        <li><a href="{{route('product.search') . '?search=' .$tag}}">{{$tag}}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            @endforeach
            </div><!-- /#trademark-text-box -->
            <div id="footer-menu-box">
                <p class="text-center">Copyright © 2016 Umzila. All Rights Reserved.</p>
            </div><!-- /#footer-menu-box -->
        </div> 
</footer>
<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
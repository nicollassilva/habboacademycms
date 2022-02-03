<section class="section-news">
    <div class="content-title">
        <div class="icon" style="background-image: url('{{ asset('images/content-icons/news.png') }}')"></div>
        <div class="data">
            @if (!isset($asWidget))
            <div class="principal">Portal de Notícias</div>
            <div class="description">Aqui você encontra tudo sob o ramo de notícias!</div>
            @else
            <div class="principal">Notícias relacionadas</div>
            <div class="description">Veja outras notícias relacionadas à essa categoria</div>
            @endif
        </div>
        @if (!isset($asWidget))
            <div class="action-buttons">
                <div class="search">
                    <input type="text" placeholder="Pesquise aqui..." name="search" autocomplete="off">
                    <i class="fas fa-search customTransition"></i>
                </div>
                <div class="pagination">
                    <div class="btn-pagination d-flex justify-content-center align-items-center">
                        <i class="fas fa-ellipsis-v"></i>
                        <div class="dropdown-pagination">
                            @foreach ($articlesCategories as $articleCategory)
                                <button>{{ $articleCategory->name }}</button>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn-pagination" disabled><i class="fas fa-chevron-left"></i></button>
                    <button class="btn-pagination"><i class="fas fa-sync-alt fa-spin"></i></button>
                    <button class="btn-pagination"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        @endif
    </div>
    @if (!isset($asWidget))
    <div class="slider-news">
        <div class="swiper-container customTransition newsSlider">
            <div class="swiper-wrapper">
                @foreach ($fixedArticles as $fixedArticle)
                    <div class="swiper-slide" style="background-image: url('{{ \Str::contains($fixedArticle->image_path, 'articles') ? asset("storage/{$fixedArticle->image_path}") : $fixedArticle->image_path }}')">
                        <div class="swiper-mirror">
                            <a href="{{ route('web.articles.show', [$fixedArticle->id, $fixedArticle->slug]) }}">
                                <div class="title">{{ $fixedArticle->title }}</div>
                            </a>
                            <div class="data text-truncate">
                                <div class="avatar" 
                                        style="background-image: url('{{ getAvatar($fixedArticle->user->username, '&action=wlk&direction=3&head_direction=3&gesture=sml&size=s') }}')"></div>
                                <a href="">{{ $fixedArticle->user->username }}</a>
                                <span>• <i class="fas fa-clock mr-1"></i>{{ dateToString($fixedArticle->created_at) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="box-content">
        @foreach ($articles as $article)
            <div class="box-new">
                <div class="data">
                    <div class="statistics">
                        <i class="fas fa-comment"></i> 0 <i class="fas fa-heart ml-1"></i> 0
                    </div>
                    <div class="statistics" style="width: 60%">
                        <i class="fas fa-clock"></i> {{ dateToString($article->created_at) }}
                    </div>
                </div>
                <div class="image" style="background-image: url('{{ \Str::contains($article->image_path, 'articles') ? asset("storage/{$article->image_path}") : $article->image_path }}')"></div>
                <div class="title" style="height: 35px">
                    <a href="{{ route('web.articles.show', [$article->id, $article->slug]) }}">{{ $article->title }}</a>
                </div>
                <div class="footer mt-2">
                    <div class="category text-truncate">{{ $article->category->name }}</div>
                    <div class="author">
                        <div class="avatar" 
                             style="background-image: url('{{ getAvatar($article->user->username, '&action=wlk&direction=3&head_direction=3&gesture=sml&size=s') }}')"></div>
                            <a href="">{{ $article->user->username }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
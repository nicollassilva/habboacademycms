<section class="section-news">
    <div class="content-title">
        <div class="icon" style="background-image: url('images/content-icons/news.png')"></div>
        <div class="data">
            <div class="principal">Portal de Notícias</div>
            <div class="description">Aqui você encontra tudo sob o ramo de notícias!</div>
        </div>
        <div class="action-buttons">
            <div class="search">
                <input type="text" placeholder="Pesquise aqui..." name="search" autocomplete="off">
                <i class="fas fa-search customTransition"></i>
            </div>
            <div class="pagination">
                <div class="btn-pagination d-flex justify-content-center align-items-center">
                    <i class="fas fa-ellipsis-v"></i>
                    <div class="dropdown-pagination">
                        <button>Categoria</button>
                        <button>Categoria</button>
                        <button>Categoria</button>
                        <button>Categoria</button>
                        <button>Categoria</button>
                    </div>
                </div>
                <button class="btn-pagination" disabled><i class="fas fa-chevron-left"></i></button>
                <button class="btn-pagination"><i class="fas fa-sync-alt fa-spin"></i></button>
                <button class="btn-pagination"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    <div class="slider-news">
        <div class="swiper-container customTransition newsSlider">
            <div class="swiper-wrapper">
                <?php if(false) { foreach(slides() as $slide) { ?>
                    <div class="swiper-slide" style="background-image: url('uploads/slides/<?= $slide['image'] ?>')">
                        <div class="swiper-mirror">
                            <a href="">
                                <div class="title"><?= $slide['title'] ?></div>
                            </a>
                            <div class="data text-truncate">
                                <div class="avatar" 
                                        style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=Bubu259&action=wlk&direction=3&head_direction=3&gesture=sml&size=s')"></div>
                                <a href="">Bubu259</a>
                                <span>• <i class="fas fa-clock mr-1"></i>há 3 horas atrás</span>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            </div>
        </div>
    </div>
    <div class="box-content">
        <?php for($i = 0; $i < 8; $i++) { ?>
            <div class="box-new">
                <div class="data">
                    <div class="statistics">
                        <i class="fas fa-comment"></i> 951 <i class="fas fa-heart ml-1"></i> 569
                    </div>
                    <div class="statistics" style="width: 60%">
                        <i class="fas fa-clock"></i> há 3 dias atrás
                    </div>
                </div>
                <div class="image" style="background-image: url('uploads/slides/welcome.png')"></div>
                <a href="">
                    <div class="title">
                        <a href="">Teste testando bem testado no teste testingg as dsa as das dsad sa</a>
                    </div>
                </a>
                <div class="footer mt-2">
                    <div class="category text-truncate">Colunas</div>
                    <div class="author">
                        <div class="avatar" 
                             style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=Bubu259&action=wlk&direction=3&head_direction=3&gesture=sml&size=s')"></div>
                            <a href="">Bubu259</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
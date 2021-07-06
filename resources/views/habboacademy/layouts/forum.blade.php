<div class="background-forum my-3">
    <div class="container">
        <section class="section-forum">
            <div class="content-title mb-2">
                <div class="icon" style="background-image: url('images/content-icons/forum.png')"></div>
                <div class="data">
                    <div class="principal text-light">
                        Fórum de Discussões
                        @auth
                            <a href="{{ route('habboacademy.topics.create') }}" class="btn btn-primary btn-sm ml-2 shadow text-white" style="height: 30px">Criar novo tópico</a>
                        @endauth
                    </div>
                    <div class="description text-light">Pode debater de tudo, mas claro, com respeito.</div>
                </div>
                <div class="action-buttons">
                    <div class="search">
                        <input type="text" placeholder="Pesquise aqui..." name="search" autocomplete="off">
                        <i class="fas fa-search customTransition"></i>
                    </div>
                    <div class="pagination justify-content-end w-auto">
                        <div class="btn-pagination d-flex justify-content-center align-items-center">
                            <i class="fas fa-ellipsis-v"></i>
                            <div class="dropdown-pagination">
                                @foreach ($topicsCategories as $topicCategory)     
                                <button id="{{ $topicCategory->id }}">{{ $topicCategory->name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-ranking">
                <div class="ranking">
                    <div class="title">
                        <i class="icon"></i>
                        Ranking de Comentários
                    </div>
                    <div class="users">
                    <?php for($i = 1; $i <= 5; $i++) { ?>
                        <div class="user">
                            <div class="avatar"
                                style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?&user=nicollas1073&action=&direction=2&head_direction=2&img_format=png&gesture=&headonly=1&size=b')"></div>
                            <div class="placing"><?= $i ?>º</div>
                            <a href=""><div class="name">nicollas1073</div></a>
                            <div class="comments">
                                <div class="icon" style="background-image: url('images/mini-icons/chat.png')"></div>
                                5123 comentários
                            </div>
                        </div>
                    <?php } ?>  
                    </div>
                </div>
                <div class="pagination">
                    <button class="btn-pagination">Diário</button>
                    <button class="btn-pagination">Semanal</button>
                    <button class="btn-pagination">Mensal</button>
                </div>
            </div>
            <div class="box-topics">
                <div class="topics">
                    @foreach ($topics as $topic)
                    <div class="topic{{ $topic->fixed ? ' fixed' : '' }}">
                        <div class="background-user" style="background-image: url('uploads/slides/welcome.png')">
                            <div class="comments">
                                <div class="chat-icon mr-1"></div>0
                            </div>
                        </div>
                        <a href="{{ route('habboacademy.topics.show', [$topic->id, $topic->slug]) }}"><div class="title text-truncate">{{ $topic->title }}</div></a>
                        <div class="avatar"
                                style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?&user={{ $topic->user->username }}&action=&direction=2&head_direction=2&img_format=png&gesture=&size=s')"></div>
                        <div class="data">
                            <a href="">{{ $topic->user->username }}</a> • <i class="fas fa-clock mr-1"></i> {{ dateToString($topic->created_at) }}
                        </div>
                    </div>
                    @endforeach 
                </div>
                <div class="pagination p-1 bg-white">
                    <button class="btn-pagination" disabled><i class="fas fa-chevron-left"></i></button>
                    <button class="btn-pagination"><i class="fas fa-sync-alt fa-spin"></i></button>
                    <button class="btn-pagination"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>
    </div>
</div>
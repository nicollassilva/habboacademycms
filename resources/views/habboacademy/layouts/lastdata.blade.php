<div class="last-contents">
    <div class="top-bar">
        <div class="default-title mini border-0">
            <b class="customTransition">
                <i class="fas fa-coins mr-2"></i>
                Últimos
            </b>
            Valores
        </div>
        <div class="action-buttons">
            <div class="search">
                <input type="text" placeholder="Pesquise aqui..." name="search" autocomplete="off">
                <i class="fas fa-search customTransition mirror fa-flip-horizontal"></i>
            </div>
            <div class="pagination">
                <button class="btn-pagination" disabled><i class="fas fa-chevron-left"></i></button>
                <button class="btn-pagination"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    <div class="box-content">
        <?php if(!empty($lastFurnis)) { foreach($lastFurnis as $furni) { ?>
            <div class="content"
                style="background-image: url('<?= $furni['icon'] ?>');"
                data-toggle="tooltip">

            </div>
        <?php }} ?>
    </div>
</div>
<div class="last-contents mt-2">
    <div class="top-bar">
        <div class="default-title mini border-0 customTransition">
            <b class="customTransition">
                <i class="fas fa-certificate mr-2"></i>
                Últimos
            </b>
            Emblemas
        </div>
        <div class="action-buttons">
            <div class="search">
                <input type="text" placeholder="Pesquise aqui..." name="search" autocomplete="off">
                <i class="fas fa-search customTransition mirror fa-flip-horizontal"></i>
            </div>
            <div class="pagination">
                <button class="btn-pagination" disabled><i class="fas fa-chevron-left"></i></button>
                <button class="btn-pagination"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    <div class="box-content">
        @foreach (getLastBadges() as $badge)
            <div class="content last-badge"
                data-toggle="tooltip"
                title="
                    <b>Código:</b> {{ $badge->code }}<br>
                    <b>Título:</b> {{ $badge->title }}<br>
                    @if($badge->description) <b>Descrição:</b> {{ $badge->description }} @endif
                "
                style="background-image: url('{{ $badge->image_path }}');">
            </div>
        @endforeach
    </div>
</div>
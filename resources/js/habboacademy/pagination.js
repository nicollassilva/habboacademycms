export default function pagination({ section, box, displayName, url, limit, effectIn, effectOut, debug = false }) {
    let sectionBox = $('section'+section),
        inputSearch = sectionBox && sectionBox.find('button[searchButton] form').length > 0 && sectionBox.find('button[searchButton] form > input[type="text"]'),
        btnPrev = sectionBox.find('button[pagPrev]').first(),
        btnNext = sectionBox.find('button[pagNext]').first(),
        btnReload = sectionBox.find('button[pagReload]').first(),
        total = Number(sectionBox.find('.paginacao').attr('total')),
        atualPage = Number(sectionBox.find('.paginacao').attr('page')),
        categorie = !!sectionBox.find('.categorias a.selected').attr('data-id') ? Number(sectionBox.find('.categorias a.selected').attr('data-id')) : 0,
        token = $('meta[name="csrf-token"]').attr("content"),
        exec = false;

        if($(sectionBox).find('.categorias')) {
            $(sectionBox).find('.categorias .menu a').off("click").on('click', function() {
                $(sectionBox).find('.categorias .menu a').hasClass('selected') ? $(sectionBox).find('.categorias .menu a').removeClass('selected') : ''
                categorie = Number($(this).attr('data-id'))
                $(this).addClass('selected')
                btnReload.trigger('click')
            })
        }

        if(sectionBox.length <= 0) {
            return debug && console.log("ERRO: Paginação não encontrada: "+section)
        } else if(url === undefined) {
            return debug && console.log("ERRO: URL da paginação não encontrada.")
        }

        const changePrev = (action = false) => btnPrev.attr('disabled', action);
        const changeNext = (action = false) => btnNext.attr('disabled', action);
        atualPage <= 1 && changePrev(true)
        total <= limit && changeNext(true)

        const removeItems = _ => {
            let boxPg = sectionBox.find(sectionBox.find(`.display${displayName} .itens `)).length > 0 ? sectionBox.find(sectionBox.find(`.display${displayName} .itens `+box)) : sectionBox.find(sectionBox.find(`.display${displayName} `+box))
            boxPg.each((e, a) => {
                setTimeout(() => {
                    $(a).addClass('animated '+effectOut)
                    setTimeout(() => {
                        a.remove()
                    }, 1500);
                }, (e+1)+'00');
            });
        }

        const addItems = (items, type) => {
            setTimeout(() => {
                sectionBox.find(`.display${displayName}`).animate({
                    opacity: '1'
                }, 500);
                $.map(items, function(a, e) {
                    let clone = $('.tmpl_layouts '+box).clone();
                    if(type === 'news') {
                        setTimeout(() => {
                            $(clone).find('.autor .avatar-pequeno').attr('style', `background-image: url('${imagerLink + a.autor}/headonly=0&direction=3&head_direction=3&action=wlk&gesture=sit&size=s')`)
                            $(clone).find('.autor span.text-truncate a').attr('href', `/home/${a.autor}`).html(a.autor)
                            $(clone).find('.dados span.text-truncate[title]').attr('data-toggle', 'tooltip').attr('title', a.titulo).attr('data-original-title', a.titulo)
                            $(clone).find('.dados span.text-truncate[title] a').attr('href', `/noticia/${a.id}/${a.url}`).html(a.titulo)
                            $(clone).find('.dados .imagem').attr('style', `background-image: url('uploads/adminUploads/${a.imagem}')`)
                            $(clone).find('.dados .imagem span[views]').html(`<i class="fas fa-eye mr-1"></i> ${a.comentarios}`)
                            $(clone).find('.dados .categoria span[category]').html(a.categoria)
                            $(clone).find('.dados span[description]').html(a.descricao)
                            $(clone).find('.rodape span:first-of-type').html(`<i class="fas fa-calendar-alt"></i> ${a.time}`)
                            $(clone).find('.rodape span:last-of-type').html(`<i class="fas fa-comment"></i> ${a.visualizacao}`)
                            $(clone).addClass('animated '+effectIn)
                            $(sectionBox).find('.display'+displayName).append(clone)
                        }, (e+1)+'00');
                    } else if(type === 'values') {
                        setTimeout(() => {
                            $(clone).find('.mobi').attr('title', `<div class='valor-tooltip-imagem'><img src='uploads/adminUploads/valores/${a.icone}' alt='${a.mobi}' /><span>${a.mobi}</span></div>`).attr('style', `background-image: url('uploads/adminUploads/valores/${a.icone}')`).addClass(a.estado)
                            $(clone).find('span[mobi]').attr('title', a.mobi).html(a.mobi)
                            $(clone).find('span[state]').attr('title', (a.estado.charAt(0).toUpperCase() + a.estado.slice(1)))
                            $(clone).find('span[state] i').addClass(a.estado)
                            $(clone).find('span.text-truncate[price]').html(`<i class="mr-1 ${a.moeda}"></i> <b>${a.preco}</b> ${a.moeda}s`)
                            $(clone).addClass('animated '+effectIn)
                            $(sectionBox).find('.display'+displayName).append(clone)
                        }, (e+1)+'00');
                    } else if(type == 'topics') {
                        setTimeout(() => {
                            $(clone).find('span:first-of-type').attr('title', a.titulo)
                            $(clone).find('span:first-of-type a.titulo').attr('href', `/topico/${a.id}/${a.url}`).html(a.titulo)
                            $(clone).find('.dados .avatar-pequeno').attr('style', `background-image: url('${imagerLink + a.autor}/headonly=0&direction=3&head_direction=3&action=&gesture=&size=s')`)
                            $(clone).find('.dados span.text-truncate:first-of-type').html(`<a class="text-dark" href="/home/${a.autor}">${a.autor}</a>`)
                            $(clone).find('.dados span.text-truncate:last-of-type').html(`<i class="fas fa-calendar-alt mr-1"></i> ${a.time} <b class="mr-2 ml-2">·</b> <i class="fas fa-comment"></i> ${a.comentarios}`)
                            $(clone).addClass('animated '+effectIn)
                            $(sectionBox).find('.display'+displayName).append(clone)
                        }, (e+1)+'00');
                    } else if(type == 'arts') {
                        setTimeout(() => {
                            $(clone).find('.imagem').attr('style', `background-image: url('uploads/arts/${a.imagem}')`)
                            $(clone).find('span.text-truncate[title]').html(`<a href="/arte/${a.id}/${a.url}">${a.titulo}</a>`)
                            $(clone).find('span[cat]').html(`<em>${a.categoria}</em><b class="ml-2 mr-2">·</b> ${a.time}`)
                            $(clone).find('span[note]').html(a.note.toString().length === 1 ? `${a.note}.0` : a.note)
                            $(clone).find('.autor .avatar-pequeno').attr('style', `background-image: url('${imagerLink + a.autor}/headonly=0&direction=3&head_direction=3&action=&gesture=&size=s')`)
                            $(clone).find('.autor span[author]').html(`<a href="/home/${a.autor}">${a.autor}</a>`)
                            $(clone).find('.autor span[comments]').html(`<i class="fas fa-comment mr-1"></i>${a.comentarios}`)
                            $(clone).addClass('animated '+effectIn)
                            $(sectionBox).find('.display'+displayName).append(clone)
                        }, (e+1)+'00');
                    } else if(type == 'tirinha') {
                        $(clone).find('.imagem').attr('style', `background-image: url('uploads/arts/${a.imagem}')`)
                        $(clone).find('span.text-truncate[title]').html(`<a href="/tirinha/${a.id}/${a.url}">${a.titulo}</a>`)
                        $(clone).find('.avatar-grande').attr('style', `background-image: url('${imagerLink + a.autor}/headonly=0&direction=3&head_direction=3&action=&gesture=&size=l')`)
                        $(clone).find('span.text-truncate[author]').html(`<a class="text-white" href="/home/${a.autor}">${a.autor}</a>`)
                        $(clone).addClass('animated '+effectIn)
                        $(sectionBox).find('.display'+displayName).append(clone)
                    } else if(type == 'shop') {
                        $(clone).addClass(`item${a.id}`)
                        $(clone).addClass((a.expirado ? 'expirado' : ''))
                        $(clone).addClass((a.promocao == "true" ? 'promocao' : ''))
                        $(clone).addClass(((a.limite != 0 && a.limite !== null) && a.disponiveis == 0 ? 'esgotado' : ''))
                        $(clone).find('.imagem').attr('style', `background-image: url('uploads/adminUploads/${a.imagem}')`).attr('title', `Preço: <i class='camb ml-1 float-right mt-1'></i> <b>${a.valor}</b>`)
                        $(clone).find('span.text-truncate').html(a.item).attr('title', a.item)
                        $(clone).find('.imagem').find('span.text-truncate').html(`${a.expirado ? 'Esgotado' : a.expiraem}`)
                        $(clone).find('button[dataBuy]').attr('disabled', ((a.limite != 0 && a.limite !== null) && a.disponiveis == 0 ? true : false)).html(`Comprar agora ${a.limite > 0 ? '('+a.disponiveis+')' : ''}`)
                        $(clone).addClass('animated '+effectIn)
                        $(sectionBox).find('.display'+displayName+` .itens`).append(clone)
                    }
                });
            }, 2500);
        }
        
        btnNext.off("click").on('click', function() {
            if(atualPage >= 1 && !exec) {
                nextPage = (atualPage + 1), atualPage = nextPage,
                sectionBox.find('.paginacao').attr('page', nextPage)
                $.ajax({
                    url: url,
                    dataType: 'JSON',
                    type: 'POST',
                    data: {
                        pagina: nextPage,
                        limite: limit,
                        pesquisa: (inputSearch.length > 0 ? inputSearch.val() : ''),
                        categoria: categorie,
                        _token: token
                    },
                    beforeSend: _ => {
                        exec = true;
                        sectionBox.find(`.display${displayName}`).animate({
                            opacity: '0.5'
                        }, 500)
                    },
                    success: (response) => {
                        if(response.error) {
                            sectionBox.find(`.display${displayName}`).animate({
                                opacity: '1'
                            }, 500)
                        } else {
                            if(typeof response.items == 'object' && response.items.length > 0) {
                                removeItems(), addItems(Object.values(response.items), response.type)
                                response.items.length < limit && (response.items.length * atualPage) > (response.total - limit) && changeNext(true)
                                changePrev(false)
                            } else {
                                setTimeout(() => {
                                    changeNext(true), sectionBox.find(`.display${displayName}`).animate({ opacity: '1' }, 500)
                                    webCode.alert("Não encontramos nenhum item! Vamos te mandar pra primeira página.");
                                    setTimeout(() => (categorie = 0, btnReload.trigger('click')), 2600);
                                }, 1000)
                            }
                        }
                        setTimeout(() => exec = false, 3500);
                    },
                    error: _ => false
                })
        }
    })
    btnPrev.off("click").on('click', function() {
        if(atualPage > 1 && !exec) {
            nextPage = (atualPage - 1), atualPage = nextPage,
            sectionBox.find('.paginacao').attr('page', nextPage)
            $.ajax({
                url: url,
                dataType: 'JSON',
                type: 'POST',
                data: {
                    pagina: nextPage,
                    limite: limit,
                    pesquisa: (inputSearch.length > 0 ? inputSearch.val() : ''),
                    categoria: categorie,
                    _token: token
                },
                beforeSend: _ => {
                    exec = true;
                    sectionBox.find(`.display${displayName}`).animate({
                        opacity: '0.5'
                    }, 500)
                },
                success: (response) => {
                    if(response.error) {
                        sectionBox.find(`.display${displayName}`).animate({
                            opacity: '1'
                        }, 500)
                    } else {
                        if(typeof response.items == 'object' && response.items.length > 0) {
                            removeItems(), addItems(Object.values(response.items), response.type)
                            response.total > limit && changeNext(false)
                            atualPage <= 1 && changePrev(true)
                        } else {
                            setTimeout(() => {
                                changeNext(true), sectionBox.find(`.display${displayName}`).animate({ opacity: '1' }, 500)
                                webCode.alert("Não encontramos nenhum item! Vamos te mandar pra primeira página.");
                                setTimeout(() => (categorie = 0, btnReload.trigger('click')), 2600);
                            }, 1000)
                        }
                    }
                    setTimeout(() => exec = false, 3500);
                },
                error: _ => false
            })
        }
    })
    btnReload.off("click").on('click', function() {
        if(atualPage >= 1 && !exec) {
            atualPage = 1, changePrev(true)
            sectionBox.find('.paginacao').attr('page', 1)
            $.ajax({
                url: url,
                dataType: 'JSON',
                type: 'POST',
                data: {
                    pagina: 1,
                    limite: limit,
                    pesquisa: (inputSearch.length > 0 ? inputSearch.val() : ''),
                    categoria: categorie,
                    _token: token
                },
                beforeSend: _ => {
                    exec = true;
                    sectionBox.find(`.display${displayName}`).animate({
                        opacity: '0.5'
                    }, 500)
                },
                success: (response) => {
                    if(response.error) {
                        sectionBox.find(`.display${displayName}`).animate({
                            opacity: '1'
                        }, 500)
                    } else {
                        if(typeof response.items == 'object' && response.items.length > 0) {
                            removeItems(), addItems(Object.values(response.items), response.type)
                            response.total > limit && changeNext(false)
                            response.items.length < limit && (response.items.length * atualPage) > (response.total - limit) && changeNext(true)
                        } else {
                            setTimeout(() => {
                                changeNext(true), sectionBox.find(`.display${displayName}`).animate({ opacity: '1' }, 500)
                                webCode.alert("Não encontramos nenhum item! Vamos te mandar pra primeira página.");
                                setTimeout(() => (categorie = 0, btnReload.trigger('click')), 2600);
                            }, 1000)
                        }
                    }
                    setTimeout(() => exec = false, 3500);
                },
                error: _ => false
            })
        }
    })
}